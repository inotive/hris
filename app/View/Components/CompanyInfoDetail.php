<?php

namespace App\View\Components;

use App\Models\Company;
use Illuminate\View\Component;

class CompanyInfoDetail extends Component
{

    public $companyid;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($companyid)
    {
        //
        $this->companyid = $companyid;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $company = Company::where('id', $this->companyid)->first();
        return view('components.company-info-detail',[
            'company'   => $company
        ]);
    }
}
