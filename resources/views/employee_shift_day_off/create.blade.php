<x-form.index :title="__('Add') . ' ' . __('Day Off')" :action="route('employee-shifts-day-off.store')" :cancel="route('employee-shifts-day-off.index')">


    <x-slot name="body">





        <x-company-dropdown />

        <div id="day-off-container">
            
        </div>


        <div class="text-end">

            <button class="btn btn-primary" type="button" id="add-data-day-off">Add Data</button>
        </div>
    </x-slot>
</x-form.index>
