<?php

namespace App\View\Components;

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
        $list = [
            'SD'  => 'SD',
            'SMP'  => 'SMP',
            'SMA'  => 'SMA',
            'SMK'  => 'SMK',
            'D3'  => 'D3',
            'S1'  => 'S1',
            'S2'  => 'S2',
            'S3'  => 'S3',
            'Lainnya'  => 'Lainnya',
        ];
        return view('components.form.select',[
            'list'  => $list,
            'name'  => 'education_level',
            'label' => __('Education Level'),
        ]);
    }
}
