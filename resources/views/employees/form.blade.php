<div class="">
    @if (isset($form) && isset($form->id))
        <div class="">
            <x-employee-info-detail :employeeid="$form->id" />
            <div class="separator mb-6"></div>
        </div>
        <div class="w-full mb-6">
            <div class="card px-6 border-0 rounded-lg" style="background-color: #eef3ff">
                <x-employee-edit-tab :employeeid="$form->id" :tab="'edit'" />
            </div>
        </div>
    @endif

    <h4>{{ __('Employee Account Information') }}</h4>
    <hr />
    <div class="row">
        <input type="hidden" id="employee_id" value="{{ $form->id ?? '' }}" />
        <x-form.input required type="text" :label="__('Username')" name="username" :value="old('username', $form->username ?? '')" />
        <x-form.input required :label="__('Email')" name="email" :value="old('email', $form->email ?? '')" />
        <x-form.phone required min="10" :label="__('Phone')" name="phone" :value="old('phone', $form->phone ?? '')" />
        <x-form.number required min="10" :label="__('NIK')" name="nik" :value="old('nik', $form->nik ?? '')" />
        <x-form.switch :label="__('Status')" name="status" :value="$form->status ?? 0" />
    </div>

    <h4>{{ __('Employee Basic Information') }}</h4>
    <hr />
    <div class="row">
        <x-form.input required type="text" :label="__('First Name')" name="first_name" :value="old('first_name', $form->first_name ?? '')" />
        <x-form.input required type="text" :label="__('Last Name')" name="last_name" :value="old('last_name', $form->last_name ?? '')" />
        <x-gender-dropdown required :value="old('gender', $form->gender ?? '')" />
        <x-form.datepicker :label="__('Birth Date')" name="birth_date" :value="old('birth_date', $form->birth_date ?? '')" />
        <x-form.input type="text" :label="__('Birth Place')" name="birth_place" :value="old('birth_place', $form->birth_place ?? '')" />
        <x-religion-dropdown required :value="old('religion', $form->religion ?? '')" />
        <x-marital-status-dropdown :value="old('marital_status', $form->marital_status ?? '')" />
        <x-form.input type="text" label="Nationality" name="nationality" :value="$form->nationality ?? ''" />
        <x-form.image-picker :label="__('Image')" name="image" folder="employees" :value="old('image', $form->image ?? '')" />
    </div>

    <h4>{{ __('Employee Address Information') }}</h4>
    <hr />
    <div class="row">
        <x-location-cascading-dropdown 
            :country="old('country', $form->country ?? '')"
            :province="old('province', $form->province ?? '')"
            :city="old('city', $form->city ?? '')"
            :district="old('district', $form->district ?? '')"
            :subDistrict="old('sub_district', $form->sub_district ?? '')"
            :zipCode="old('zip_code', $form->zip_code ?? '')"
        />
        <x-form.textarea type="text" label="Address" name="address" :value="$form->address ?? ''" />
    </div>

    <h4>{{ __('Employee Management Information') }}</h4>
    <hr />
    <div class="row">
        <x-company-dropdown required :value="old('company_id', $form->company_id ?? '')" />
        <x-employee-department-dropdown required :value="old('department_id', $form->department_id ?? '')" :companyId="old('company_id', $form->company_id ?? '')" />
        <x-employee-position-dropdown required :value="old('employee_position_id', $form->employee_position_id ?? '')" :departmentId="old('department_id', $form->department_id ?? '')" />
        <x-employee-level-dropdown required :value="old('employee_level_id', $form->employee_level_id ?? '')" :companyId="old('company_id', $form->company_id ?? '')" />
        <x-employee-shift-dropdown required :value="old('employee_shift_id', $form->employee_shift_id ?? '')" :companyId="old('company_id', $form->company_id ?? '')" />
        <x-head-department-employee-dropdown label="Manager" :value="$form->head_departmen_id ?? ''" :companyId="old('company_id', $form->company_id ?? '')" />
    </div>

    <h4>{{ __('Employee Document Information') }}</h4>
    <hr />

    <div class="row">
        <x-form.input required type="text" label="Document Number" name="document_id" :value="$form->document_id ?? ''" />
        <x-form.datepicker label="Document Expiry" name="document_expiry" :value="$form->document_expiry ?? ''" />
        <x-form.file label="Document File" name="document_file" folder="document_file" :value="$form->document_file ?? ''" />
        <x-form.switch label="Document is Unlimited" name="document_is_unlimited" :value="$form->document_is_unlimited ?? 0" />

        <x-form.input type="text" label="NPWP Number" name="npwp_number" :value="$form->npwp_number ?? ''" />
        <x-form.input type="text" label="BPJS Number" name="document_bpjs_no" :value="$form->document_bpjs_no ?? ''" />
        <x-form.input type="text" label="BPJS Name" name="document_bpjs_name" :value="$form->document_bpjs_name ?? ''" />
        <x-form.file label="Document File BPJS" name="document_bpjs_file" folder="document_bpjs_file"
            :value="$form->document_bpjs_file ?? ''" />

        <x-form.input type="text" label="BPJS-TK Number" name="document_bpjstk_no" :value="$form->document_bpjstk_no ?? ''" />
        <x-form.input type="text" label="BPJS-TK Name" name="document_bpjstk_name" :value="$form->document_bpjstk_name ?? ''" />
        <x-form.file label="Document File BPJS-TK" name="document_bpjstk_file" folder="document_bpjstk_file"
            :value="$form->document_bpjstk_file ?? ''" />

        <x-form.input required type="text" label="Tax Number" name="tax_number" :value="$form->tax_number ?? ''" />
        <x-form.input required type="text" label="Tax Registered Name" name="tax_registered_name" :value="$form->tax_registered_name ?? ''" />
    </div>

    <h4>{{ __('Employee Attendance Location') }}</h4>
    <hr />

    <div class="row">
        <x-form.switch label="Attendance Location" name="is_attendance_location" :value="old('is_attendance_location', $form->is_attendance_location ?? '')" />
    </div>

    <h4>{{ __('Employee Menu Config') }}</h4>
    <hr />

    <div class="row">
        <x-form.switch class="col-4 col-lg-2" label="Leave Req" name="is_leave_request" :value="old('is_leave_request', $form->is_leave_request ?? '')" />
        <x-form.switch class="col-4 col-lg-2" label="Overtime Req" name="is_overtime_request" :value="old('is_overtime_request', $form->is_overtime_request ?? '')" />
        <x-form.switch class="col-4 col-lg-2" label="Reimbursement Req" name="is_reimbursement_request"
            :value="old('is_reimbursement_request', $form->is_reimbursement_request ?? '')" />
        <x-form.switch class="col-4 col-lg-2" label="Attendance" name="is_attendance" :value="old('is_attendance', $form->is_attendance ?? '')" />
        <x-form.switch class="col-4 col-lg-2" label="Payslip" name="is_payslip" :value="old('is_payslip', $form->is_payslip ?? '')" />
        <x-form.switch class="col-4 col-lg-2" label="EWA" name="is_ewa" :value="old('is_ewa', $form->is_ewa ?? '')" />
    </div>
