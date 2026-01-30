
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

        if (deduction_details_data.length > 0) {
            $.each(deduction_details_data, function(key, value) {
                add_deduction(value);
            });
        }


        if (earning_details_data.length > 0) {
            $.each(earning_details_data, function(key, value) {
                add_earning(value);
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

        function add_deduction(value) {
            row_deduction++;


            var insert = `<div class="row row-payslip">
            <x-form.select add_class="deduction-type-` + row_deduction +
                `" class="col-12 col-lg-3" label="Type" name="deduction[` + row_deduction + `][type]" :list="\App\Models\EmployeePayslipMaster::type_dropdown()" />
            <x-form.select  add_class="deduction-master-` + row_deduction +
                `"  label="Deduction Type" :list="\App\Models\EmployeePayslipMaster::masterTypeDeduction()->orderBy('name')->pluck('name','id')" class="col-12 col-lg-5" name="deduction[` +
                row_deduction + `][master_id]" value="` + master_id + `"/>
            <x-form.currency class="col-12 col-lg-3" add_class="deduction-amount-` + row_deduction +
                `" :label="__('Amount')" name="deduction[` + row_deduction + `][amount]" value="" />
            <div class="col-12 col-lg-1">
            <button type="button" class="btn btn-danger w-100 btn-delete-payslip-detail" >X</button>

            </div>
        </div>`;
            $(".deduction_div .form").append(insert);


            $(".deduction-type-" + row_deduction).select2();
            $(".deduction-master-" + row_deduction).select2();


            var type = '';
            var master_id = '';
            var amount = 0;
            if (value != null) {
                type = value.type;
                master_id = value.employee_payslip_master_id;
                amount = value.value;

                var amount_input = $(".deduction-amount-" + row_deduction);
                amount_input.val(amount);
                formattedcurrency(amount_input);
                $(".deduction-type-" + row_deduction).val(type).trigger('change');
                $(".deduction-master-" + row_deduction).val(master_id).trigger('change');
            }

            state_empty();
        }



        $("#add_earning").on('click', function() {

            add_earning(null);
        });

        function add_earning(value) {
            row_earning++;

            var insert = `<div class="row row-payslip">
            <x-form.select add_class="earning-type-` + row_earning +
                `" class="col-12 col-lg-3" label="Type" name="earning[` + row_earning + `][type]" :list="\App\Models\EmployeePayslipMaster::type_dropdown()" />
            <x-form.select  add_class="earning-master-` + row_earning +
                `"  label="Earning Type" :list="\App\Models\EmployeePayslipMaster::masterTypeEarning()->orderBy('name')->pluck('name','id')" class="col-12 col-lg-5" name="earning[` +
                row_earning + `][master_id]" value="` + master_id + `"/>
            <x-form.currency class="col-12 col-lg-3" add_class="earning-amount-` + row_earning +
                `" :label="__('Amount')" name="earning[` + row_earning + `][amount]" value="" />
            <div class="col-12 col-lg-1">
            <button type="button" class="btn btn-danger w-100 btn-delete-payslip-detail" >X</button>

            </div>
        </div>`;
            $(".earning_div .form").append(insert);

            $(".earning-type-" + row_earning).select2();
            $(".earning-master-" + row_earning).select2();


            var type = '';
            var master_id = '';
            var amount = 0;
            if (value != null) {
                type = value.type;
                master_id = value.employee_payslip_master_id;
                amount = value.value;

                var amount_input = $(".earning-amount-" + row_earning);
                amount_input.val(amount);
                formattedcurrency(amount_input);
                $(".earning-type-" + row_earning).val(type).trigger('change');
                $(".earning-master-" + row_earning).val(master_id).trigger('change');

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
    </script>
@endif