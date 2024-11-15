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
}
