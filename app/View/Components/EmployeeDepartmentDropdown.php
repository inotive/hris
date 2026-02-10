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
             $list = EmployeeDepartment::where('company_id', $this->companyId)->orderBy('name', 'asc')->pluck('name', 'id');
        }

        return view('components.form.employee-department', [
            'list'  => $list,
            'name'  => 'department_id',
            'label' => __('Department'),
            'add_class' => 'department_id',
        ]);
    }
}
