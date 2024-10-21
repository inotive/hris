<?php

namespace App\View\Components;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\View\Component;

class NationalityDropdown extends Component
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

    public static function dropdown()
    {
        $countries = [
            "Indonesia" => "Indonesia",
            "Malaysia" => "Malaysia",
            "Singapore" => "Singapore",
            "Thailand" => "Thailand",
            "Philippines" => "Philippines",
            "United States" => "United States",
            "Australia" => "Australia",
            "United Kingdom" => "United Kingdom",
            "China" => "China",
            "Japan" => "Japan",
            "South Korea" => "South Korea",
            "India" => "India",
            "Germany" => "Germany",
            "France" => "France",
            "Canada" => "Canada"
        ];


        return $countries;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $list = self::dropdown();
        return view('components.form.select', [
            'list'  => $list,
        ]);
    }
}
