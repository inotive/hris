<?php

namespace App\View\Components;

use App\Models\Employee;
use Illuminate\View\Component;

class ReligionDropdown extends Component
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
        $list = Employee::religionDropdown();
        return view('components.form.select',[
            'list'  => $list,
            'name'  => 'religion',
            'label' => __('Religion'),
        ]);
    }
}
