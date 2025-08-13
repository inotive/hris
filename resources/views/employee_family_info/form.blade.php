<div class="row">

    <x-form.hidden name="employee_id" :value="old('employee_id', $employee->id ?? '')" />
    <x-family-relation-dropdown :required="true" :value="old('family_relation', $form->family_relation ?? '')" />

    <x-form.input :required="true" type="text" :label="__('Name')" name="name" :value="old('name', $form->name ?? '')" />
    <x-gender-dropdown :required="true" :value="old('gender', $form->gender ?? '')" />


    <x-form.datepicker :label="__('Birth Date')" name="birth_date" :value="old('birth_date', $form->birth_date ?? '')" />
    <x-form.input :required="true" type="text" :label="__('Birth Place')" name="birth_place" :value="old('birth_place', $form->birth_place ?? '')" />
    <x-marital-status-dropdown :required="true" :value="old('marital_status', $form->marital_status ?? '')" />

    <x-form.textarea type="text" label="Address" name="address" :value="$form->address ?? ''" />


    <x-form.image-picker :label="__('Photo')" name="photo" folder="employee_family_info" :value="old('photo', $form->photo ?? '')" />





</div>
