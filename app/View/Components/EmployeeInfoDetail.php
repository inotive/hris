<?php

namespace App\View\Components;

use App\Models\Employee;
use Illuminate\View\Component;

class EmployeeInfoDetail extends Component
{

    public $employeeid;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($employeeid)
    {
        //
        $this->employeeid = $employeeid;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $employee = Employee::where('id', $this->employeeid)->first();
        return view('components.employee-info-detail',[
            'employee'   => $employee
        ]);
    }
}
