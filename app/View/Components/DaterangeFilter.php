<?php

namespace App\View\Components;

use App\Models\Company;
use Illuminate\View\Component;

class DaterangeFilter extends Component
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
   

        
        return view('components.table.daterange-picker-filter',[
            'name'  => 'date_range',
            'label' => __('Date Range'),
            'placeholder' => __('Date Range'),
            'value' => request()->filter['date_range'] ?? null,
        ]);
    }
}
