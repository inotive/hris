<?php

namespace App\View\Components;

use App\Models\EmployeeEducation;
use Illuminate\View\Component;

class EducationLevelDropdown extends Component
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
        $list = EmployeeEducation::educationLevelDropdown();
        return view('components.form.select',[
            'list'  => $list,
            'name'  => 'education_level',
            'label' => __('Education Level'),
        ]);
    }
}
