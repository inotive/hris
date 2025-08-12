<?php

namespace App\View\Components;

use App\Models\Company;
use App\Models\EmployeeDepartment;
use App\Models\User;
use Illuminate\View\Component;

class EmployeeStatusFilter extends Component
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
   

        $list =[
            '3'=>'Semua',
            '1' => 'Aktif',
            '0' => 'Tidak Aktif',
        ];


        $value_name = "Semua";
        if (request()->filter != null && request()->filter['filter_status'] != null) {
            $value_name = \App\Models\EmployeeDepartment::pluck('name', 'id')[request()->filter['filter_department_id']] ?? '';
        }
        
        return view('components.table.dropdown-filter',[
            'list'  => $list,
            'name'  => 'filter_status',
            'label' => __('Status'),
            'placeholder' => __('Filtered') . ' ' . __('Status'),
            'value' => request()->filter['filter_status'] ?? '3',
            'value_name'  => $value_name,  
        ]);
    }
}
