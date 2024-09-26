<x-form.index :title="__('Edit') . ' ' . __('Payslip')" 
    :action="route('employee-payslips.update', [$employee, $form->id])" 
    :cancel="route('employee-payslips.index', $employee)">


    <x-slot name="body">
        @method('PUT')

        @include('employee_family_info.form')

    </x-slot>
</x-form.index>
