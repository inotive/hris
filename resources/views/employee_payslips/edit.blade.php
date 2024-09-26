<x-form.index :title="__('Edit') . ' ' . __('Family Info')" :action="route('family-info.update', [$employee, $form->id])" :cancel="route('family-info.index', $employee)">


    <x-slot name="body">
        @method('PUT')

        @include('employee_family_info.form')

    </x-slot>
</x-form.index>
