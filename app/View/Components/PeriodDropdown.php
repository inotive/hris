<?php

namespace App\View\Components;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\View\Component;

class PeriodDropdown extends Component
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
            'Waktu (Jam)'  => 'Waktu (Jam)',
            'Harian'  => 'Harian',
            'Bulanan'  => 'Bulanan',
            'Tahunan'  => 'Tahunan',
            'Lainnya'  => 'Lainnya',
        ];
        return view('components.form.select',[
            'list'  => $list,
        ]);
    }
}