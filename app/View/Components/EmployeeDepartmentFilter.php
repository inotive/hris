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
   

        $list =EmployeeDepartment::orderBy('name', 'asc')

            ->when(auth()->user()->company_id != null, function ($query) {
                $query->where('company_id', auth()->user()->company_id);
            })
            ->pluck('name', 'id');


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
