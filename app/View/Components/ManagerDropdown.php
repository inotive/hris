<?php

namespace App\View\Components;

use App\Models\Employee;
use App\Models\EmployeeDepartment;
use App\Models\EmployeeLevel;
use App\Models\EmployeePosition;
use App\Models\EmployeeShift;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class ManagerDropdown extends Component
{

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $list = Employee::select([
            DB::raw('CONCAT(first_name, " ", last_name, " (" , username , ")") as name'),
            'id'
        ])
            ->orderBy('first_name','asc')
            ->pluck('name','id');
            
        return view('components.form.select',[
            'list'  => $list,
            'name'  => 'manager_id',
        ]);
    }
}
