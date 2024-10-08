<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LeaveRequestResource;
use App\Models\File;
use App\Models\LeaveRequest;
use App\Services\Base64FileService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Storage;

class LeaveRequestController extends Controller
{
    public function index(Request $request)
    {
        $auth = auth()->user();

        $status = $request->status;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $list = LeaveRequest::query()
            ->when($status != null, function($query) use($status){
                $query->where('status', $status);
            })
            ->when($start_date !=null, function ($query) use ($start_date){
                $query->whereDate('created_at','>=', $start_date);
            })
            ->when($end_date !=null, function ($query) use ($end_date){
                $query->whereDate('created_at','<=', $end_date);
            })
        
            ->get();

        return [
            'success'   => true,
            'data'  => LeaveRequestResource::collection($list),
        ];
    }


    public function detail($id, Request $request)
    {

        $data = LeaveRequest::where('id', $id)
        
            ->first();

        return [
            'success'   => true,
            'data'  => new LeaveRequestResource($data),
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
    
        $files = $request->all()['files'] ?? [];

        $validate = (new LeaveRequest())->rules;
        $validated = $request->validate($validate);

        $leave_request = LeaveRequest::create($validated);


        foreach($files as $key => $value) {
            // $row = json_decode($value);



            $base64file = Base64FileService::saveBase64File($value, 'leave_request');

            File::create([
                'company_id'    => $request->company_id,
                'module'    => 'leave',
                'name'  => $base64file,
                'file'  => $base64file,
                'url'   => Storage::url($base64file),
                'extension' => 'test',
                'size'   => 1,
                'employee_id'   => $request->employee_id,
                'module_id' => $leave_request->id,
            ]);
        }


        return [
            'status'    => 'success',
            'message'   => "Leave request data create successful"
        ];
    }

    public function update(Request $request)
    {
        $auth = auth()->user();

        $request->merge([
            'employee_id'   => $auth->id,
            'company_id'   => $auth->company_id,
            'manager_id'    => $auth->head_department_id,
        ]);
    
        $files = $request->all()['files'] ?? [];

        $validate = (new LeaveRequest())->rules;
        $validated = $request->validate($validate);

        $leave_request = LeaveRequest::find($request->id);
        $leave_request->fill($validated);
        $leave_request->save();


        foreach($files as $key => $value) {
            // $row = json_decode($value);



            $base64file = Base64FileService::saveBase64File($value, 'leave_request');

            File::create([
                'company_id'    => $request->company_id,
                'module'    => 'leave',
                'name'  => $base64file,
                'file'  => $base64file,
                'url'   => Storage::url($base64file),
                'extension' => 'test',
                'size'   => 1,
                'employee_id'   => $request->employee_id,
                'module_id' => $leave_request->id,
            ]);
        }


        return [
            'status'    => 'success',
            'message'   => "Leave request data update successful"
        ];
    }

    public function delete(Request $request)
    {
        $id = $request->id;

        
        LeaveRequest::where('id', $id)->delete();
        return [
            'status'    => 'success',
                'message'=> "Leave request data delete successful"
        ];
    
    }
}
