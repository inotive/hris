<div class="row">
    @if (isset($form))
        <x-company-edit-tab :companyid="$form->id" :tab="'edit'" />
    @endif

    <h4>{{ __('Basic Information') }}</h4>
    <hr>
    <x-form.input type="text" :label="__('Name')" name="name" :value="old('name', $form->name ?? '')" />
    <x-form.input type="email" :label="__('Email')" name="email" :value="old('email', $form->email ?? '')" />
    <x-form.phone :label="__('Phone')" name="phone" :value="old('phone', $form->phone ?? '')" />
    <x-form.number min="1" max="31" :label="__('Cut Off Payroll Date')" name="cut_off_payroll_date" :value="old('cut_off_payroll_date', $form->cut_off_payroll_date ?? '')" />
    <x-form.image-picker :label="__('Logo')" name="logo" folder="companies" :value="old('logo', $form->logo ?? '')" />
    <x-form.switch label="Overtime Request" name="is_overtime_request" :value="old('is_overtime_request', $form->is_overtime_request ?? '')" />
    <x-form.switch label="Status" name="status" :value="old('status', $form->status ?? '')" />

    <h4>{{ __('Address Information') }}</h4>
    <hr>
    <x-form.textarea :label="__('Address')" name="address" :value="old('address', $form->address ?? '')" />
    <x-form.input type="text" label="Sub District" name="sub_district" :value="$form->sub_district ?? ''" />
    <x-form.input type="text" label="District" name="district" :value="$form->district ?? ''" />
    <x-form.input type="text" label="City" name="city" :value="$form->city ?? ''" />
    <x-form.input type="text" label="Province" name="province" :value="$form->province ?? ''" />
    <x-form.input type="text" label="Country" name="country" :value="$form->country ?? ''" />
    <x-form.input type="text" label="Postal Code" name="zip_code" :value="$form->zip_code ?? ''" />

</div>
