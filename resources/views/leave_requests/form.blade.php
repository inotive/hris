<div class="row">


    <x-company-dropdown :value="old('company_id', $form->company_id ?? '')" />
    <x-employee-dropdown :value="old('employee_id', $form->employee_id ?? '')" />
    <x-leave-type-dropdown :value="old('leave_type_id', $form->leave_type_id ?? '')" />
    <x-form.datepicker label="Date" name="date" :value="old('date', $form->date ?? '')"  />


    <x-form.textarea :label="__('Reason')" name="reason" :value="old('reason', $form->reason ?? '')" />
</div>
