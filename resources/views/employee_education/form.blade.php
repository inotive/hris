<div class="row">

    <x-form.hidden name="employee_id" :value="old('employee_id', $employee->id ?? '')" />


    <x-education-level-dropdown :value="old('education_level', $form->education_level ?? '')" />
    <x-form.input type="text" :label="__('Institution')" name="institution" :value="$form->institution ?? ''" />
    <x-form.input type="text" :label="__('Faculty')" name="faculty" :value="$form->faculty ?? ''" />
    <x-form.input type="text" :label="__('Major')" name="major" :value="$form->major ?? ''" />
    <x-form.number min="1900" :label="__('Start Year')" name="start_year" :value="$form->start_year ?? ''" />
    <x-form.number min="1900" :label="__('End Year')" name="end_year" :value="$form->end_year ?? ''" />
    <x-form.input type="number" :label="__('GPA')" name="gpa" :value="$form->gpa ?? ''" />
    <x-form.input type="number" :label="__('GPA Scale')" name="gpa_scale" :value="$form->gpa_scale ?? ''" />
    <x-form.input type="text" :label="__('Country')" name="country" :value="$form->country ?? ''" />
    <x-form.input type="text" :label="__('State')" name="state" :value="$form->state ?? ''" />
    <x-form.input type="text" :label="__('City')" name="city" :value="$form->city ?? ''" />
    <x-form.switch :label="__('Default')" name="default" :value="$form->default ?? ''" />
    <x-form.input type="text" :label="__('Certificate No')" name="certificate_no" :value="$form->certificate_no ?? ''" />
    <x-form.datepicker :label="__('Certificate Date')" name="certificate_date" :value="$form->certificate_date ?? ''" />
    <x-form.file folder="certificate_file" :label="__('Certificate File')" name="certificate_file" :value="$form->certificate_file ?? ''" />



</div>
