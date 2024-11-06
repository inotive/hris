<x-form.index 
    :title="__('Add') . ' ' . __('Approval')"
    :action="route('approver.store', $employee)" 
    :cancel="route('approver.index', $employee)" 
    
    >


    <x-slot name="body">


       
        @include('employee_approver.form')
        
    </x-slot>
</x-form.index>