<div class="row">

    <x-form.hidden name="employee_id" :value="old('employee_id', $employee->id ?? '')" />

    <x-form.select :label="__('Type')" name="status" :value="old('status', $employee->status ?? '')" :list="['contract'=> 'Contract', 'permanent'=>'Permanent']" />

    <x-form.datepicker :label="__('Date Start')" name="date_start" :value="$form->date_start ?? ''" />
    <x-form.datepicker :label="__('Date End')" name="date_end" :value="$form->date_end ?? ''" />
    <x-form.textarea :label="__('Notes')" name="notes" :value="$form->notes ?? ''" />
    <x-form.file folder="employee_contract" :label="__('File')" name="file" :value="$form->file ?? ''" />

</div>
