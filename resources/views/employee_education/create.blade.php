<x-form.index 
    :title="__('Add') . ' ' . __('Education')"
    :action="route('education.store', $employee)" 
    :cancel="route('education.index', $employee)" 
    
    >


    <x-slot name="body">


       
        @include('employee_education.form')
        
    </x-slot>
</x-form.index>