<div class="row">

    <x-form.hidden name="employee_id" :value="old('employee_id', $employee->id ?? '')" />


    <x-form.select label="Status" name="status" :value="old('status', $form->status ?? '')" :list="\App\Models\EmployeeContract::statusDropdown()" />


    <x-form.datepicker :label="__('Date Start')" name="date_start" :value="$form->date_start ?? ''" />
    <x-form.datepicker :label="__('Date End')" name="date_end" :value="$form->date_end ?? ''" />
        <x-form.file folder="employee_contract" :label="__('File')" name="file" :value="$form->file ?? ''" />

        <x-form.texteditor :label="__('Notes')" name="notes" :value="$form->notes ?? ''" />


</div>
