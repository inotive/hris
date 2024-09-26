<x-form.index 
    :title="__('Add') . ' ' . __('Contract')"
    :action="route('contract.store', $employee)" 
    :cancel="route('contract.index', $employee)" 
    
    >


    <x-slot name="body">


       
        @include('employee_contract.form')
        
    </x-slot>
</x-form.index>