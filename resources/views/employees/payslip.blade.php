<x-form.index :action="$form_action" :cancel="$cancel">
    <x-slot name="title">{{ __('Payroll Information') }}</x-slot>

    <x-slot name="toolbar">

    </x-slot>

    <x-slot name="toolbar">
        <x-employee-edit-tab :employeeid="$employee->id" tab="payslip" />
    </x-slot>

    <x-slot name="body">
        <input type="hidden" id="deduction_details_data" value="{{ json_encode($deduction_details ?? []) }}" />
        <input type="hidden" id="earning_details_data" value="{{ json_encode($earning_details ?? []) }}" />
  
        <input type="hidden" id="form_data" value="{{ json_encode($form ?? []) }}"/>
        <input type="hidden" name="employee_id" value="{{ $employee->id ?? '' }}"/>

        <div class="row">
            <h4>{{ __('Earning Detail') }}</h4>
            <hr>


            <div class="earning_div">

                <div class="row-button text-end">
                    <button class="btn btn-primary" type="button" id="add_earning"
                        href="">{{ __('Add Earning') }}</button>
                </div>

                <div class="empty">
                    <x-table.empty />
                </div>
                <div class="form"></div>
            </div>

            <div class="mt-5"></div>
            <div class="mt-5"></div>
            <div class="mt-5"></div>
            <div class="mt-5"></div>

            <h4>{{ __('Deduction Detail') }}</h4>
            <hr>



            <div class="deduction_div mb-5">
                <div class="row-button text-end">
                    <button class="btn btn-primary" type="button" id="add_deduction"
                        href="">{{ __('Add Deduction') }}</button>
                </div>

                <div class="empty">
                    <x-table.empty />
                </div>
                <div class="form"></div>
            </div>
        </div>

    </x-slot>
</x-form.index>
