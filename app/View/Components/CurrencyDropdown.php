<?php

namespace App\View\Components;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\View\Component;

class CurrencyDropdown extends Component
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
            'IDR'  => 'IDR',
            'EUR'  => 'EUR',
            'GBP'  => 'GBP',
            'INR'  => 'INR',
            'JPY'  => 'JPY',
            'USD'  => 'USD',
            'YEN'  => 'YEN',
            'MYR'  => 'MYR',
            'SGD'  => 'SGD',
            'VND'  => 'VND',
            'THB'  => 'THB',
        ];
        return view('components.form.select',[
            'list'  => $list,
        ]);
    }
}
