<x-form.index
    :title="__('Edit Emergency Contact')"
    :action="route('emergency-contact.update', [$employee, $form->id])" 
    :cancel="route('emergency-contact.index', $employee)" 
    >


    <x-slot name="body">
            @method('PUT')

        @include('employee_emergency_contacts.form')
        
    </x-slot>
</x-form.index>