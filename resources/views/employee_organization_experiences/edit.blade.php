<x-form.index :title="__('Edit') . ' ' . __('Organization Experiance')" 
:action="route('organization-experience.update', [$employee, $form->id])" :cancel="route('organization-experience.index', $employee)">


    <x-slot name="body">
        @method('PUT')

        @include('employee_organization_experiences.form')

    </x-slot>
</x-form.index>
