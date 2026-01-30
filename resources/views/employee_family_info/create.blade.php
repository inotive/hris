<x-form.index 
    :title="__('Add') . ' ' . __('Family Info')"
    :action="route('family-info.store', $employee)" 
    :cancel="route('family-info.index', $employee)" 
    
    >


    <x-slot name="body">


       
        @include('employee_family_info.form')
        
    </x-slot>
</x-form.index>