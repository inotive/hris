<div>


    <x-company-dropdown :value="old('company_id', $form->company_id ?? '')"/>

    <x-form.input type="text" :label="__('First Name')" name="first_name" :value="old('first_name', $form->first_name ?? '')" />
    <x-form.input type="text" :label="__('Last Name')" name="last_name" :value="old('last_name', $form->last_name ?? '')" />


    <x-form.input type="email" :label="__('Email')" name="email" :value="old('email', $form->email ?? '')" />
    <x-form.phone :label="__('Phone')" name="phone" :value="old('phone', $form->phone ?? '')" />


    <x-employee-department-dropdown :label="__('Department')" name="department_id"/>


    <x-head-department-employee-dropdown :value="old('head_departmen_id', $form->head_departmen_id ?? '')" />
</div>