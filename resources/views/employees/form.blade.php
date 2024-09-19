<div class="row">
    @if (isset($form))
        <x-employee-edit-tab :employeeid="$form->id" :tab="'edit'" />
    @endif


    <x-company-dropdown :value="old('company_id', $form->company_id ?? '')" />

    <x-form.image-picker :label="__('Image')" name="image" folder="employees" :value="old('image', $form->image ?? '')" />


    <x-form.input type="text" :label="__('First Name')" name="first_name" :value="old('first_name', $form->first_name ?? '')" />
    <x-form.input type="text" :label="__('Last Name')" name="last_name" :value="old('last_name', $form->last_name ?? '')" />
    <x-form.input type="text" :label="__('Birth Place')" name="birth_place" :value="old('birth_place', $form->birth_place ?? '')" />
    <x-form.input type="date" :label="__('Birth Date')" name="birth_date" :value="old('birth_date', $form->birth_date ?? '')" />
    <x-religion-dropdown :value="old('religion', $form->religion ?? '')" />
    <x-gender-dropdown :value="old('gender', $form->gender ?? '')" />
    <x-marital-status-dropdown :value="old('marital_status', $form->marital_status ?? '')" />

    <x-form.textarea type="text" label="Address" name="address" :value="$form->address ?? ''" />
    <x-form.input type="text" label="Country" name="country" :value="$form->country ?? ''" />
    <x-form.input type="text" label="Province" name="province" :value="$form->province ?? ''" />
    <x-form.input type="text" label="City" name="city" :value="$form->city ?? ''" />
    <x-form.input type="text" label="District" name="district" :value="$form->district ?? ''" />
    <x-form.input type="text" label="Sub District" name="sub_district" :value="$form->sub_district ?? ''" />
    <x-form.input type="text" label="Zip Code" name="zip_code" :value="$form->zip_code ?? ''" />
    <x-form.input type="text" label="nationality" name="nationality" :value="$form->nationality ?? ''" />



    <x-form.input type="date" :label="__('Join Date')" name="join_date" :value="old('join_date', $form->join_date ?? '')" />
    <x-form.input type="number" :label="__('Salary')" name="sallary" :value="old('sallary', $form->sallary ?? '')" />
    <x-form.input type="number" :label="__('Reimbursement Limit')" name="reimbursement_limit" :value="old('reimbursement_limit', $form->reimbursement_limit ?? '')" />


    <x-form.input type="username" :label="__('Username')" name="username" :value="old('username', $form->username ?? '')" />
    <x-form.input type="email" :label="__('Email')" name="email" :value="old('email', $form->email ?? '')" />
    <x-form.phone :label="__('Phone')" name="phone" :value="old('phone', $form->phone ?? '')" />

    <x-form.input type="text" label="Document ID" name="document_id" :value="$form->document_id ?? ''" />
    <x-form.input type="date" label="Document Expiry" name="document_expiry" :value="$form->document_expiry ?? ''" />
    <x-form.input type="text" label="Tax Registered Name" name="tax_registered_name" :value="$form->tax_registered_name ?? ''" />
    <x-form.input type="text" label="Tax Number" name="tax_number" :value="$form->tax_number ?? ''" />


    <x-form.input type="text" label="Bank Account Name" name="bank_account_name" :value="$form->bank_account_name ?? ''" />
    <x-form.input type="text" label="Bank Account Number" name="bank_account_number" :value="$form->bank_account_number ?? ''" />



    <x-employee-department-dropdown :value="old('department_id', $form->department_id ?? '')" />
    <x-employee-position-dropdown :value="old('employee_position_id', $form->employee_position_id ?? '')" />
    <x-employee-level-dropdown :value="old('employee_level_id', $form->employee_level_id ?? '')" />
    <x-employee-shift-dropdown :value="old('employee_shift_id', $form->employee_shift_id ?? '')" />



</div>
