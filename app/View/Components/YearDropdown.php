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
        $list = Attendance::monthDropdown();
        return view('components.form.select',[
            'label' => __('Month'),
            'name'  => 'month',
            'list'  => $list,
            'value' => date('m'),
        ]);
    }
}
