<?php

namespace App\View\Components;

use App\Models\EmployeeDepartment;
use App\Models\EmployeeLevel;
use App\Models\EmployeePosition;
use App\Models\EmployeeShift;
use Illuminate\View\Component;

class EmployeeShiftDropdown extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $companyId;

    public function __construct($companyId = null)
    {
        $this->companyId = $companyId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $list = [];
        if($this->companyId){
             $list = EmployeeShift::where('company_id', $this->companyId)->orderBy('name','asc')->pluck('name','id');
        }
        return view('components.form.select',[
            'list'  => $list,
            'name'  => 'employee_shift_id',
            'label' => __('Employee Shift'),
        ]);
    }
}
