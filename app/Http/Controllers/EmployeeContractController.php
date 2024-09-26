<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeContract;

use Exception;
use Illuminate\Http\Request;

class EmployeeContractController extends Controller
{
    public function index(Employee $employee, Request $request)
    {
        $list = EmployeeContract::where('employee_id', $employee->id)
            ->paginate();

        return view('employee_contract.index',[
            'list'  => $list,
            'employee'  => $employee,
        ]);
    }


    public function create(Employee $employee, Request $request)
    {
        return view('employee_contract.create',[
            'employee'  => $employee,
        ]);
    }

    public function edit(Employee $employee, $id, Request $request)
    {
        return view('employee_contract.edit',[
            'employee'  => $employee,
            'form'  => EmployeeContract::find($id),
        ]);
    }


    public function store(Employee $employee, Request $request)
    {

        $request->validate((new EmployeeContract())->rules);

        $form = new EmployeeContract();
        $form->fill($request->all());
        $form->save();

        return [
            'success'   => true,
            'message'   => __('Data Saved Successfully'),
            'redirect'  => route('contract.index', $employee),
        ];
    }


    public function update(Employee $employee, $id, Request $request)
    {

        $request->validate((new EmployeeContract())->rules);

        $form = EmployeeContract::find($id);
        $form->fill($request->all());
        $form->save();

        return [
            'success'   => true,
            'message'   => __('Data Saved Successfully'),
            'redirect'  => route('contract.index', $employee),
        ];
    }


    public function destroy(Employee $employee, $id, Request $request)
    {
        try{

            EmployeeContract::where('id', $id)->delete();
        
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
