<div class="row">

    <x-company-dropdown :value="old('company_id', $form->company_id ?? '')" />

    <x-form.image-picker :label="__('Image')" name="image" folder="employees" :value="old('image', $form->image ?? '')" />


    <x-form.input type="text" :label="__('First Name')" name="first_name" :value="old('first_name', $form->first_name ?? '')" />
    <x-form.input type="text" :label="__('Last Name')" name="last_name" :value="old('last_name', $form->last_name ?? '')" />
    <x-form.input type="date" :label="__('Birth Date')" name="birth_date" :value="old('birth_date', $form->birth_date ?? '')" />
    <x-form.input type="date" :label="__('Hire Date')" name="hire_date" :value="old('hire_date', $form->hire_date ?? '')" />
    <x-form.input type="number" :label="__('Salary')" name="sallary" :value="old('sallary', $form->sallary ?? '')" />
    <x-form.input type="number" :label="__('Reimbursement Limit')" name="reimbursement_limit" :value="old('reimbursement_limit', $form->reimbursement_limit ?? '')" />


    <x-form.input type="email" :label="__('Email')" name="email" :value="old('email', $form->email ?? '')" />
    <x-form.phone :label="__('Phone')" name="phone" :value="old('phone', $form->phone ?? '')" />

    <x-employee-department-dropdown :value="old('department_id', $form->department_id ?? '')" />
    <x-employee-position-dropdown :value="old('employee_position_id', $form->employee_position_id ?? '')" />
    <x-employee-level-dropdown :value="old('employee_level_id', $form->employee_level_id ?? '')" />
    <x-employee-shift-dropdown :value="old('employee_shift_id', $form->employee_shift_id ?? '')" />



</div>
