<x-form.index
    :action="$form_action"
    :cancel="$cancel"
>
    <x-slot name="title">{{ __('Payroll Information') }}</x-slot>

    <x-slot name="toolbar"> 
 
    </x-slot>

    <x-slot name="toolbar">
        <x-employee-edit-tab :employeeid="$employee->id" tab="payroll" />
    </x-slot>

    <x-slot name="body">  
        <div class="row">
            <x-form.input type="text" label="Bank Account Number" name="bank_account_number" :value="$form->bank_account_number ?? ''" />
                <x-form.input type="text" label="Bank Account Name" name="bank_account_name" :value="$form->bank_account_name ?? ''" />
                <x-form.datepicker :label="__('Join Date')" name="join_date" :value="old('join_date', $form->join_date ?? '')" />
                <x-form.currency :label="__('Salary')" name="sallary" :value="old('sallary', $form->sallary ?? '')" />
                <x-form.currency :label="__('Reimbursement Limit')" name="reimbursement_limit" :value="old('reimbursement_limit', $form->reimbursement_limit ?? '')" />
            
    
        </div>
        
    </x-slot>
</x-form.index>