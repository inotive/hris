<?php

namespace App\View\Components;

use App\Models\Company;
use Illuminate\View\Component;

class CompanyFilter extends Component
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
        if (auth()->user()->company_id != null) {
            return null;
        }

        $list = [];

        $value_name = null;
        if (request()->filter != null && request()->filter['company_id'] != null) {
            $value_name = Company::where('id', request()->filter['company_id'])->first()->name ?? '';
        }
        
        return view('components.table.dropdown-filter',[
            'list'  => $list,
            'name'  => 'company_id',
            'label' => __('Company'),
            'placeholder' => __('Filtered') . ' ' . __('Company'),
            'value' => request()->filter['company_id'] ?? null,
            'value_name'  => $value_name,  
        ]);
    }
}
