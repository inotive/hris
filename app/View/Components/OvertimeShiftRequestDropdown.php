<?php

namespace App\View\Components;

use App\Models\Employee;
use App\Models\EmployeeDepartment;
use App\Models\EmployeeLevel;
use App\Models\EmployeePosition;
use App\Models\EmployeeShift;
use App\Models\LeaveType;
use App\Models\OvertimeShiftRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class OvertimeShiftRequestDropdown extends Component
{

    public $value;
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
        $list = OvertimeShiftRequest::select([
            'name',
            'id'
        ])
            ->orderBy('name','asc')
            ->pluck('name','id');
            
        return view('components.form.select',[
            'list'  => $list,
            'name'  => 'overtime_shift_request_id',
            'label' => __('Shift Type'),
            'value' => $this->value,
        ]);
    }
}
