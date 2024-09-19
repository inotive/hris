<x-form.index 
    :title="__('Add') . ' ' . __('Organization Experiance')"
    :action="route('organization-experience.store', $employee)" 
    :cancel="route('organization-experience.index', $employee)" 
    
    >


    <x-slot name="body">


       
        @include('employee_organization_experiences.form')
        
    </x-slot>
</x-form.index>