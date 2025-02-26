<?php

namespace App\Services;

use App\Jobs\AttendanceInitJob;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class LeaveTypeService
{

    static public function leaveTypeByEmployee($employee_id, $leave_type_id = null)
    {
        $year = Carbon::now()->year;

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
                    count(*)
                    FROM
                    leave_requests
                    WHERE
                    employee_id = '$employee_id'
                    AND year(leave_requests.start_date) = $year
                    AND leave_requests.leave_type_id = leave_types.id
                AND leave_requests.status IN ('pending', 'approved')) AS request_count
                FROM
                leave_types
                LEFT JOIN (SELECT * FROM employee_leave_types WHERE employee_id = '$employee_id' ) AS employee_leave_types ON employee_leave_types.leave_type_id = leave_types.id
                WHERE
                leave_types.company_id = (SELECT company_id FROM employees WHERE id = '$employee_id')
                $add_query
                )

                employee_leave_types
        ";



        $leaveTypes = DB::select($query);

        return $leaveTypes;
    }
}
