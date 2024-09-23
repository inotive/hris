<div class="row">


    <x-company-dropdown :value="old('company_id', $form->company_id ?? '')" />
    <x-employee-dropdown :value="old('employee_id', $form->employee_id ?? '')" />
    <x-leave-type-dropdown :value="old('leave_type_id', $form->leave_type_id ?? '')" />
    <x-form.datepicker label="Date" name="date" :value="old('date', $form->date ?? '')"  />

    <x-manager-dropdown label="Approver" :value="old('manager_id', $form->manager_id ?? '')" />

    <x-form.textarea :label="__('Reason')" name="reason" :value="old('reason', $form->reason ?? '')" />


    <div class="row">
        <div class="col-12 col-lg-6">
            <x-form.attachment class="" label="Files" name="files" :files="$files ?? []"  folder="leave_request" />
        </div>
    </div>
</div>
