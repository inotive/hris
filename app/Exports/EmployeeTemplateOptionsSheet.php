<?php

namespace App\Exports;

use App\Models\Company;
use App\Models\Employee;
use App\Models\EmployeeDepartment;
use App\Models\EmployeeLevel;
use App\Models\EmployeePosition;
use App\Models\EmployeeShift;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;

class EmployeeTemplateOptionsSheet implements FromCollection, WithTitle
{
    protected $company_id;

    public function __construct($company_id = null)
    {
        $this->company_id = $company_id;
    }

    public function collection()
    {
        // 1. Fetch Data
        $data = [
            'companies' => Company::pluck('name')->toArray(),
            'departments' => EmployeeDepartment::when($this->company_id, fn($q) => $q->where('company_id', $this->company_id))->pluck('name')->toArray(),
            'positions' => EmployeePosition::when($this->company_id, fn($q) => $q->where('company_id', $this->company_id))->pluck('name')->toArray(),
            'levels' => EmployeeLevel::when($this->company_id, fn($q) => $q->where('company_id', $this->company_id))->pluck('name')->toArray(),
            'shifts' => EmployeeShift::when($this->company_id, fn($q) => $q->where('company_id', $this->company_id))->pluck('name')->toArray(),
            'genders' => array_keys(Employee::genderDropdown()),
            'religions' => array_keys(Employee::religionDropdown()),
            'marital_statuses' => array_keys(Employee::maritalStatusDropdown()),
            'status' => ['Active', 'Inactive'],
            'yes_no' => ['Yes', 'No'],
        ];

        // 2. Determine Max Length for uniform rows
        $maxLength = 0;
        foreach ($data as $list) {
            $maxLength = max($maxLength, count($list));
        }

        // 3. Transpose Data (Columns: Comp, Dept, Pos, Lvl, Shift, Gender, Religion, Marital, Status, YesNo)
        $output = [];
        for ($i = 0; $i < $maxLength; $i++) {
            $row = [];
            $row[] = $data['companies'][$i] ?? null;    // A
            $row[] = $data['departments'][$i] ?? null;  // B
            $row[] = $data['positions'][$i] ?? null;    // C
            $row[] = $data['levels'][$i] ?? null;       // D
            $row[] = $data['shifts'][$i] ?? null;       // E
            $row[] = $data['genders'][$i] ?? null;      // F
            $row[] = $data['religions'][$i] ?? null;    // G
            $row[] = $data['marital_statuses'][$i] ?? null; // H
            $row[] = $data['status'][$i] ?? null;       // I
            $row[] = $data['yes_no'][$i] ?? null;       // J
            $output[] = $row;
        }

        return collect($output);
    }

    public function title(): string
    {
        return 'Options';
    }
}
