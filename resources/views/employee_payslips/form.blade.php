<div class="row">

    <x-company-dropdown :value="old('company_id', $form->company_id ?? '')" />
    <x-employee-dropdown :value="old('employee_id', $form->employee_id ?? '')" />

    <h4>{{ __('Payslip Detail') }}</h4>
    <hr>

    <x-form.datepicker :label="__('Pay Date')" name="pay_date" :value="old('pay_date', $form->pay_date ?? '')" />
    <x-form.select :list="['cash'=> 'Cash', 'transfer'=>'Transfer']" :label="__('Metode')" name="metode" :value="old('metode', $form->metode ?? '')" />
    <x-form.input :label="__('Account Name')" name="account_name" :value="old('account_name', $form->account_name ?? '')" />
    <x-form.number :label="__('Account No')" name="account_number" :value="old('account_number', $form->account_number ?? '')" />


    <h4>{{ __('Deduction Detail') }}</h4>
    <hr>

  

    <div class="deduction_div mb-5">
        <div class="row-button text-end">
            <button class="btn btn-primary" type="button" id="add_deduction" href="">{{  __('Add Deduction') }}</button>
        </div>

        <div class="empty">
            <x-table.empty />
        </div>
        <div class="form"></div>
    </div>


    <h4>{{ __('Earning Detail') }}</h4>
    <hr>


    <div class="earning_div">

        <div class="row-button text-end">
            <button class="btn btn-primary"  type="button"  id="add_earning" href="">{{  __('Add Earning') }}</button>
        </div>
        
        <div class="empty">
            <x-table.empty />
        </div>
        <div class="form"></div>
    </div>


    <x-form.file folder="payslip" :label="__('Payslip File')" name="file" :value="old('file', $form->file ?? '')" />
    
        <x-form.currency :label="__('Tax')" name="tax" :value="old('tax', $form->tax ?? '')" />
    
</div>
