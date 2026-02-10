<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\Exportable;

class EmployeeTemplateExport implements WithMultipleSheets
{
    use Exportable;

    protected $company_id;

    public function __construct($company_id = null)
    {
        $this->company_id = $company_id;
    }

    public function sheets(): array
    {
        return [
            new EmployeeTemplateDataSheet($this->company_id),
            new EmployeeTemplateOptionsSheet($this->company_id),
        ];
    }
}
