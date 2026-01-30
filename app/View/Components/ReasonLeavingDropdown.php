<?php

namespace App\View\Components;

use App\Models\Company;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Illuminate\View\Component;

class ReasonLeavingDropdown extends Component
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
        $list = LeaveRequest::reasonLeavingDropdown();
        return view('components.form.select',[
            'list'  => $list,
            'label' => __('Reason Leaving'),
            'name'  => 'reason_leaving',
        ]);
    }
}
