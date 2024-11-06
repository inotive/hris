<?php

namespace App\Http\Controllers;

use App\Models\Approver;
use App\Models\Employee;
use App\Models\EmployeeOrganizationExperience;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployeeApproverController extends Controller
{
    public function index(Employee $employee, Request $request)
    {
        $list = Approver::where('employee_id', $employee->id)
            ->orderBy('approver_level','asc')
            ->paginate();

        return view('employee_approver.index',[
            'list'  => $list,
            'employee'  => $employee,
        ]);
    }


    public function create(Employee $employee, Request $request)
    {
        return view('employee_approver.create',[
            'employee'  => $employee,
        ]);
    }

    public function edit(Employee $employee, $id, Request $request)
    {
        return view('employee_approver.edit',[
            'employee'  => $employee,
            'form'  => Approver::find($id),
        ]);
    }


    public function store(Employee $employee, Request $request)
    {

        $request->validate((new Approver())->rules);



        $form = new Approver();
        $form->fill($request->all());
        $form->save();

        return [
            'success'   => true,
            'message'   => __('Data Saved Successfully'),
            'redirect'  => route('approver.index', $employee),
        ];
    }


    public function update(Employee $employee, $id, Request $request)
    {
        $request->validate((new Approver())->rules);

        $form = Approver::find($id);
        $form->fill($request->all());
        $form->save();

        return [
            'success'   => true,
            'message'   => __('Data Saved Successfully'),
            'redirect'  => route('approver.index', $employee),
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
