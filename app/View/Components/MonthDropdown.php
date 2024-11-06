<?php

namespace App\View\Components;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\View\Component;

class MonthDropdown extends Component
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
        $list = Attendance::monthDropdown();

        $dropdown = [];
        foreach ($list as $key => $value) {
            $dropdown[$value['key']] = $value['value'];
        }

        return view('components.form.select',[
            'label' => __('Month'),
            'name'  => 'month',
            'list'  => $dropdown,
            'value' => date('m'),
        ]);
    }
}
