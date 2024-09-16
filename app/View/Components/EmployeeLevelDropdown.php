<?php

namespace App\View\Components;

use App\Models\EmployeeDepartment;
use App\Models\EmployeeLevel;
use App\Models\EmployeePosition;
use Illuminate\View\Component;

class EmployeeLevelDropdown extends Component
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
        $list = EmployeeLevel::orderBy('name','asc')->pluck('name','id');
        return view('components.form.select',[
            'list'  => $list,
            'name'  => 'employee_level_id',
            'label' => __('Employee Level'),
        ]);
    }
}
