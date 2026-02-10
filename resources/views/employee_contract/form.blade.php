<div class="row">

    <x-form.hidden name="employee_id" :value="old('employee_id', $employee->id ?? '')"/>


    <x-form.select required label="Status" name="status" :value="old('status', $form->status ?? '')"
                   :list="\App\Models\EmployeeContract::statusDropdown()"/>


    <x-form.datepicker :label="__('Date Start')" name="date_start" :value="$form->date_start ?? ''"/>
    <x-form.datepicker :label="__('Date End')" name="date_end" :value="$form->date_end ?? ''"/>
    <x-form.file required folder="employee_contract" :label="__('File')" name="file" :value="$form->file ?? ''"/>

    <x-form.texteditor :label="__('Notes')" name="notes" :value="$form->notes ?? ''"/>


</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            const startDateInput = $('input[name="date_start"]');
            const endDateInput = $('input[name="date_end"]');
            const form = startDateInput.closest('form');

            function validateDates() {
                const startDate = new Date(startDateInput.val());
                const endDate = new Date(endDateInput.val());

                if (startDateInput.val() && endDateInput.val() && startDate > endDate) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Date Range',
                        text: 'Start Date cannot be after End Date.',
                    });
                    endDateInput.val(''); // Clear the invalid end date
                    return false;
                }
                return true;
            }

            endDateInput.on('change', validateDates);
            startDateInput.on('change', validateDates);

            form.on('submit', function(e) {
                if (!validateDates()) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endpush
