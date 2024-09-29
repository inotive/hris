<div class="row">
    <input type="hidden" id="expenses_data" value="{{ json_encode($form->expenses ?? []) }}" />

    <input type="hidden" id="employee_name" value="{{ $form->employee->full_name ?? '' }}" />
    <input type="hidden" id="company_name" value="{{ $form->company->name ?? '' }}" />
    <input type="hidden" id="form_data" value="{{ json_encode($form ?? []) }}" />
    <input type="hidden" name="request_id" value="{{ $form->id ?? '' }}" />

    <x-company-dropdown :value="old('company_id', $form->company_id ?? '')" />
    <x-employee-dropdown :value="old('employee_id', $form->employee_id ?? '')" />

    <x-form.datepicker :label="__('Date')" name="date" :value="old('date', $form->date ?? '')" />

    <x-form.select :label="__('Type')" :list="\App\Models\ReimbursementType::pluck('name', 'id')" name="reimbursement_type_id" :value="old('reimbursement_type_id', $form->reimbursement_type_id ?? '')" />


    <x-manager-dropdown :label="__('Approver')" :value="old('manager_id', $form->manager_id ?? '')" />

    <div class="row">
        <div class="col-12 col-lg-6">
            <x-form.attachment class="" label="Files" name="files" :files="$files ?? []" folder="leave_request" />
        </div>
    </div>

    <h4 class="mt-4">{{ __('Expenses') }}</h4>
    <hr>



    <div class="expense_div mb-5">
        <div class="row-button text-end">
            <button class="btn btn-primary" type="button" id="add_expense"
                href="">{{ __('Add Expense') }}</button>
        </div>

        <div class="empty">
            <x-table.empty />
        </div>
        <div class="form"></div>
    </div>



</div>
