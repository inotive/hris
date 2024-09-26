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
        $list = [];
            
        return view('components.form.select',[
            'list'  => $list,
            'name'  => 'manager_id',
            'add_class' => 'manager_id',
        ]);
    }
}
