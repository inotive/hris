<?php

namespace App\View\Components;

use App\Models\EmployeeDepartment;
use App\Models\EmployeeLevel;
use App\Models\EmployeePosition;
use Illuminate\View\Component;

class FamilyRelationDropdown extends Component
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
            'Ayah'  => 'Ayah',
            'Ibu'  => 'Ibu',
            'Adik'  => 'Adik',
            'Kakak'  => 'Kakak',
        ];
        return view('components.form.select',[
            'list'  => $list,
            'name'  => 'family_relation',
            'label' => __('Family Relation'),
        ]);
    }
}
