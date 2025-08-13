<div class="row">

    <x-form.hidden name="employee_id" :value="old('employee_id', $employee->id ?? '')" />


    <x-education-level-dropdown :required="true" :value="old('education_level', $form->education_level ?? '')" />
    <x-form.input :required="true" type="text" :label="__('Institution')" name="institution" :value="old('institution', $form->institution ?? '')" />
    <x-form.input :required="true" type="text" :label="__('Faculty')" name="faculty" :value="old('faculty', $form->faculty ?? '')" />
    <x-form.input :required="true" type="text" :label="__('Major')" name="major" :value="old('major', $form->major ?? '')" />
    <x-form.number :required="true" min="1900" :label="__('Start Year')" name="start_year" :value="old('start_year', $form->start_year ?? '')" />
    <x-form.number :required="true" min="1900" :label="__('End Year')" name="end_year" :value="old('end_year', $form->end_year ?? '')" />
    <x-form.input :required="true" type="number" :label="__('GPA')" name="gpa" :value="old('gpa', $form->gpa ?? '')" />
    <x-form.input type="number" :label="__('GPA Scale')" name="gpa_scale" :value="old('gpa_scale', $form->gpa_scale ?? '')" />
    <x-form.input :required="true" type="text" :label="__('Country')" name="country" :value="old('country', $form->country ?? '')" />
    <x-form.input :required="true" type="text" :label="__('State')" name="state" :value="old('state', $form->state ?? '')" />
    <x-form.input :required="true" type="text" :label="__('City')" name="city" :value="old('city', $form->city ?? '')" />
    <x-form.switch :label="__('Default')" name="default" :value="old('default', $form->default ?? '')" />
    <x-form.input type="text" :label="__('Certificate No')" name="certificate_no" :value="old('certificate_no', $form->certificate_no ?? '')" />
    <x-form.datepicker :label="__('Certificate Date')" name="certificate_date" :value="old('certificate_date', $form->certificate_date ?? '')" />
    <x-form.file folder="certificate_file" :label="__('Certificate File')" name="certificate_file" :value="old('certificate_file', $form->certificate_file ?? '')" />



</div>
