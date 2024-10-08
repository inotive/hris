<?php

namespace App\View\Components;

use App\Models\Company;
use App\Models\User;
use Illuminate\View\Component;

class RoleFilter extends Component
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
   

        $list =User::role_options();


        $value_name = null;
        if (request()->filter != null && request()->filter['role'] != null) {
            $value_name = \App\Models\User::role_options()[request()->filter['role']] ?? '';
        }
        
        return view('components.table.dropdown-filter',[
            'list'  => $list,
            'name'  => 'role',
            'label' => __('Role'),
            'placeholder' => __('Filtered') . ' ' . __('Role'),
            'value' => request()->filter['role'] ?? null,
            'value_name'  => $value_name,  
        ]);
    }
}
