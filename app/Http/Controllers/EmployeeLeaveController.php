<?php

namespace App\Http\Controllers;

use App\Models\Approver;
use App\Models\Employee;
use App\Models\EmployeeLeaveType;
use App\Models\EmployeeOrganizationExperience;

use App\Services\LeaveTypeService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployeeLeaveController extends Controller
{
    public function index(Employee $employee, Request $request)
    {
        $list = collect(LeaveTypeService::leaveTypeByEmployee($employee->id));

        return view('employee_leave.index',[
            'list'  => $list,
            'employee'  => $employee,
        ]);
    }


    public function create(Employee $employee, Request $request)
    {
        return view('employee_leave.create',[
            'employee'  => $employee,
        ]);
    }

    public function edit(Employee $employee, $id, Request $request)
    {
        $form = collect(LeaveTypeService::leaveTypeByEmployee($employee->id, $id))->first();

        return view('employee_leave.edit',[
            'employee'  => $employee,
            'form'  => $form,
        ]);
    }


    public function store(Employee $employee, Request $request)
    {


        return [
            'success'   => true,
            'message'   => __('Data Saved Successfully'),
            'redirect'  => route('leave.index', $employee),
        ];
    }


    public function update(Employee $employee, $id, Request $request)
    {


        $form = EmployeeLeaveType::where('leave_type_id',$id)
            ->where('employee_id', $employee->id)
            ->first() ?? new EmployeeLeaveType();
        $form->leave_type_id = $id;
        $form->employee_id = $employee->id;
        $form->days_limit = $request->limit;
        $form->save();

        return [
            'success'   => true,
            'message'   => __('Data Saved Successfully'),
            'redirect'  => route('leave.index', $employee),
        ];
    }


    public function destroy(Employee $employee, $id, Request $request)
    {
        try{

            Approver::where('id', $id)->delete();

            return [
                'success'   => true,
                'meessage'  => 'Deleted',
            ];
        }catch(Exception $e) {

            return [
                'success'   => false,
                'meessage'  => 'Error',
            ];
        }
    }
}
