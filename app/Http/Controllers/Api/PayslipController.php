<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PayslipDetailResource;
use App\Http\Resources\PayslipResource;
use App\Models\EmployeePayslip;
use Illuminate\Http\Request;

class PayslipController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $year = $request->year ?? now()->format('Y');

        $payslips = EmployeePayslip::where('employee_id', $user->id)
            ->where('year', $year)
            ->get();


        return [
            'status'    => 'success',
            'data'  => PayslipResource::collection($payslips),
        ];
    }

    public function detail($id, Request $request)
    {

        $data = EmployeePayslip::with([
            'earning_details',
            'deduction_details',

        ])->where('id',$id)->first();
        return [
            'status'    => 'success',
            'data'  => new PayslipDetailResource($data),
        ];
    }
}
