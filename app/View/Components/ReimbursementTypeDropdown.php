<?php

namespace App\View\Components;

use App\Models\Employee;
use App\Models\EmployeeDepartment;
use App\Models\EmployeeLevel;
use App\Models\EmployeePosition;
use App\Models\EmployeeShift;
use App\Models\LeaveType;
use App\Models\ReimbursementType;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class ReimbursementTypeDropdown extends Component
{

    public $value;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($value = null)
    {
        $this->value = $value;


    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $list = ReimbursementType::select([
            'name',
            'id'
        ])
            ->orderBy('name','asc')
            ->pluck('name','id');
            
        return view('components.form.select',[
            'list'  => $list,
            'name'  => 'reimbursement_type_id',
            'label' => __('Type'),
            'value' => $this->value,
            'add_class' => 'reimbursement_type_id',
            'data_name' => ReimbursementType::where('id', $this->value)->first()->name ?? 'Select'
        ]);
    }
}
