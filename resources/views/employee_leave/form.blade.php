<div class="row">

    <x-form.hidden name="leave_type_id" :value="old('leave_type_id', $form->leave_type_id ?? '')" />
    <x-form.hidden name="target_employee_id" :value="old('target_employee_id', $employee->id ?? '')" />

    <x-form.input disabled :value="old('name', $form->name ?? '')" label="Leave Type" disabled />
    <x-form.number :label="__('limit')" name="limit" :value="old('limit', $form->days_limit ?? '')" />




</div>
