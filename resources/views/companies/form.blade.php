<div class="row">
    @if (isset($form))
        <div class="pt-6">
            <x-company-info-detail :companyid="$form->id" />
            <div class="separator mb-6"></div>
        </div>
        <div class="w-full mb-6">
            <div class="card px-6 border-0 rounded-lg" style="background-color: #eef3ff">
                <x-company-edit-tab :companyid="$form->id" :tab="'edit'" />
            </div>
        </div>
    @endif

    <h4>{{ __('Company Basic Information') }}</h4>
    <div>
        <hr />
    </div>
    <x-form.input type="text" :label="__('Name')" name="name" :value="old('name', $form->name ?? '')" :required="true" />
    <x-form.input type="email" :label="__('Email')" name="email" :value="old('email', $form->email ?? '')" :required="true" />
    <x-form.phone :label="__('Phone')" name="phone" :value="old('phone', $form->phone ?? '')" :required="true" />
    <x-form.select :required="true" :list="['backward' => 'Backward', 'current' => 'Current']" label="Cut Off Payroll Method" name="cut_off_payroll_method"
        :value="old('cut_off_payroll_method', $form->cut_off_payroll_method ?? '')" :required="true" />
    <x-form.number :required="true" min="1" max="31" :label="__('Cut Off Payroll Date')" name="cut_off_payroll_date"
        :value="old('cut_off_payroll_date', $form->cut_off_payroll_date ?? '')" />
    <x-form.select :list="['none' => 'None', 'gross' => 'Gross', 'gross-up' => 'Gross Up']" label="Tax Calculation Method" name="tax_calculation_method" :value="old('tax_calculation_method', $form->tax_calculation_method ?? '')" />

    <x-form.image-picker :label="__('Logo')" name="logo" folder="companies" :value="old('logo', $form->logo ?? '')" />

    <x-form.switch label="Status" name="status" :value="old('status', $form->status ?? '')" />

    <h4>{{ __('Company Address Information') }}</h4>
    <div>
        <hr />
    </div>
    <x-form.textarea :label="__('Address')" name="address" :value="old('address', $form->address ?? '')" :required="true" />
    
    {{-- Cascading Dropdowns for Province/City/District/SubDistrict --}}
    <x-location-cascading-dropdown 
        :country="old('country', $form->country ?? '')"
        :province="old('province', $form->province ?? '')"
        :city="old('city', $form->city ?? '')"
        :district="old('district', $form->district ?? '')"
        :subDistrict="old('sub_district', $form->sub_district ?? '')"
    />

    <x-form.number type="text" label="Postal Code" name="zip_code" :value="$form->zip_code ?? ''" />



    <x-time-zone-dropdown :value="old('time_zone', $form->time_zone ?? '')" />

    <div class="col-12 col-lg-6 mb-4 row">
        <x-form.input-map :lat="$form->lat ?? 0" :lng="$form->lng ?? 0" />
    </div>

    <h4>{{ __('Company Menu Config') }}</h4>
    <div>
        <hr />
    </div>
    <x-form.switch label="Leave Request" name="is_leave_request" :value="old('is_leave_request', $form->is_leave_request ?? '')" />
    <x-form.switch label="Overtime Request" name="is_overtime_request" :value="old('is_overtime_request', $form->is_overtime_request ?? '')" />
    <x-form.switch label="Reimbursement Request" name="is_reimbursement_request" :value="old('is_reimbursement_request', $form->is_reimbursement_request ?? '')" />
    <x-form.switch label="Attendance" name="is_attendance" :value="old('is_attendance', $form->is_attendance ?? '')" />
    <x-form.switch label="EWA" name="is_ewa" :value="old('is_ewa', $form->is_ewa ?? '')" />
    <x-form.switch label="Payslip" name="is_payslip" :value="old('is_payslip', $form->is_payslip ?? '')" />
</div>
