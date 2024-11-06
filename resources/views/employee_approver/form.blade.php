<div class="row">

    <x-form.hidden name="company_id" :value="old('company_id', $employee->company_id ?? '')" />
    <x-form.hidden name="employee_id" :value="old('employee_id', $employee->id ?? '')" />

    <x-form.select label="Request Type" name="request_type" :list="['reimbursement' => 'Reimbursement', 'overtime' => 'Overtime', 'leave' => 'Leave']"  :value="old('request_type', $form->request_type ?? '')" />
    <x-approver-employee-dropdown label="Approver" name="approver_employee_id" :value="old('approver_employee_id', $form->approver_employee_id ?? '')" />


    <x-form.number :label="__('Level')" name="approver_level" :value="old('approver_level', $form->approver_level ?? '')" />




</div>
