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
        $list = Company::orderBy('name','asc')
        ->when(auth()->user()->company_id != null, function ($query){
            $query->where('id', auth()->user()->company_id);
        })
        ->pluck('name','id');

        
        return view('components.table.dropdown-filter',[
            'list'  => $list,
            'name'  => 'company_id',
            'label' => __('Company'),
            'placeholder' => __('Filtered') . ' ' . __('Company'),
            'value' => request()->filter['company_id'] ?? null,
        ]);
    }
}