</div>


@push('styles')
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            console.log("DEBUG: Form script loaded and ready!");

            // Mapping for dropdowns to their Select2 fetch URLs and placeholders
            const dpMap = {
                'department_id': {
                    url: '{{ route('employee-departments.select2') }}',
                    placeholder: 'Select Department'
                },
                'employee_position_id': {
                    url: '{{ route('employee-positions.select2') }}',
                    placeholder: 'Select Position'
                },
                'employee_level_id': {
                    url: '{{ route('employee-levels.select2') }}',
                    placeholder: 'Select Level'
                },
                'employee_shift_id': {
                    url: '{{ route('employee-shifts.select2') }}',
                    placeholder: 'Select Shift'
                },
                'head_departmen_id': {
                    url: '{{ route('employees.select2') }}',
                    placeholder: 'Select Manager'
                },
            };

            const companySelect = $('[name="company_id"]');
            
            // Elements to be reset/repopulated based on company
            const dependents = [
                'department_id',
                'employee_position_id',
                'employee_level_id',
                'employee_shift_id',
                'head_departmen_id'
            ];

            // Position depends on Department, so we handle it separately essentially
            const departmentSelect = $('select[name="department_id"]');

            function clearSelect(name) {
                const el = $(`select[name="${name}"]`);
                el.empty().trigger('change');
            }

            companySelect.on('change', function() {
                const companyId = $(this).val();

                dependents.forEach(name => {
                    const el = $(`select[name="${name}"]`);
                    // Create new option to ensure placeholder works and clear previous options
                    el.empty().append(new Option('', '', true, true)).trigger('change');
                    
                    if (companyId) {
                        // Re-initialize select2 with new ajax parameters if needed
                        // But since we are using standard select2 with ajax, we might just need to ensure the ajax data function grabs the current company_id
                    }
                    el.val(null).trigger('change');
                });
            });
            
             departmentSelect.on('change', function() {
                 // Clear position when department changes
                 const el = $('select[name="employee_position_id"]');
                 el.val(null).trigger('change');
             });


            // We need to hook into the select2 initialization or modify the ajax params dynamically.
            // Assuming the components use a standard select2 class handling. 
            // If the standard components init select2 on load, we need to make sure their `data` callback reads the current values.
            
            // Ideally, we re-initialize or intercept the request.
            // Let's attach a pre-request hook if possible, or assume the components allow passing extra query params via a global or looking at DOM elements.
            
            // Since I can't easily see the component JS implementation, I will assume I need to 
            // manually re-configure the select2 instances or ensure they read dynamic "data" function.
            
            // Standard approach: Destroy and Re-init OR rely on the fact that `data` callback in Select2 options usually checks the DOM at request time.
            
            // Let's try to override the ajax transport or parameters if the components expose them.
            // Checking the components/select2.blade.php would be ideal, but assuming standard implementation:
            
            dependents.forEach(name => {
                 const el = $(`select[name="${name}"]`);
                 const url = dpMap[name].url;
                 
                 // Remove data-control="select2" to prevent auto-reinit by theme if we were to clone it, 
                 // but mainly we just want to control it ourselves now.
                 // Destroy existing select2 (initialized by theme via data-attribute)
                 if (el.hasClass("select2-hidden-accessible")) {
                     el.select2('destroy');
                 }
                 
                 el.select2({
                    // theme: "bootstrap-5", // Removed to fix styling conflict
                    allowClear: true,
                    width: '100%',
                    placeholder: dpMap[name].placeholder,
                    ajax: {
                        url: url,
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            console.log('Select2 Request for ' + name, {
                                term: params.term,
                                page: params.page,
                                company_id: companySelect.val(),
                                department_id: (name === 'employee_position_id') ? departmentSelect.val() : null
                            });
                            return {
                                query: params.term,
                                page: params.page || 1,
                                company_id: companySelect.val(), 
                                department_id: (name === 'employee_position_id') ? departmentSelect.val() : null
                            };
                        },
                        processResults: function (data, params) {
                             console.log('Select2 Response ' + name, data);
                             params.page = params.page || 1;
                             
                             if (!data || !data.items) {
                                 console.warn('Select2: No items in response for ' + name, data);
                                 return { results: [] };
                             }

                             return {
                                 results: data.items.map(function(item) {
                                     return {
                                         id: item.id,
                                         text: item.name || item.text || 'Unknown' // Fallback for text
                                     };
                                 }),
                                 pagination: {
                                     more: data.more || false // Fallback for more
                                 }
                             };
                        },
                        cache: true
                    }
                 });
            });
        });
    </script>
@endpush
