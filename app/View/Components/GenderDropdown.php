<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GenderDropdown extends Component
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
            'Laki-laki'  => 'Laki-laki',
            'Perempuan'  => 'Perempuan',
        ];
        return view('components.form.select',[
            'list'  => $list,
            'name'  => 'gender',
            'label' => __('Gender'),
        ]);
    }
}
