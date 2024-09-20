<?php

namespace App\Http\Controllers;

use App\Jobs\NewPasswordJob;
use App\Models\Employee;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    use CrudTrait;

    public $model = Employee::class;
    public $route = 'employees'; 
    public $page_title = 'Employee';


    public function resetPassword($id, Request $request)
    {
        $new_pass = rand(100000,999999) . uniqid();
        
        $employee = Employee::find($id);
        $employee->password = bcrypt($new_pass);
        $employee->save();

        NewPasswordJob::dispatch($employee->email, $new_pass);

        return [
            'success'   => true,
            'message'   => __('Send Password To Email Successfully'),
        ];
    }
}
