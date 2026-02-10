<?php

namespace App\View\Components;

use App\Models\EmployeeDepartment;
use App\Models\EmployeePosition;
use Illuminate\View\Component;

class EmployeePositionDropdown extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $departmentId;

    public function __construct($departmentId = null)
    {
        $this->departmentId = $departmentId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $list = [];
        if($this->departmentId){
             $list = EmployeePosition::where('department_id', $this->departmentId)->orderBy('name', 'asc')->pluck('name', 'id');
        }
        return view('components.form.employee-position',[
            'list'  => $list,
            'name'  => 'employee_position_id',
            'label' => __('Employee Position'),
            'add_class' => 'employee_position_id',
        ]);
    }
}
