<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class EmployeeImport implements WithMultipleSheets
{

    protected $company_id;

    public function __construct($company_id = null)
    {
        $this->company_id = $company_id;
    }

    public function sheets(): array
    {
        return [
            'Employee Template' => new EmployeeSheetImport($this->company_id),
        ];
    }
}
