<x-form.index :title="__('Edit') . ' ' . __('Approval')" 
:action="route('approver.update', [$employee, $form->id])" :cancel="route('approver.index', $employee)">


    <x-slot name="body">
        @method('PUT')

        @include('employee_approver.form')

    </x-slot>
</x-form.index>
