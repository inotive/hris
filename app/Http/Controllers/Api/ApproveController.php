<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use App\Models\OvertimeRequest;
use App\Models\ReimbursementRequest;
use App\Models\Request as ModelsRequest;
use App\Models\RequestApprover;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApproveController extends Controller
{
    public function approve(Request $request)
    {

        try {
            if ($request->request_approver_id == null) {
                return [
                    'status'    => 'error',
                    'message'   => 'request_approver_id required',
                ];
            }

            DB::beginTransaction();

            $request_approver_id = $request->request_approver_id;

            $req =  RequestApprover::where('id', $request_approver_id)->first();

            if ($req == null) {
                return [
                    'status'    => 'error',
                    'message'   => 'Data Not Found',
                ];
            }

            if ($req->approver_employee_id != auth()->user()->id) {
                return [
                    'status'    => 'error',
                    'message'   => 'Not Allowed Employee',
                ];
            }
            if ($req->approver_status != 'pending') {
                return [
                    'status'    => 'error',
                    'message'   => 'Request has been processed',
                ];
            }

            if ($req->active == false) {
                return [
                    'status'    => 'error',
                    'message'   => 'Request not active',
                ];
            }

            $req->approver_status = 'approved';
            $req->save();


            $other_approver = RequestApprover::where('request_id', $req->request_id)->orderBy('approver_level', 'asc')->where('approver_status', 'pending')->first();
            if ($other_approver != null) {
                $other_approver->active = true;
                $other_approver->save();
            } else {
                $request_data = ModelsRequest::where('id', $req->request_id)->first();
                if ($request_data != null) {
                    // update reject
                    $module = $request_data->module;
                    $module_id = $request_data->module_id;

                    $request_data->status = 'approved';
                    $request_data->save();

                    if ($module == 'leave') {
                        LeaveRequest::where('id', $module_id)->update([
                            'status'    => 'approved'
                        ]);
                    } else if ($module == 'overtime') {
                        OvertimeRequest::where('id', $module_id)->update([
                            'status'    => 'approved'
                        ]);
                    } else if ($module == 'reimbursement') {
                        ReimbursementRequest::where('id', $module_id)->update([
                            'status'    => 'approved'
                        ]);
                    }
                }
            }

            DB::commit();

            return [
                'status'    => 'success',
                'message'   => 'Approved successfully',
            ];
        } catch (Exception $e) {

            Log::error($e);
            DB::rollBack();

            return [
                'status'   => 'error',
                'message'   => 'Failed to retrieve approve data, please try again later',
            ];
        }
    }


    public function reject(Request $request)
    {

        try {
            if ($request->request_approver_id == null) {
                return [
                    'status'    => 'error',
                    'message'   => 'request_approver_id required',
                ];
            }


            if ($request->reason == null) {
                return [
                    'status'    => 'error',
                    'message'   => 'reason required',
                ];
            }


            DB::beginTransaction();

            $request_approver_id = $request->request_approver_id;



            $req =  RequestApprover::where('id', $request_approver_id)->first();

            if ($req == null) {
                return [
                    'status'    => 'error',
                    'message'   => 'Data Not Found',
                ];
            }

            if ($req->approver_employee_id != auth()->user()->id) {
                return [
                    'status'    => 'error',
                    'message'   => 'Not Allowed Employee',
                ];
            }
            if ($req->approver_status != 'pending') {
                return [
                    'status'    => 'error',
                    'message'   => 'Request has been processed',
                ];
            }

            if ($req->active == false) {
                return [
                    'status'    => 'error',
                    'message'   => 'Request not active',
                ];
            }

            $req->approver_status = 'rejected';
            $req->reason = $request->reason;
            $req->save();


            $request_data = ModelsRequest::where('id', $req->request_id)->first();
            if ($request_data != null) {
                // update reject
                $module = $request_data->module;
                $module_id = $request_data->module_id;

                $request_data->status = 'rejected';
                $request_data->save();

                if ($module == 'leave') {
                    LeaveRequest::where('id', $module_id)->update([
                        'status'    => 'rejected'
                    ]);
                } else if ($module == 'overtime') {
                    OvertimeRequest::where('id', $module_id)->update([
                        'status'    => 'rejected'
                    ]);
                } else if ($module == 'reimbursement') {
                    ReimbursementRequest::where('id', $module_id)->update([
                        'status'    => 'rejected'
                    ]);
                }
            }

            DB::commit();

            return [
                'status'    => 'success',
                'message'   => 'Approved successfully',
            ];
        } catch (Exception $e) {

            Log::error($e);
            DB::rollBack();

            return [
                'status'   => 'error',
                'message'   => 'Failed to retrieve approve data, please try again later',
            ];
        }
    }
}
