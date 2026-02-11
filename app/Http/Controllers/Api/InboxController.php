<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InboxController extends Controller
{
    public function notifications(Request $request)
    {
        $auth = auth()->user();

        $limit = 10;
        $offset = (($request->page ?? 1)-1) * $limit;

        $data = DB::select("SELECT
                        *
                        FROM
                        (
                            (
                                SELECT
                                    a.id,
                                    '' AS type,
                                    NULL AS module,
                                    a.title,
                                    a.content,
                                    ar.read_at,
                                    NULL AS approved_at,
                                    NULL AS approver_employee_id,
                                    NULL AS approver_employee_name,
                                    a.created_at
                                FROM
                                    `announcement_reads` ar
                                    JOIN announcements a ON a.id = ar.announcement_id
                                    JOIN employees e ON e.id = ar.employee_id
                                WHERE ar.employee_id = '".$auth->id."'
                            )

                            UNION ALL
                            (
                            SELECT
                                r.id,
                                r.`status` as 'type',
                                r.module,
                                r.title,
                                r.content,

                                NULL AS read_at,
                                ra.approved_at,
                                ra.approver_employee_id,
                                IF(e.id is null, null, concat(e.first_name, e.last_name)) as approver_employee_name,
                                r.created_at
                            FROM
                                requests r
                                LEFT JOIN request_approvers ra ON ra.request_id = r.id AND ra.active =1 AND ra.approver_status != 'pending'
                                LEFT JOIN employees e ON e.id = ra.approver_employee_id
                            WHERE 
                                r.employee_id =  '".$auth->id."'
                                AND r.status IN ('approved', 'rejected')
                            )
                        ) notification


                        ORDER  BY notification.created_at DESC

                          LIMIT $limit OFFSET $offset
                        ");

        $data = collect($data)->map(function ($item) {
            $data =  (array)$item;
            $data['module_name'] = $data['module'] != null ? ucfirst($data['module']) . " Request" : null;


            $message = null;

            if ($data['type'] === 'approved') {
                $message = "Your leave request has been approved. Please ensure all pending tasks are handed over to the appropriate team members before your leave period.";
            } else if ($data['type'] === 'rejected') {
                $message = "Your leave request has been rejected.";
            }
            
            $data['message'] = $message;
            return $data;
        });
        return [
            'status'    => 'success',
            'data'  => $data,
        ];
    }


    public function needAprovals(Request $request)
    {
        $auth = auth()->user();

        $data = DB::select("SELECT
                    request_approvers.id,
                    requests.module,
                    requests.title,
                    requests.content,
                    requests.module_id,
                    request_approvers.approver_status,
                    request_approvers.approver_level,
                    request_approvers.approved_at,
                    concat(req_employee.first_name, ' ', req_employee.last_name) as employee_name,
                    null as read_at,
                    request_approvers.created_at,
                    request_approvers.approver_employee_id


                    FROM `request_approvers`

                    JOIN requests ON requests.id = request_approvers.request_id
                    JOIN employees req_employee ON req_employee.id = requests.employee_id

                    WHERE
                        ((request_approvers.active = 1 AND request_approvers.approver_status = 'pending')
                             OR (request_approvers.active = 0 AND request_approvers.approver_status NOT IN('pending'))
                             )
                        AND request_approvers.approver_employee_id = '".$auth->id."'
                    ORDER BY request_approvers.created_at DESC
                ");

        return [
            'status'    => 'success',
            'data'  => $data,
        ];
    }
}
