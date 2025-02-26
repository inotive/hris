<x-form.index :title="__('Edit') . ' ' . __('Leave')"
:action="route('leave.update', [$employee, $form->leave_type_id])" :cancel="route('leave.index', $employee)">


    <x-slot name="body">
        @method('PUT')

        @include('employee_leave.form')

    </x-slot>
</x-form.index>
