<div>


    <x-form.image-picker 
    :label="__('Logo')" 
    name="logo" 
    folder="companies"
    :value="old('logo', $form->logo ?? '')" />


    <x-form.input type="text" :label="__('Name')" name="name" :value="old('name', $form->name ?? '')" />

    <x-form.textarea :label="__('Address')" name="address" :value="old('address', $form->address ?? '')" />

    <x-form.phone :label="__('Telephone')" name="telphone" :value="old('telphone', $form->telphone ?? '')" />
    <x-form.input type="email" :label="__('Email')" name="email" :value="old('email', $form->email ?? '')" />
    <x-form.phone :label="__('Phone')" name="phone" :value="old('phone', $form->phone ?? '')" />
    <x-form.number min="1" max="31"  :label="__('General Pay Date')" name="general_pay_date" :value="old('general_pay_date',$form->general_pay_date ?? '')" />
    <x-form.input type="number" :label="__('Overtime Request')" name="is_overtime_request" :value="old('is_overtime_request', $form->is_overtime_request ?? '')" />

    


</div>