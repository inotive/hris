<?php

namespace App\Exports;

use App\Models\Employee;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class EmployeeExport implements FromView
{
    use Exportable;

    public function __construct(public $company_id = null)
    {
        
    }
 

    public function view(): View
    {
        $employees = Employee::when($this->company_id != null, function($query){
            return $query->where('company_id', $this->company_id);
        })->get();
        return view('exports.employees', [
            'employees' => $employees,
        ]);
    }
}
