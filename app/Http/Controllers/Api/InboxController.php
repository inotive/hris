<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InboxController extends Controller
{
    public function notifications(Request $request)
    {
        $limit = 10;
        $offset = (($request->page ?? 1)-1) * $limit;

        $data = DB::select("SELECT
                        *
                        FROM
                        (
                            (
                            SELECT
                                announcements.id,
                                '' AS type,
                                NULL AS module,
                                announcements.title,
                                announcements.content,
                                announcement_reads.read_at,
                                announcements.created_at
                            FROM
                                `announcement_reads`
                                JOIN announcements ON announcements.id = announcement_reads.announcement_id
                                JOIN employees ON employees.id = announcement_reads.employee_id
                            )

                            UNION ALL
                            (
                            SELECT
                                requests.id,
                                requests.`status` as 'type',
                                requests.module,
                                requests.title,
                                requests.content,
                                NULL AS readt_at,
                                requests.created_at
                            FROM
                                requests
                            )
                        ) notification


                        ORDER  BY notification.created_at DESC

                          LIMIT $limit OFFSET $offset
                        ");
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
                ");

        return [
            'status'    => 'success',
            'data'  => $data,
        ];
    }
}
