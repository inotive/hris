<x-form.index 
    :title="__('Add Emergency Contact')"
    :action="route('emergency-contact.store', $employee)" 
    :cancel="route('emergency-contact.index', $employee)" 
    
    >


    <x-slot name="body">


       
        @include('employee_emergency_contacts.form')
        
    </x-slot>
</x-form.index>