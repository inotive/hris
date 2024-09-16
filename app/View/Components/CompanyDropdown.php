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
        $list = Company::orderBy('name','asc')->pluck('name','id');

        return view('components.form.select',[
            'list'  => $list,
            'name'  => 'company_id',
            'label' => __('Company'),
            'value' => $this->value,
        ]);
    }
}
