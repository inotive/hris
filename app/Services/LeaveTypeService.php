<?php

namespace App\Services;

use App\Models\LeaveRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class LeaveTypeService
{
    static public function checkDayLimit($employee_id, $leave_type_id, $start_date, $end_date)
    {
        $start = Carbon::parse($start_date);
        $end = Carbon::parse($end_date);


        $exists = LeaveRequest::where('employee_id', $employee_id)
            ->where(function ($query) use ($start, $end) {
                $query->whereDate('start_date', '<=', $end)
                    ->whereDate('end_date', '>=', $start);
            })
            ->where('leave_type_id', $leave_type_id)
            ->whereIn('status', [LeaveRequest::$STATUS_PENDING, LeaveRequest::$STATUS_APPROVED])
            ->exists();

        if ($exists) {
            return [
                'status' => false,
                'message' => __('leave_overlap')
            ];
        }        
        
        $years = [];
        $current = $start->copy();

        if (empty($leave_type_id)) {
            return [
                'status' => false,
                'message' => __('leave_type_empty')
            ];
        }
        
        while ($current->year <= $end->year) {
            $yearStart = $current->year === $start->year ? $start : Carbon::createFromDate($current->year, 1, 1);
            $yearEnd = $current->year === $end->year ? $end : Carbon::createFromDate($current->year, 12, 31);
            
            $days = $yearStart->diffInDays($yearEnd) + 1;
            $leaveType = self::leaveTypeByEmployee($employee_id, $leave_type_id, $current->year);
            

        

            if (empty($leaveType)) {
                return [
                    'status' => false,
                    'message' => __('leave_not_found')
                ];
            }
            
            $remaining = isset($leaveType[0]->days_remaining) ? $leaveType[0]->days_remaining : null;
            
            if ($days > $remaining && $remaining != null) {
                return [
                    'status' => false,
                    'message' => __('leave_insufficient_days_simple', [
                        'year' => $current->year,
                        'available' => $remaining,
                        'requested' => $days
                    ])
                ];
            }
            
            $years[] = [
                'year' => $current->year,
                'days' => $days,
                'remaining' => $remaining
            ];
            
            $current->addYear();
        }
        
        return [
            'status' => true,
            'data' => $years
        ];
    }

    static public function leaveTypeByEmployee($employee_id, $leave_type_id = null, $year = null, $search = null)
    {
        if ($year === null) {
            $year = Carbon::now()->year;
        }

        $add_query = "";
        if ($leave_type_id != null) {
            $add_query .= " AND leave_types.id = '$leave_type_id'";
        }
        $query = "
            SELECT *, (employee_leave_types.days_limit - employee_leave_types.request_count) as days_remaining FROM (SELECT
                employee_leave_types.id,
                leave_types.id AS leave_type_id,
                leave_types.name,
                leave_types.days_limit AS default_days_limit,
                employee_leave_types.days_limit AS custom_days_limit,
                IFNULL(employee_leave_types.days_limit, leave_types.days_limit) AS days_limit,
                (
                    SELECT
                    SUM(DATEDIFF(leave_requests.end_date, leave_requests.start_date) + 1) AS total_days
                    FROM
                    leave_requests
                    WHERE
                    employee_id = '$employee_id'
                    AND year(leave_requests.start_date) = $year
                    AND leave_requests.leave_type_id = leave_types.id
                    AND leave_requests.status IN ('pending', 'approved')
                ) AS request_count
                FROM
                leave_types
                LEFT JOIN (SELECT * FROM employee_leave_types WHERE employee_id = '$employee_id' ) AS employee_leave_types ON employee_leave_types.leave_type_id = leave_types.id
                WHERE
                leave_types.company_id = (SELECT company_id FROM employees WHERE id = '$employee_id')
                $add_query
                )

                employee_leave_types
        ";

        if ($search != null) {
            $query .= " WHERE employee_leave_types.name LIKE '%$search%'";
        }



        $leaveTypes = DB::select($query);

        // Log::info($leaveTypes);

        return $leaveTypes;
    }
}
