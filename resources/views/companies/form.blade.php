<div class="row">
    @if (isset($form))
        <x-company-edit-tab :companyid="$form->id" :tab="'edit'" />
    @endif



    <x-form.image-picker :label="__('Logo')" name="logo" folder="companies" :value="old('logo', $form->logo ?? '')" />


    <x-form.input type="text" :label="__('Name')" name="name" :value="old('name', $form->name ?? '')" />

    <x-form.textarea :label="__('Address')" name="address" :value="old('address', $form->address ?? '')" />

    <x-form.phone :label="__('Telephone')" name="telphone" :value="old('telphone', $form->telphone ?? '')" />
    <x-form.input type="email" :label="__('Email')" name="email" :value="old('email', $form->email ?? '')" />

    <x-form.number min="1" max="31" :label="__('General Pay Date')" name="general_pay_date" :value="old('general_pay_date', $form->general_pay_date ?? '')" />

    <x-form.select label="Overtime Request" name="is_overtime_request" :list="['1' => __('Yes'), '0' => __('No')]" :value="old('is_overtime_request', $form->is_overtime_request ?? '')" />
    <x-form.select label="Status" name="status" :list="['1' => __('Yes'), '0' => __('No')]" :value="old('status', $form->status ?? '')" />


</div>
