<?php

namespace App\View\Components;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class HeadDepartmentEmployeeDropdown extends Component
{
    // public $label = null;
    public $value = null;
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
        $list = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name) as name"), 'id')
            ->orderBy('name', 'asc')
            ->pluck('name', 'id');

            $label = __($this->label ?? 'Head');

        return view('components.form.select',[
            'list'  => $list,
            'name'  => 'head_departmen_id',
            'label' =>  $label,
            'value' => $this->value,
        ]);
    }
}
