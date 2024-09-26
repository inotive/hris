<div class="row">

    <x-form.hidden name="employee_id" :value="old('employee_id', $employee->id ?? '')" />

    <x-company-dropdown :value="old('company_id', $form->company_id ?? '')" />
    <x-employee-dropdown :value="old('employee_id', $form->employee_id ?? '')" />
   
    <x-form.input type="text" :label="__('Name')" name="name" :value="old('name', $form->name ?? '')" />
   
</div>
