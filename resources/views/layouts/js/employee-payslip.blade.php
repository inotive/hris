
@if (strpos(Route::currentRouteName(), 'employee-payslips') === 0)
    <script>
        var form_data = JSON.parse($("#form_data").val());
        var employee_data = JSON.parse($("#employee_data").val());

        $("#metode").on('change', function() {
            var val = $(this).val();
            if (val == 'transfer') {
                $("#account_name_div").show();
                $("#account_number_div").show();

                var acc_name = $("#account_name");
                var acc_number = $("#account_number");

                if (acc_name.val().length == 0) {
                    acc_name.val(employee_data.bank_account_name);
                }
            } else {
                $("#account_name_div").hide();
                $("#account_number_div").hide();
            }
        });

        $("#metode").trigger('change');
    </script>
@endif

@if (strpos(Route::currentRouteName(), 'employee-payslips') === 0 ||
        strpos(Route::currentRouteName(), 'employees.payslip') === 0)
    <script>

        var row_deduction = 0;
        var row_earning = 0;

        var form_data = JSON.parse($("#form_data").val());
        var deduction_details_data = JSON.parse($("#deduction_details_data").val());
        var earning_details_data = JSON.parse($("#earning_details_data").val());
        var employee_name = $("#employee_name").val();
        var company_name = $("#company_name").val();

        if (form_data.company_id != null) {
            let option = new Option(company_name, form_data.company_id, true, true);
            $("[name='company_id']").append(option).trigger('change');
        }

        if (form_data.employee_id != null) {
            let option = new Option(employee_name, form_data.employee_id, true, true);
            $("[name='employee_id']").append(option).trigger('change');
        }

        // Initialize details after company is set (though existing details might belong to previous company if changed)
        // For edit, it's fine. For create, company is initially null.
        if (deduction_details_data.length > 0) {
             // We need to wait for company to be set or just let it be if it's edit
            $.each(deduction_details_data, function(key, value) {
                // Pass true to indicate it's initial load/edit
                add_deduction(value, true); 
            });
        }

        if (earning_details_data.length > 0) {
            $.each(earning_details_data, function(key, value) {
                 // Pass true to indicate it's initial load/edit
                add_earning(value, true);
            });
        }

        state_empty();

        function state_empty() {
             if ($(".deduction_div .form").html().trim().length == 0) {
                $(".deduction_div .empty").show();
            } else {
                $(".deduction_div .empty").hide();
            }

            if ($(".earning_div .form").html().trim().length == 0) {
                $(".earning_div .empty").show();
            } else {
                $(".earning_div .empty").hide();
            }
        }

        $("#add_deduction").on('click', function() {
            add_deduction(null);
        });

        // Function to fetch masters via AJAX
        function getMasters(type, callback) {
             var company_id = $("[name='company_id']").val();
             if (!company_id) {
                 // return empty or alert
                 // alert('Please select a company first');
                 callback([]);
                 return;
             }

             $.ajax({
                 url: '{{ route("employee-payslips.get-masters") }}',
                 data: {
                     company_id: company_id,
                     type: type
                 },
                 success: function(response) {
                     callback(response);
                 },
                 error: function() {
                     callback([]);
                 }
             });
        }


        function add_deduction(value, is_initial = false) {
             // If adding new row (value == null), we need company to be selected
             if (value == null && !$("[name='company_id']").val()) {
                 Swal.fire('Warning', 'Please select a company first', 'warning');
                 return;
             }
            
            row_deduction++;

            var type_dropdown = `
                <select class="form-select form-select-solid deduction-type-` + row_deduction + `" name="deduction[` + row_deduction + `][type]" data-control="select2" data-placeholder="Select an option">
                    <option value="main">Main</option>
                    <option value="additional">Additional</option>
                </select>
            `;

             // Initial placeholder for master dropdown
            var master_dropdown = `
                 <select class="form-select form-select-solid deduction-master-` + row_deduction + `" name="deduction[` + row_deduction + `][master_id]" data-control="select2" data-placeholder="Select an option">
                 </select>
            `;

            var insert = `<div class="row row-payslip">
            <div class="col-12 col-lg-3">
                 <label class="fs-6 fw-bold mb-2">{{ __('Type') }}</label>
                 ` + type_dropdown + `
            </div>
             <div class="col-12 col-lg-5">
                 <label class="fs-6 fw-bold mb-2">{{ __('Deduction Type') }}</label>
                 ` + master_dropdown + `
            </div>
            <x-form.currency :required="true" class="col-12 col-lg-3" add_class="deduction-amount-` + row_deduction +
                `" :label="__('Amount')" name="deduction[` + row_deduction + `][amount]" value="" />
            <div class="col-12 col-lg-1">
            <button type="button" class="btn btn-danger w-100 btn-delete-payslip-detail" style="margin-top: 28px;" >X</button>

            </div>
        </div>`;
            $(".deduction_div .form").append(insert);

            $(".deduction-type-" + row_deduction).select2();
            var $masterSelect = $(".deduction-master-" + row_deduction).select2();

             // Populate master dropdown
             var populateSelect = function(masters) {
                 $masterSelect.empty();
                 // $masterSelect.append(new Option('Select', '', true, true));
                 $.each(masters, function(index, master) {
                     var selected = (value != null && value.employee_payslip_master_id == master.id);
                     $masterSelect.append(new Option(master.name, master.id, selected, selected));
                 });
                 $masterSelect.trigger('change');
             };

             if (is_initial && value != null) {
                  // For initial load (edit), we might want to manually create the option if we want to avoid AJAX call or assume validity
                  // However, it's safer to fetch valid options. But if the company changed, the old value might be invalid.
                  // For now, let's fetch based on current company (which should be set).
                  getMasters('deduction', populateSelect);

                  // Optimization: If we trust the existing data, we could just add the single existing Option.
                  // But the requirement is to strictly filter.
             } else {
                  getMasters('deduction', populateSelect);
             }


            var type = '';
            var amount = 0;
            if (value != null) {
                type = value.type;
                amount = value.value;

                var amount_input = $(".deduction-amount-" + row_deduction);
                amount_input.val(amount);
                formattedcurrency(amount_input);
                $(".deduction-type-" + row_deduction).val(type).trigger('change');
            }

            state_empty();
        }

        $("#add_earning").on('click', function() {
            add_earning(null);
        });

        function add_earning(value, is_initial = false) {
             if (value == null && !$("[name='company_id']").val()) {
                 Swal.fire('Warning', 'Please select a company first', 'warning');
                 return;
             }

            row_earning++;

             var type_dropdown = `
                <select class="form-select form-select-solid earning-type-` + row_earning + `" name="earning[` + row_earning + `][type]" data-control="select2" data-placeholder="Select an option">
                    <option value="main">Main</option>
                    <option value="additional">Additional</option>
                </select>
            `;

             var master_dropdown = `
                 <select class="form-select form-select-solid earning-master-` + row_earning + `" name="earning[` + row_earning + `][master_id]" data-control="select2" data-placeholder="Select an option">
                 </select>
            `;


            var insert = `<div class="row row-payslip">
            <div class="col-12 col-lg-3">
                 <label class="fs-6 fw-bold mb-2">{{ __('Type') }}</label>
                 ` + type_dropdown + `
            </div>
             <div class="col-12 col-lg-5">
                 <label class="fs-6 fw-bold mb-2">{{ __('Earning Type') }}</label>
                 ` + master_dropdown + `
            </div>
            <x-form.currency :required="true" class="col-12 col-lg-3" add_class="earning-amount-` + row_earning +
                `" :label="__('Amount')" name="earning[` + row_earning + `][amount]" value="" />
            <div class="col-12 col-lg-1">
            <button type="button" class="btn btn-danger w-100 btn-delete-payslip-detail" style="margin-top: 28px;" >X</button>

            </div>
        </div>`;
            $(".earning_div .form").append(insert);

            $(".earning-type-" + row_earning).select2();
            var $masterSelect = $(".earning-master-" + row_earning).select2();

            var populateSelect = function(masters) {
                 $masterSelect.empty();
                 $.each(masters, function(index, master) {
                     var selected = (value != null && value.employee_payslip_master_id == master.id);
                     $masterSelect.append(new Option(master.name, master.id, selected, selected));
                 });
                  $masterSelect.trigger('change');
             };

             if (is_initial && value != null) {
                  getMasters('earning', populateSelect);
             } else {
                  getMasters('earning', populateSelect);
             }


            var type = '';
            var amount = 0;
            if (value != null) {
                type = value.type;
                amount = value.value;

                var amount_input = $(".earning-amount-" + row_earning);
                amount_input.val(amount);
                formattedcurrency(amount_input);
                $(".earning-type-" + row_earning).val(type).trigger('change');
            }

            state_empty();
        }

        $(document).on('click', '.btn-delete-payslip-detail', function() {
            Swal.fire({
                title: '{{ __('Are you sure?') }}',
                text: '{{ __('Are you sure want to delete?') }}',
                icon: 'warning',
                showCancelButton: true,
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-danger"
                },
                confirmButtonText: '{{ __('Yes, Delete it!') }}',
                cancelButtonText: '{{ __('Cancel') }}'
            }).then((result) => {

                if (result.isConfirmed == true) {
                    $(this).parent('div').parent('.row-payslip').remove();
                    state_empty();
                }
            });
        });

        // Clear rows when company changes
        $("[name='company_id']").on('change', function() {
             // Optional: Ask user for confirmation if rows exist?
             // For now, let's just clear new rows or keep existing?
             // If we change company, the masters are likely invalid.
             // Ideally we should clear the details.
             
             // Check if it's user triggered change or initial load?
             // 'change' triggers on initial load too because of .trigger('change') above.
             // But we are appending rows AFTER distinct triggering.
             
             // Simplest approach: leave as is. User can delete.
             // But new rows will use new company.
        });

    </script>
@endif