<?php

namespace App\Imports;

use App\Models\Employee;
use App\Models\EmployeeDepartment;
use App\Models\EmployeeLevel;
use App\Models\EmployeePosition;
use App\Models\EmployeeShift;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class EmployeeSheetImport implements OnEachRow, WithHeadingRow, WithStartRow, SkipsEmptyRows
{

    protected $company_id;

    public function __construct($company_id = null)
    {
        $this->company_id = $company_id;
    }

    // Header is at row 2, Data starts at row 4
    public function headingRow(): int
    {
        return 2;
    }

    public function startRow(): int
    {
        return 4;
    }

    public function onRow(Row $rowObject)
    {
        $row = $rowObject->toArray();
        // Skip completely empty rows manually if SkipsEmptyRows trait fails
        if (!array_filter($row)) {
            return;
        }

        \Illuminate\Support\Facades\Log::info('Processing Row:', $row);

        try {
            // 1. Resolve Company ID first (needed for validation)
            $companyId = $this->company_id;
            if (!$companyId && !empty($row['company'])) {
                $companyName = trim($row['company']);
                $company = \App\Models\Company::where('name', $companyName)->first();
                if (!$company) {
                     $company = \App\Models\Company::where('name', 'LIKE', $companyName)->first();
                }
                $companyId = $company?->id;
            }
            if (!$companyId) {
                // Fallback
                $companyId = auth()->user()->company_id;
            }
            
            // 2. Manual Validation
            $validator = \Illuminate\Support\Facades\Validator::make($row, [
                'username' => ['required', Rule::unique('employees', 'username')],
                'email' => ['required', 'email', Rule::unique('employees', 'email')],
                'phone' => ['required'],
                'nik' => ['required', Rule::unique('employees', 'nik')],
                'first_name' => ['required'],
                'last_name' => ['required'],
                'gender' => ['required', Rule::in(array_keys(Employee::genderDropdown()))],
                'religion' => ['required', Rule::in(array_keys(Employee::religionDropdown()))],
                'document_number' => ['required'],
                'tax_registered_name' => ['required'],
                'tax_number' => ['required'],
                'company' => function ($attribute, $value, $fail) use ($companyId) {
                    if (!$companyId) {
                        $fail('Company not found or invalid.');
                    }
                },
                'department' => ['required', function ($attribute, $value, $fail) use ($companyId) {
                     if (!$companyId) return; // Should be caught by company rule
                     $exists = EmployeeDepartment::where('company_id', $companyId)->where('name', $value)->exists();
                     if (!$exists) $fail("Department '$value' not found in this company.");
                }],
                'position' => ['required', function ($attribute, $value, $fail) use ($companyId) {
                     if (!$companyId) return;
                     $exists = EmployeePosition::where('company_id', $companyId)->where('name', $value)->exists();
                     if (!$exists) $fail("Position '$value' not found in this company.");
                }],
                'level' => ['required', function ($attribute, $value, $fail) use ($companyId) {
                     if (!$companyId) return;
                     $exists = EmployeeLevel::where('company_id', $companyId)->where('name', $value)->exists();
                     if (!$exists) $fail("Level '$value' not found in this company.");
                }],
                'shift' => ['required', function ($attribute, $value, $fail) use ($companyId) {
                     if (!$companyId) return;
                     $exists = EmployeeShift::where('company_id', $companyId)->where('name', $value)->exists();
                     if (!$exists) $fail("Shift '$value' not found in this company.");
                }],
            ]);

            if ($validator->fails()) {
                // Throw validation exception so standard error handling works
                 throw new \Illuminate\Validation\ValidationException($validator);
            }

            if (!$companyId) {
                 throw new \Exception("Company is required and could not be resolved.");
            }

            // Helper to find related models
            $department = EmployeeDepartment::where('company_id', $companyId)->where('name', $row['department'])->first();
            $position = EmployeePosition::where('company_id', $companyId)->where('name', $row['position'])->first();
            $level = EmployeeLevel::where('company_id', $companyId)->where('name', $row['level'])->first();
            $shift = EmployeeShift::where('company_id', $companyId)->where('name', $row['shift'])->first();

            // Handle Status
            $status = $this->parseBoolean($row['status_activeinactive'], true);

            // Handle Booleans
            $unlimitedDoc = $this->parseBoolean($row['document_unlimited_yesno']);
            $attLoc = $this->parseBoolean($row['attendance_location_yesno']);
            $leaveReq = $this->parseBoolean($row['leave_req_yesno']);
            $overtimeReq = $this->parseBoolean($row['overtime_req_yesno']);
            $reimbReq = $this->parseBoolean($row['reimbursement_req_yesno']);
            $attendance = $this->parseBoolean($row['attendance_yesno']);
            $payslip = $this->parseBoolean($row['payslip_yesno']);
            $ewa = $this->parseBoolean($row['ewa_yesno']);

            $employee = new Employee([
                'company_id'     => $companyId,
                
                // Account
                'username'       => $row['username'],
                'email'          => $row['email'],
                'phone'          => $row['phone'],
                'nik'            => $row['nik'],
                'status'         => $status ? 1 : 0,

                // Basic
                'first_name'     => $row['first_name'],
                'last_name'      => $row['last_name'],
                'gender'         => $row['gender'],
                'birth_date'     => $this->transformDate($row['birth_date_yyyy_mm_dd']),
                'birth_place'    => $row['birth_place'],
                'religion'       => $row['religion'],
                'marital_status' => $row['marital_status'],
                'nationality'    => $row['nationality'],

                // Address
                'address'        => $row['address'],
                'sub_district'   => $row['sub_district'],
                'district'       => $row['district'],
                'city'           => $row['city'],
                'province'       => $row['province'],
                'country'        => $row['country'],
                'zip_code'       => $row['postal_code'],

                // Management
                'department_id'  => $department?->id,
                'employee_position_id' => $position?->id,
                'employee_level_id'    => $level?->id,
                'employee_shift_id'    => $shift?->id,
                'join_date'      => $this->transformDate($row['join_date_yyyy_mm_dd']),
                
                // Document
                'document_id'    => $row['document_number'],
                'document_expiry'=> $this->transformDate($row['document_expiry_yyyy_mm_dd']),
                'document_is_unlimited' => $unlimitedDoc,
                'npwp_number'    => $row['npwp_number'],
                'document_bpjstk_no'   => $row['bpjs_tk_number'],
                'document_bpjstk_name' => $row['bpjs_tk_name'],
                'document_bpjs_no'     => $row['bpjs_health_number'],
                'document_bpjs_name'   => $row['bpjs_health_name'],
                'tax_registered_name'  => $row['tax_registered_name'],
                'tax_number'           => $row['tax_number'],

                // Config
                'is_attendance_location' => $attLoc,
                'is_leave_request'       => $leaveReq,
                'is_overtime_request'    => $overtimeReq,
                'is_reimbursement_request' => $reimbReq,
                'is_attendance'          => $attendance,
                'is_payslip'             => $payslip,
                'is_ewa'                 => $ewa,

                'password'       => null,
            ]);

            $employee->save();
            \Illuminate\Support\Facades\Log::info('Saved Employee ID: ' . $employee->id);

        } catch (\Throwable $e) {
             \Illuminate\Support\Facades\Log::error('Row Save Failed: ' . $e->getMessage());
             throw $e; // Re-throw to fail the import or continue based on needs. 
                      // Here re-throwing will trigger the Controller catch block.
        }
    }

    private function transformDate($value, $format = 'Y-m-d')
    {
        if (!$value) {
            return null;
        }
        try {
            if (is_numeric($value)) {
                return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)->format($format);
            }
            return Carbon::parse($value)->format($format);
        } catch (\Exception $e) {
            return null;
        }
    }

    private function parseBoolean($value, $activeMode = false) {
        if (!$value) return false;
        $v = strtolower(trim($value));
        if ($activeMode) {
             return in_array($v, ['active', '1', 'true', 'yes']);
        }
        return in_array($v, ['yes', '1', 'true']);
    }
}
