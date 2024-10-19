<x-form.index :action="$form_action" :cancel="$cancel">
    <x-slot name="title">{{ __('Payroll Information') }}</x-slot>

    <x-slot name="toolbar">

    </x-slot>

    <x-slot name="toolbar">
        <x-employee-edit-tab :employeeid="$employee->id" tab="payslip" />
    </x-slot>

    <x-slot name="body">


        <div class="row">
            <x-form.select :list="App\Models\BankList::pluck('name', 'name')" label="Bank Account Name" name="bank_account_name" :value="$employee->bank_account_name ?? ''" />
            <x-form.number type="text" label="Bank Account Number" name="bank_account_number" :value="$employee->bank_account_number ?? ''" />
            <x-form.datepicker :label="__('Join Date')" name="join_date" :value="old('join_date', $employee->join_date ?? '')" />

            <x-form.select :list="$ptkp_list" label="Jenis PTKP (TER)" name="type_ter" :value="$employee->type_ter ?? ''" />

            <x-form.select :list="['hourly' => 'Hourly', 'daily' => 'Daily']" label="Overtime Type" name="overtime_type" :value="$employee->overtime_type ?? ''" />
            <x-form.currency type="text" label="Overtime Value" name="overtime_value" :value="$employee->overtime_value ?? ''" />

            <x-form.select :list="['monthly' => 'Monthly', 'yearly' => 'Yearly']" label="Reimbursement Type" name="reimbursement_type" :value="$employee->reimbursement_type ?? ''" />

            <x-form.currency :label="__('Reimbursement Value')" name="reimbursement_limit" :value="old('reimbursement_limit', $employee->reimbursement_limit ?? '')" />

        </div>



        <input type="hidden" id="deduction_details_data" value="{{ json_encode($deduction_details ?? []) }}" />
        <input type="hidden" id="earning_details_data" value="{{ json_encode($earning_details ?? []) }}" />

        <input type="hidden" id="form_data" value="{{ json_encode($form ?? []) }}" />
        <input type="hidden" name="employee_id" value="{{ $employee->id ?? '' }}" />

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
