<x-form.index :title="__('Edit') . ' ' . __('Day Off')" 
    :action="route('employee-shifts-day-off.update', [ $form->id])" 
    :cancel="route('employee-shifts-day-off.index')">


    <x-slot name="body">
        @method('PUT')

        @include('employee_shift_day_off.form')

    </x-slot>
</x-form.index>
