<x-form.index 
    :title="__('Add') . ' ' . __('Payslip')"
    :action="route('employee-payslips.store')" 
    :cancel="route('employee-payslips.index')" 
    
    >


    <x-slot name="body">


       
        @include('employee_payslips.form')
        
    </x-slot>
</x-form.index>