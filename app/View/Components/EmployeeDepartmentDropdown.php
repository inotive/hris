<?php

namespace App\View\Components;

use App\Models\EmployeeDepartment;
use Illuminate\View\Component;

class EmployeeDepartmentDropdown extends Component
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
        $list = EmployeeDepartment::orderBy('name','asc')->pluck('name','id');
        return view('components.form.select',[
            'list'  => $list,
            'name'  => 'department_id',
            'label' => __('Department'),
            'add_class' => 'employee-department',
        ]);
    }
}
