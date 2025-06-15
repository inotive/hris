<?php

namespace App\View\Components;

use App\Models\Company;
use App\Models\User;
use Illuminate\View\Component;

class PaymentStatusFilter extends Component
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
        $selected = null;
        if (request()->filter != null && isset(request()->filter['payment_status'])) {
            $selected = request()->filter['payment_status'];
        }


        return view('components.table.filter-status',[
            'selected'    => $selected,
            'name'               => 'payment_status',
            'placeholder'        => 'Payment Status',
        ]);
    }
}
