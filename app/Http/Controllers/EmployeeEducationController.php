<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeEducation;

use Exception;
use Illuminate\Http\Request;

class EmployeeEducationController extends Controller
{
    public function index(Employee $employee, Request $request)
    {
        $list = EmployeeEducation::search($request->search)->where('employee_id', $employee->id)
            ->paginate();

        return view('employee_education.index',[
            'list'  => $list,
            'employee'  => $employee,
        ]);
    }


    public function create(Employee $employee, Request $request)
    {
        return view('employee_education.create',[
            'employee'  => $employee,
        ]);
    }

    public function edit(Employee $employee, $id, Request $request)
    {
        return view('employee_education.edit',[
            'employee'  => $employee,
            'form'  => EmployeeEducation::find($id),
        ]);
    }


    public function store(Employee $employee, Request $request)
    {

        $request->validate((new EmployeeEducation())->rules);

        $form = new EmployeeEducation();
        $form->fill($request->all());
        $form->save();

        return [
            'success'   => true,
            'message'   => __('Data Saved Successfully'),
            'redirect'  => route('education.index', $employee),
        ];
    }


    public function update(Employee $employee, $id, Request $request)
    {

        $request->validate((new EmployeeEducation())->rules);

        $form = EmployeeEducation::find($id);
        $form->fill($request->all());
        $form->save();

        return [
            'success'   => true,
            'message'   => __('Data Saved Successfully'),
            'redirect'  => route('education.index', $employee),
        ];
    }


    public function destroy(Employee $employee, $id, Request $request)
    {
        try{

            EmployeeEducation::where('id', $id)->delete();
        
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
