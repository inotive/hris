<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LeaveRequestResource;
use App\Http\Resources\LeaveTypeResource;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    public function index(Request $request)
    {
        $auth = auth()->user();

        $list = LeaveType::where('company_id', $auth->company_id)
            ->orderBy('name')
                    ->get();

        return [
            'success'   => true,
            'data'  => LeaveTypeResource::collection($list),
        ];
    }


    public function create(Request $request)
    {
        $auth = auth()->user();

        $request->merge([
            'employee_id'   => $auth->id,
            'company_id'   => $auth->company_id,
            'manager_id'    => $auth->head_department_id,
        ]);
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $leave_type_id = $request->leave_type_id;
        $reason = $request->reason;
        $files = $request->files ?? [];


        $validate = (new LeaveRequest())->rules;
        $validated = $request->validate($validate);

        $leave_request = LeaveRequest::create($validated);

        foreach($files as $key => $value) {
            // $row = json_decode($value);

    
            // File::create([
            //     'company_id'    => $request->company_id,
            //     'module'    => 'leave',
            //     'name'  => $row->file,
            //     'file'  => $row->file,
            //     'url'   => $row->url,
            //     'extension' => 'test',
            //     'size'   => 1,
            //     'employee_id'   => $request->employee_id,
            //     'module_id' => $id,
            // ]);
        }


        return [
            'status'    => 'success',
        ];
    }
}
