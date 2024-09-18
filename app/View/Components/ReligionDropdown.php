<?php

namespace App\View\Components;

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
        $list = [
            'Islam'  => 'Islam',
            'Kristen Katolik'  => 'Kristen Katolik',
            'Kristen Protestan'  => 'Kristen Protestan',
            'Hindu'  => 'Hindu',
            'Budha'  => 'Budha',
            'Konghuchu'  => 'Konghuchu',
            'Lainnya'  => 'Lainnya',
        ];
        return view('components.form.select',[
            'list'  => $list,
            'name'  => 'religion',
            'label' => __('Religion'),
        ]);
    }
}
