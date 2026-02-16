<div class="row">

    <x-form.hidden name="employee_id" :value="old('employee_id', $employee->id ?? '')" />


    <x-form.input :required="true" type="text" :label="__('Company Name')" name="company_name"
        :value="old('company_name', $form->company_name ?? '')" />
    <x-form.input :required="true" type="text" :label="__('Company Location')" name="company_location"
        :value="old('company_location', $form->company_location ?? '')" />
    <x-form.input :required="true" type="text" :label="__('Line of Business')" name="line_of_business"
        :value="old('line_of_business', $form->line_of_business ?? '')" />
    <x-form.input :required="true" type="text" :label="__('Position Held')" name="position_held"
        :value="old('position_held', $form->position_held ?? '')" />
    <x-form.textarea :required="true" :label="__('Job Description')" name="job_description"
        :value="old('job_description', $form->job_description ?? '')" />
    <x-form.textarea :required="true" :label="__('Achievement')" name="achievement" :value="old('achievement', $form->achievement ?? '')" />
    <x-form.datepicker :required="true" :label="__('Start Periode')" name="start_period" :value="old('start_period', $form->start_period ?? '')" />
    <x-form.datepicker :required="true" :label="__('End Periode')" name="end_period" :value="old('end_period', $form->end_period ?? '')" />

    <x-currency-dropdown :required="true" label="Initial Currency" name="initial_currency"
        :value="old('initial_currency', $form->initial_currency ?? '')" />


    <x-form.currency :required="true" :label="__('Initial Salary')" name="initial_sallary"
        :value="old('initial_sallary', $form->initial_sallary ?? '')" />


    <x-period-dropdown :required="true" label="Initial Period" name="initial_period" :value="old('initial_period', $form->initial_period ?? '')" />
    <x-currency-dropdown :required="true" label="Last Currency" name="last_currency" :value="old('last_currency', $form->last_currency ?? '')" />


    <x-form.currency :required="true" :label="__('Last Salary')" name="last_sallary" :value="old('last_sallary', $form->last_sallary ?? '')" />


    <x-period-dropdown :required="true" label="Last Period" name="last_period" :value="old('last_period', $form->last_period ?? '')" />
    <x-reason-leaving-dropdown :required="true" :value="old('reason_leaving', $form->reason_leaving ?? '')" />

    <x-form.input type="text" :label="__('Reference Name')" name="reference_name" :value="old('reference_name', $form->reference_name ?? '')" />
    <x-form.input type="number" :label="__('Reference Phone')" name="reference_phone" :value="old('reference_phone', $form->reference_phone ?? '')" />
    <x-form.input type="text" :label="__('Reference Position')" name="reference_position"
        :value="old('reference_position', $form->reference_position ?? '')" />


</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            const startDateInput = $('input[name="start_period"]');
            const endDateInput = $('input[name="end_period"]');
            const form = startDateInput.closest('form');

            function validateDates() {
                const startDate = new Date(startDateInput.val());
                const endDate = new Date(endDateInput.val());

                if (startDateInput.val() && endDateInput.val() && startDate > endDate) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Tanggal Tidak Valid / Invalid Date Range',
                        html: '<strong>ID:</strong> Tanggal Mulai tidak boleh melebihi Tanggal Selesai.<br><strong>EN:</strong> Start Period cannot be after End Period.',
                        confirmButtonText: 'OK'
                    });
                    endDateInput.val(''); // Clear the invalid end date
                    return false;
                }
                return true;
            }

            endDateInput.on('change', validateDates);
            startDateInput.on('change', validateDates);

            form.on('submit', function (e) {
                if (!validateDates()) {
                    e.preventDefault();
                    return false;
                }
            });
        });
    </script>
@endpush