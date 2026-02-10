<div class="row">


    <x-form.hidden name="employee_id" :value="old('employee_id', $employee->id ?? '')" />
    <x-family-relation-dropdown :required="true" :value="old('family_relation', $form->family_relation ?? '')" />

    <x-form.input :required="true" type="text" :label="__('Name')" name="name" :value="old('name', $form->name ?? '')" />
    <x-form.phone :required="true"  :label="__('Phone')" name="phone" :value="old('phone', $form->phone ?? '')" />


    <x-form.textarea type="text" label="Address" name="address" :value="$form->address??''" />

    {{-- Cascading Dropdowns for Location --}}
    <x-location-cascading-dropdown 
        :country="old('country', $form->country ?? '')"
        :province="old('province', $form->province ?? '')"
        :city="old('city', $form->city ?? '')"
        :district="old('district', $form->district ?? '')"
        :subDistrict="old('sub_district', $form->sub_district ?? '')"
        :zipCode="old('zip_code', $form->zip_code ?? '')"
    />





</div>