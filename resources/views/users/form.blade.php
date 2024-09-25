<div class="row">

    <x-form.input type="text" :label="__('First Name')" name="first_name" :value="old('first_name', $form->first_name ?? '')" />
    <x-form.input type="text" :label="__('Last Name')" name="last_name" :value="old('last_name', $form->last_name ?? '')" />

    <x-form.input type="email" :label="__('Email')" name="email" :value="old('email', $form->email ?? '')" />
    <x-form.input type="phone" :label="__('Phone')" name="phone" :value="old('phone', $form->phone ?? '')" />


    <x-role-dropdown :value="old('role', $form->role ?? '')" />
    <x-company-dropdown :value="old('company_id', $form->company_id ?? '')" />


    <x-form.image-picker :label="__('Image')" name="image" folder="users" :value="old('image', $form->image ?? '')" />

</div>

