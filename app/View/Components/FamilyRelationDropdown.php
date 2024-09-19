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
            'Kakak Laki-laki'  => 'Kakak Laki-laki',
            'Kakak Perempuan'  => 'Kakak Perempuan',
            'Adik Laki-laki'  => 'Adik Laki-laki',
            'Adik Perempuan'  => 'Adik Perempuan',
            'Kakek'  => 'Kakek',
            'Nenek'  => 'Nenek',
            'Sepupu Laki-laki'  => 'Sepupu Laki-laki',
            'Sepupu Perempuan'  => 'Sepupu Perempuan',
            'Tante'  => 'Tante',
            'Paman'  => 'Paman',
            'Lainnya'  => 'Lainnya',
        ];
        return view('components.form.select',[
            'list'  => $list,
            'name'  => 'family_relation',
            'label' => __('Family Relation'),
        ]);
    }
}
