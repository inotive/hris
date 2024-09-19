<?php

namespace App\View\Components;

use Illuminate\View\Component;

class EmployeeEditTab extends Component
{


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public $employeeid, public $tab)
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
        $tabs = [
            [
                'code'  => 'edit',
                'route' => route('employees.edit', $this->employeeid),
                'label' => __('Profile'),
            ],

            [
                'code'  => 'emergency_contact',
                'route' => route('emergency-contact.index', $this->employeeid),
                'label' => __('Emergency Contact'),
            ],

            [
                'code'  => 'family_info',
                'route' => route('family-info.index', $this->employeeid),
                'label' => __('Family Info'),
            ],

            [
                'code'  => 'education',
                'route' => route('education.index', $this->employeeid),
                'label' => __('Education'),
            ],
        ];
        return view('components.tab',[
            'tabs'  => $tabs,
        ]);
    }
}
