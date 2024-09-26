<x-form.index :title="__('Edit') . ' ' . __('Payslip')" 
    :action="route('employee-payslips.update', [ $form->id])" 
    :cancel="route('employee-payslips.index')">


    <x-slot name="body">
        @method('PUT')

        @include('employee_payslips.form')

    </x-slot>
</x-form.index>
