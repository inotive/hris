<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeEmergencyContact;
use App\Traits\CrudTrait;
use Exception;
use Illuminate\Http\Request;

class EmployeeEmergencyContactController extends Controller
{

    public function index(Employee $employee, Request $request)
    {
        $list = EmployeeEmergencyContact::where('employee_id', $employee->id)
            ->paginate();

        return view('employee_emergency_contacts.index',[
            'list'  => $list,
            'employee'  => $employee,
        ]);
    }


    public function create(Employee $employee, Request $request)
    {
        return view('employee_emergency_contacts.create',[
            'employee'  => $employee,
        ]);
    }

    public function edit(Employee $employee, $id, Request $request)
    {
        return view('employee_emergency_contacts.edit',[
            'employee'  => $employee,
            'form'  => EmployeeEmergencyContact::find($id),
        ]);
    }


    public function store(Employee $employee, Request $request)
    {

        $request->validate((new EmployeeEmergencyContact())->rules);

        $form = new EmployeeEmergencyContact();
        $form->fill($request->all());
        $form->save();

        return [
            'success'   => true,
            'message'   => __('Data Saved Successfully'),
            'redirect'  => route('emergency-contact.index', $employee),
        ];
    }


    public function update(Employee $employee, $id, Request $request)
    {

        $request->validate((new EmployeeEmergencyContact())->rules);


        $form = EmployeeEmergencyContact::find($id);
        $form->fill($request->all());
        $form->save();

        return [
            'success'   => true,
            'message'   => __('Data Saved Successfully'),
            'redirect'  => route('emergency-contact.index', $employee),
        ];
    }


    public function destroy(Employee $employee, $id, Request $request)
    {
        try{

            EmployeeEmergencyContact::where('id', $id)->delete();
        
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
