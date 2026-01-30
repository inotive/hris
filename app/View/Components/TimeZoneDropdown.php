<?php

namespace App\View\Components;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\View\Component;

class TimeZoneDropdown extends Component
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

        $timezones = timezone_identifiers_list();

        $list = [];
        foreach($timezones as $key => $value) {
            $list[$value] = $value;
        }


        return view('components.form.select',[
            'list'  => $list,
            'name'  => 'time_zone',
            'label' => __('Time Zone'),
        ]);
    }
}
