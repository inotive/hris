<x-form.index :title="__('Edit') . ' ' . __('Education')" :action="route('education.update', [$employee, $form->id])" :cancel="route('education.index', $employee)">


    <x-slot name="body">
        @method('PUT')

        @include('employee_education.form')

    </x-slot>
</x-form.index>
