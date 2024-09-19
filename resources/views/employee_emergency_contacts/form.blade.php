<div class="row">


    <x-form.hidden name="employee_id" :value="old('employee_id', $employee->id ?? '')" />
    <x-family-relation-dropdown :value="old('family_relation', $form->family_relation ?? '')" />

    <x-form.input type="text" :label="__('Name')" name="name" :value="old('name', $form->name ?? '')" />
    <x-form.input type="text" :label="__('Phone')" name="phone" :value="old('phone', $form->phone ?? '')" />


    <x-form.textarea type="text" label="Address" name="address" :value="$form->address??''" />
    <x-form.input type="text" label="Country" name="country" :value="$form->country??''" />
    <x-form.input type="text" label="Province" name="province" :value="$form->province??''" />
    <x-form.input type="text" label="City" name="city" :value="$form->city??''" />
    <x-form.input type="text" label="District" name="district" :value="$form->district??''" />
    <x-form.input type="text" label="Sub District" name="sub_district" :value="$form->sub_district??''" />
    <x-form.input type="text" label="Postal Code" name="zip_code" :value="$form->zip_code??''" />





</div>