<div class="row">

    <x-form.hidden name="employee_id" :value="old('employee_id', $employee->id ?? '')" />


    <x-form.input type="text" :label="__('Company Name')" name="company_name" :value="$form->company_name ?? ''" />
    <x-form.input type="text" :label="__('Company Location')" name="company_location" :value="$form->company_location ?? ''" />
    <x-form.input type="text" :label="__('Line of Business')" name="line_of_business" :value="$form->line_of_business ?? ''" />
    <x-form.input type="text" :label="__('Position Held')" name="position_held" :value="$form->position_held ?? ''" />
    <x-form.textarea :label="__('Job Description')" name="job_description" :value="$form->job_description ?? ''" />
    <x-form.textarea :label="__('Achievement')" name="achievement" :value="$form->achievement ?? ''" />
    <x-form.datepicker :label="__('Start Periode')" name="start_period" :value="$form->start_period ?? ''" />
    <x-form.datepicker :label="__('End Periode')" name="end_period" :value="$form->end_period ?? ''" />

    <x-currency-dropdown label="Initial Currency" name="initial_currency" :value="old('initial_currency', $form->initial_currency ?? '')" />


    <x-form.input type="integer" :label="__('Initial Salary')" name="initial_sallary" :value="$form->initial_sallary ?? ''" />


    <x-period-dropdown label="Initial Period" name="initial_period" :value="old('initial_period', $form->initial_period ?? '')" />
    <x-currency-dropdown label="Last Currency" name="last_currency" :value="old('last_currency', $form->last_currency ?? '')" />


    <x-form.input type="text" :label="__('Last Salary')" name="last_sallary" :value="$form->last_sallary ?? ''" />


    <x-period-dropdown label="Last Period" name="last_period" :value="old('last_period', $form->last_period ?? '')" />
    <x-reason-leaving-dropdown :value="old('reason_leaving', $form->reason_leaving ?? '')" />

    <x-form.input type="text" :label="__('Reference Name')" name="reference_name" :value="$form->reference_name ?? ''" />
    <x-form.input type="number" :label="__('Reference Phone')" name="reference_phone" :value="$form->reference_phone ?? ''" />
    <x-form.input type="text" :label="__('Reference Position')" name="reference_position" :value="$form->reference_position ?? ''" />


</div>
