<div class="row">


    <x-company-dropdown :value="old('company_id', $form->company_id ?? '')" />
    <x-employee-dropdown :value="old('employee_id', $form->employee_id ?? '')" />

    <x-form.datetimepicker label="Start Date" name="start_shift_date_time" :value="old('start_shift_date_time', $form->start_shift_date_time ?? '')" />
    <x-form.datetimepicker label="End Date" name="end_shift_date_time" :value="old('end_shift_date_time', $form->end_shift_date_time ?? '')" />


    <x-overtime-shift-request-dropdown :value="old('overtime_shift_request_id', $form->overtime_shift_request_id ?? '')" />


    <x-form.input :label="__('Compensation')" name="compensation" :value="old('compensation', $form->compensation ?? '')" />
    <x-form.textarea :label="__('Note')" name="work_note" :value="old('work_note', $form->work_note ?? '')" />
    <x-manager-dropdown label="Approver" :value="old('manager_id', $form->manager_id ?? '')" />


    <div class="row">
        <div class="col-12 col-lg-6">
            <x-form.attachment class="" label="Files" name="files" :files="$files ?? []" folder="leave_request" />
        </div>
    </div>
</div>
