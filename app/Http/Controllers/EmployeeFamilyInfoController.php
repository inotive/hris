<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeFamilyInfo;
use Exception;
use Illuminate\Http\Request;

class EmployeeFamilyInfoController extends Controller
{
    public function index(Employee $employee, Request $request)
    {
        $list = EmployeeFamilyInfo::where('employee_id', $employee->id)
            ->paginate();

        return view('employee_family_info.index',[
            'list'  => $list,
            'employee'  => $employee,
        ]);
    }


    public function create(Employee $employee, Request $request)
    {
        return view('employee_family_info.create',[
            'employee'  => $employee,
        ]);
    }

    public function edit(Employee $employee, $id, Request $request)
    {
        return view('employee_family_info.edit',[
            'employee'  => $employee,
            'form'  => EmployeeFamilyInfo::find($id),
        ]);
    }


    public function store(Employee $employee, Request $request)
    {

        $form = new EmployeeFamilyInfo();
        $form->fill($request->all());
        $form->save();

        return [
            'success'   => true,
            'message'   => __('Data Saved Successfully'),
            'redirect'  => route('family-info.index', $employee),
        ];
    }


    public function update(Employee $employee, $id, Request $request)
    {

        $form = EmployeeFamilyInfo::find($id);
        $form->fill($request->all());
        $form->save();

        return [
            'success'   => true,
            'message'   => __('Data Saved Successfully'),
            'redirect'  => route('family-info.index', $employee),
        ];
    }


    public function destroy(Employee $employee, $id, Request $request)
    {
        try{

            EmployeeFamilyInfo::where('id', $id)->delete();
        
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
