<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeOrganizationExperience;

use Exception;
use Illuminate\Http\Request;

class EmployeeOrganizationExperienceController extends Controller
{
    public function index(Employee $employee, Request $request)
    {
        $list = EmployeeOrganizationExperience::where('employee_id', $employee->id)
            ->paginate();

        return view('employee_organization_experiences.index',[
            'list'  => $list,
            'employee'  => $employee,
        ]);
    }


    public function create(Employee $employee, Request $request)
    {
        return view('employee_organization_experiences.create',[
            'employee'  => $employee,
        ]);
    }

    public function edit(Employee $employee, $id, Request $request)
    {
        return view('employee_organization_experiences.edit',[
            'employee'  => $employee,
            'form'  => EmployeeOrganizationExperience::find($id),
        ]);
    }


    public function store(Employee $employee, Request $request)
    {

        $request->validate((new EmployeeOrganizationExperience())->rules);

        $form = new EmployeeOrganizationExperience();
        $form->fill($request->all());
        $form->save();

        return [
            'success'   => true,
            'message'   => __('Data Saved Successfully'),
            'redirect'  => route('organization-experience.index', $employee),
        ];
    }


    public function update(Employee $employee, $id, Request $request)
    {
        $request->validate((new EmployeeOrganizationExperience())->rules);

        $form = EmployeeOrganizationExperience::find($id);
        $form->fill($request->all());
        $form->save();

        return [
            'success'   => true,
            'message'   => __('Data Saved Successfully'),
            'redirect'  => route('organization-experience.index', $employee),
        ];
    }


    public function destroy(Employee $employee, $id, Request $request)
    {
        try{

            EmployeeOrganizationExperience::where('id', $id)->delete();
        
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
