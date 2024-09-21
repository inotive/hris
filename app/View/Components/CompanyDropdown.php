<?php

namespace App\View\Components;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\View\Component;

class CompanyDropdown extends Component
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
        // if user has company_id
        // use input hide 
        if (auth()->user()->company_id != null) {
            return view('components.form.hidden',[
                'name'  => 'company_id',
                'value' => auth()->user()->company_id,
            ]);
        }

        $list = Company::orderBy('name','asc')
            ->when(auth()->user()->company_id != null, function ($query){
                $query->where('id', auth()->user()->company_id);
            })
            ->pluck('name','id');

        return view('components.form.select',[
            'list'  => $list,
            'name'  => 'company_id',
            'label' => __('Company'),
        ]);
    }
}
