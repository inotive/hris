<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class RoleDropdown extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public $value)
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
        $list = User::role_options();
        return view('components.form.select',[
            'label' => __('Role'),
            'name'  => 'role',
            'list'  => $list,
            'value' => $this->value,
        ]);
    }
}
