<?php

namespace App\View\Components;

use App\Models\Company;
use App\Models\User;
use Illuminate\View\Component;

class MonthYearFilter extends Component
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
        $months = \App\Models\Attendance::monthDropdown();
        $years = \App\Models\Attendance::yearDropdown();

        $month_selected = null;
        if (request()->filter != null && isset(request()->filter['month'])) {
            $month_selected = request()->filter['month'];
        }


        $year_selected = null;
        if (request()->filter != null && isset(request()->filter['year']) ) {
            $year_selected = request()->filter['year'];
        }

        
        return view('components.table.filter-month-year',[
            'months'=> $months,
            'years'=> $years,

            'month_selected'    => $month_selected,
            'year_selected'    => $year_selected,
            
        ]);
    }
}
