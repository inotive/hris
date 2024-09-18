<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MaritalStatusDropdown extends Component
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
            'Lajang'  => 'Lajang',
            'Menikah'  => 'Menikah',
            'Cerai Hidup'  => 'Cerai Hidup',
            'Cerai Mati'  => 'Cerai Mati',
        ];
        return view('components.form.select',[
            'list'  => $list,
            'name'  => 'marital_status',
            'label' => __('Marital Status'),
        ]);
    }
}
