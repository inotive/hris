<?php

namespace App\View\Components;

use App\Models\Company;
use App\Models\Employee;
use App\Models\EmployeePayslipMaster;
use Illuminate\View\Component;

class EmployeePayslipMasterDropdown extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public $value)
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
        $list = EmployeePayslipMaster::orderBy('name','asc')->pluck('name','id');

        return view('components.form.select',[
            'list'  => $list,
            'name'  => 'employee_payslip_master_id',
            'label' => __('Payslip Master'),
            'value' => $this->value,
        ]);
    }
}
