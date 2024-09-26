<x-form.index 
    :title="__('Edit') . ' ' . __('Contract')" 
    :action="route('contract.update', [$employee, $form->id])" 
    :cancel="route('contract.index', $employee)"
    
    >


    <x-slot name="body">
        @method('PUT')

        @include('employee_contract.form')

    </x-slot>
</x-form.index>
