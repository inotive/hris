<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CompanyEditTab extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public $companyid, public $tab)
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
                'route' => route('companies.edit', $this->companyid),
                'label' => __('Profile'),
            ],

            [
                'code'  => 'payout_setting',
                'route' => route('companies.payout-setting', [$this->companyid, date('Y')]),
                'label' => __('Payout Setting'),
            ],
        ];
        return view('components.tab',[
            'tabs'  => $tabs,
        ]);

    }
}
