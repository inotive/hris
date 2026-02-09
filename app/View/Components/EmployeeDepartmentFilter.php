<?php

namespace App\View\Components;

use App\Models\Company;
use App\Models\EmployeeDepartment;
use App\Models\User;
use Illuminate\View\Component;

class EmployeeDepartmentFilter extends Component
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
   

        $company_id = auth()->user()->company_id ?? request()->filter['company_id'] ?? null;

        if ($company_id == null) {
            // Global filter: Group by Name
            $list = EmployeeDepartment::distinct()->orderBy('name', 'asc')->pluck('name', 'name');
        } else {
            // Company specific filter: Filter by ID
            $list = EmployeeDepartment::where('company_id', $company_id)->orderBy('name', 'asc')->pluck('name', 'id');
        }


        $value_name = null;
        if (request()->filter != null && request()->filter['filter_department_id'] != null) {
            $value_name = \App\Models\EmployeeDepartment::pluck('name', 'id')[request()->filter['filter_department_id']] ?? '';
        }
        
        return view('components.table.dropdown-filter',[
            'list'  => $list,
            'name'  => 'filter_department_id',
            'label' => __('Department'),
            'placeholder' => __('Filtered') . ' ' . __('Department'),
            'value' => request()->filter['filter_department_id'] ?? null,
            'value_name'  => $value_name,  
        ]);
    }
}
