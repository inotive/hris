<?php

namespace App\Exports;

use App\Models\Employee;
use App\Models\EmployeeDepartment;
use App\Models\EmployeeLevel;
use App\Models\EmployeePosition;
use App\Models\EmployeeShift;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class EmployeeTemplateExport implements FromCollection, WithHeadings, WithEvents, WithStrictNullComparison, WithTitle, WithStyles, ShouldAutoSize
{
    use Exportable;

    protected $company_id;

    public function __construct($company_id = null)
    {
        $this->company_id = $company_id;
    }

    public function collection()
    {
        $companyName = '';
        if ($this->company_id) {
             $company = \App\Models\Company::find($this->company_id);
             $companyName = $company?->name ?? '';
        }

        return collect([
            [
                // Account
                'johndoe', 'john@example.com', '08123456789', '1234567890123456', 'Active',
                // Basic
                'John', 'Doe', 'Laki-laki', '1990-01-01', 'Jakarta', 'Islam', 'Lajang', 'Indonesia',
                // Address
                'Jl. Jend. Sudirman No. 1', 'Setiabudi', 'Jakarta Selatan', 'Jakarta', 'DKI Jakarta', 'Indonesia', '12190',
                // Management
                $companyName, 'IT', 'Staff', 'Staff', 'Office', '', '2023-01-01',
                // Document
                'DOC/001/2023', '2028-01-01', 'No', '12.345.678.9-012.000',
                '12345678901', 'John Doe', '01234567890', 'John Doe',
                'John Doe', '12.345.678.9-012.000',
                // Config
                'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes'
            ],
            [
                // Account
                'janedoe', 'jane@example.com', '08987654321', '6543210987654321', 'Active',
                // Basic
                'Jane', 'Doe', 'Perempuan', '1992-05-15', 'Bandung', 'Kristen Protestan', 'Menikah', 'Indonesia',
                // Address
                'Jl. Asia Afrika No. 10', 'Sumur Bandung', 'Bandung', 'Bandung', 'Jawa Barat', 'Indonesia', '40111',
                // Management
                $companyName, 'Marketing', 'Staff', 'Junior', 'Shift 1', '', '2023-02-01',
                // Document
                'DOC/002/2023', '2028-02-01', 'No', '21.543.876.9-210.000',
                '10987654321', 'Jane Doe', '09876543210', 'Jane Doe',
                'Jane Doe', '21.543.876.9-210.000',
                // Config
                'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes'
            ]
        ]);
    }

    public function headings(): array
    {
        return [
            // Row 1: Group Headers
            [
                'Employee Account Information', '', '', '', '', // A-E
                'Employee Basic Information', '', '', '', '', '', '', '', // F-M
                'Employee Address Information', '', '', '', '', '', '', // N-T
                'Employee Management Information', '', '', '', '', '', '', // U-AA
                'Employee Document Information', '', '', '', '', '', '', '', '', '', // AB-AK
                'Employee Menu Config', '', '', '', '', '', '' // AL-AR
            ],
            // Row 2: Column Headers
            [
                // Account (A-E)
                "Username", "Email", "Phone", "NIK", "Status \n (Active/Inactive)",
                // Basic (F-M)
                "First Name", "Last Name", "Gender", "Birth Date \n (YYYY-MM-DD)", "Birth Place", "Religion", "Marital Status", "Nationality",
                // Address (N-T)
                "Address", "Sub District", "District", "City", "Province", "Country", "Postal Code",
                // Management (U-AA)
                "Company", "Department", "Position", "Level", "Shift", "Head", "Join Date \n (YYYY-MM-DD)",
                // Document (AB-AK)
                "Document Number", "Document Expiry \n (YYYY-MM-DD)", "Document Unlimited \n (Yes/No)", "NPWP Number", 
                "BPJS TK Number", "BPJS TK Name", "BPJS Health Number", "BPJS Health Name", 
                "Tax Registered Name", "Tax Number",
                // Config (AL-AR)
                "Attendance Location \n (Yes/No)", "Leave Req \n (Yes/No)", "Overtime Req \n (Yes/No)", "Reimbursement Req \n (Yes/No)", "Attendance \n (Yes/No)", "Payslip \n (Yes/No)", "EWA \n (Yes/No)"
            ],
            // Row 3: Sequence
            [
                // Account
                '1', '2', '3', '4', '5',
                // Basic
                '6', '7', '8', '9', '10', '11', '12', '13',
                // Address
                '14', '15', '16', '17', '18', '19', '20',
                // Management
                '21', '22', '23', '24', '25', '26', '27',
                // Document
                '28', '29', '30', '31', '32', '33', '34', '35', '36', '37',
                // Config
                '38', '39', '40', '41', '42', '43', '44'
            ]
        ];
    }

    public function title(): string
    {
        return 'Employee Template';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 12],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
            2 => [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
            ],
            3 => [
                'font' => ['italic' => true, 'color' => ['rgb' => '808080']],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;
                $rowCount = 1000; 

                // Merge Group Headers (Row 1)
                $sheet->mergeCells('A1:E1'); // Account
                $sheet->mergeCells('F1:M1'); // Basic
                $sheet->mergeCells('N1:T1'); // Address
                $sheet->mergeCells('U1:AA1'); // Management
                $sheet->mergeCells('AB1:AK1'); // Document
                $sheet->mergeCells('AL1:AR1'); // Config

                // Borders
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ];
                $sheet->getStyle('A1:AR3')->applyFromArray($styleArray);

                // --- VALIDATION ---

                // Status (E)
                $this->addValidation($sheet, 'E4:E' . $rowCount, ['Active', 'Inactive']);

                // Gender (H)
                $this->addValidation($sheet, 'H4:H' . $rowCount, array_keys(Employee::genderDropdown()));

                // Religion (K)
                $this->addValidation($sheet, 'K4:K' . $rowCount, array_keys(Employee::religionDropdown()));

                // Marital Status (L)
                $this->addValidation($sheet, 'L4:L' . $rowCount, array_keys(Employee::maritalStatusDropdown()));

                // Department (V)
                $departments = EmployeeDepartment::when($this->company_id, function ($q) {
                    $q->where('company_id', $this->company_id);
                })->pluck('name')->toArray();
                if (!empty($departments)) {
                    $this->addValidation($sheet, 'V4:V' . $rowCount, $departments);
                }

                // Position (W)
                $positions = EmployeePosition::when($this->company_id, function ($q) {
                    $q->where('company_id', $this->company_id);
                })->pluck('name')->toArray();
                if (!empty($positions)) {
                    $this->addValidation($sheet, 'W4:W' . $rowCount, $positions);
                }

                // Level (X)
                $levels = EmployeeLevel::when($this->company_id, function ($q) {
                    $q->where('company_id', $this->company_id);
                })->pluck('name')->toArray();
                if (!empty($levels)) {
                    $this->addValidation($sheet, 'X4:X' . $rowCount, $levels);
                }

                // Shift (Y)
                $shifts = EmployeeShift::when($this->company_id, function ($q) {
                    $q->where('company_id', $this->company_id);
                })->pluck('name')->toArray();
                if (!empty($shifts)) {
                    $this->addValidation($sheet, 'Y4:Y' . $rowCount, $shifts);
                }

                // Document Unlimited (AD), Configs (AL-AR)
                $yesNo = ['Yes', 'No'];
                $this->addValidation($sheet, 'AD4:AD' . $rowCount, $yesNo); // Unlimited
                
                // Config
                $this->addValidation($sheet, 'AL4:AL' . $rowCount, $yesNo); // Attendance Loc
                $this->addValidation($sheet, 'AM4:AM' . $rowCount, $yesNo); // Leave Req
                $this->addValidation($sheet, 'AN4:AN' . $rowCount, $yesNo); // Overtime Req
                $this->addValidation($sheet, 'AO4:AO' . $rowCount, $yesNo); // Reimb Req
                $this->addValidation($sheet, 'AP4:AP' . $rowCount, $yesNo); // Attendance
                $this->addValidation($sheet, 'AQ4:AQ' . $rowCount, $yesNo); // Payslip
                $this->addValidation($sheet, 'AR4:AR' . $rowCount, $yesNo); // EWA
            },
        ];
    }

    private function addValidation($sheet, $cellRange, $options)
    {
        $validation = $sheet->getCell(explode(':', $cellRange)[0])->getDataValidation();
        $validation->setType(DataValidation::TYPE_LIST);
        $validation->setErrorStyle(DataValidation::STYLE_INFORMATION);
        $validation->setAllowBlank(true);
        $validation->setShowInputMessage(true);
        $validation->setShowErrorMessage(true);
        $validation->setShowDropDown(true);
        $validation->setErrorTitle('Input Error');
        $validation->setError('Value is not in list.');
        $validation->setPromptTitle('Pick from list');
        $validation->setPrompt('Please pick a value from the drop-down list.');
        
        $optionsString = '"' . implode(',', $options) . '"';
        
        if (strlen($optionsString) > 255) {
             // Fallback for long lists could be handled here if needed
             return; 
        }

        $validation->setFormula1($optionsString);
        $sheet->getDelegate()->setDataValidation($cellRange, $validation);
    }
}
