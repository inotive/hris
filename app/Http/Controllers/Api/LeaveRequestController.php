<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LeaveRequestResource;
use App\Models\File;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use App\Services\Base64FileService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class LeaveRequestController extends Controller
{
    public function index(Request $request)
    {
        $auth = auth()->user();

        $status = $request->status;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $timezone = auth()->user()->company->time_zone;
        $list = LeaveRequest::query()
            ->when($status != null, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($start_date != null, function ($query) use ($start_date, $timezone) {
                $query->where('created_at', '>=', Carbon::parse($start_date, $timezone)->setTimezone('UTC')->toIso8601String());
            })
            ->when($end_date != null, function ($query) use ($end_date, $timezone) {
                $query->where('created_at', '<=', Carbon::parse($end_date, $timezone)->setTimezone('UTC')->toIso8601String());
            })
            ->when($request->month != null, function ($query) use ($request, $timezone) {
                $monthStart = Carbon::createFromDate($request->year, $request->month, 1, $timezone)->startOfMonth()->setTimezone('UTC')->toIso8601String();
                $monthEnd = Carbon::createFromDate($request->year, $request->month, 1, $timezone)->endOfMonth()->setTimezone('UTC')->toIso8601String();
                return $query->whereBetween('created_at', [$monthStart, $monthEnd]);
            })
            ->when($request->year != null && $request->month == null, function ($query) use ($request, $timezone) {
                $yearStart = Carbon::create($request->year, 1, 1, $timezone)->startOfYear()->setTimezone('UTC')->toIso8601String();
                $yearEnd = Carbon::create($request->year, 12, 31, $timezone)->endOfYear()->setTimezone('UTC')->toIso8601String();
                return $query->whereBetween('created_at', [$yearStart, $yearEnd]);
            })

            ->orderBy('created_at', $request->sort ?? 'desc')
            ->paginate($request->per_page ?? 10);

        $pagination = $list->toArray();
        unset($pagination['data']);

        return [
            'success'   => true,
            'data'  => LeaveRequestResource::collection($list),
            'pagination' => $pagination,
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
        try {
            DB::beginTransaction();
            $auth = auth()->user();

            $request->merge([
                'employee_id'   => $auth->id,
                'company_id'   => $auth->company_id,
                'manager_id'    => $auth->head_department_id,
            ]);

            $leave_type_id = $request->leave_type_id;

            if ($leave_type_id == null) {
                return response()->json([
                   'success'   => 'error',
                   'message'   => 'Leave Type is required',
                ], 404);
            }
         

            $files = $request->all()['files'] ?? [];

            $validate = (new LeaveRequest())->rules;
            $validated = $request->validate($validate);

            $type_count = LeaveType::where('id', $leave_type_id)->count();

            if ($type_count == 0) {
                return response()->json([
                    'success'   => 'error',
                    'message'   => 'Leave Type Not Found',
                ], 404);
            }

            $leave_request = LeaveRequest::create($validated);


            foreach ($files as $key => $value) {

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

            DB::commit();
            return [
                'status'    => 'success',
                'message'   => "Leave request data create successful"
            ];
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e);
            return response()->json([
                'status'    => 'error',
                'message'   => "Error"
            ], 500);
        }
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


        foreach ($files as $key => $value) {
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
            'message' => "Leave request data delete successful"
        ];
    }


    public function reasonLeaving()
    {
        $list = LeaveRequest::reasonLeavingDropdown();

        $data = [];
        foreach ($list as $key => $value) {
            $data[] = [
                'key' => $key,
                'value' => $value,
            ];
        }

        return [
            'status'    => 'success',
            'data'      => $data,
        ];
    }


    public function leaveType(Request $request)
    {
        $company_id = $request->company_id ?? auth()->user()->company_id;
        $list = LeaveType::where('company_id', $company_id)->orderBy('name')->pluck('name', 'id');

        $data = [];
        foreach ($list as $key => $value) {
            $data[] = [
                'key' => $key,
                'value' => $value,
            ];
        }

        return [
            'status'    => 'success',
            'data'      => $data,
        ];
    }
}
