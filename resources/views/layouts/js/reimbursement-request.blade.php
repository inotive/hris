@if (strpos(Route::currentRouteName(), 'reimbursement-requests.') === 0)
    <script>
        var row_expense = 0;

        var form_data = JSON.parse($("#form_data").val());
        var expenses_data = JSON.parse($("#expenses_data").val());
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

       $(document).ready(function() {
            if (expenses_data.length > 0) {
                $.each(expenses_data, function(key, value) {
                    add_expense(value);
                });
            }
        });


        state_empty();

        function state_empty() {
            if ($(".expense_div .form").html().trim().length == 0) {
                $(".expense_div .empty").show();
            } else {
                $(".expense_div .empty").hide();
            }

        }


        $("#add_expense").on('click', function() {
            add_expense(null);
        });

        function add_expense(value) {
            row_expense++;


    

            var insert = `<div class="row row-expense">
            <x-form.select add_class="expenses expense-type-` + row_expense +`" class="col-12 col-lg-6" label="Type" name="expenses[` + row_expense + `][type]" :list="[]" />
           <x-form.currency class="col-12 col-lg-5" required add_class="expense-amount-` + row_expense +
                `" :label="__('Amount')" name="expenses[` + row_expense + `][amount]" value="" />
            <div class="col-12 col-lg-1">
            <button type="button" class="btn btn-danger w-100 btn-delete-expense" >X</button>

            </div>
        </div>`;
            $(".expense_div .form").append(insert);

            if (typeof initializeExpenseSelects === 'function') {
                initializeExpenseSelects($(".expense-type-" + row_expense));
            }


            // $(".expense-type-" + row_expense).select2();

            $(".expense-type-" + row_expense).val(value.reimbursement_expense_id).trigger('change');
            $(".expense-type-" + row_expense).data('data-id', value.reimbursement_expense_id);
            $(".expense-type-" + row_expense).data('data-name', value.name);


            var type = '';
            var master_id = '';
            var amount = 0;
            if (value != null) {
                type = value.reimbursement_expense_id;
                amount = value.value;

                var amount_input = $(".expense-amount-" + row_expense);
                amount_input.val(amount);
                formattedcurrency(amount_input);
                $(".expense-type-" + row_expense).val(type).trigger('change');

            }

            state_empty();
        }




        $(document).on('click', '.btn-delete-expense', function() {
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
                    $(this).parent('div').parent('.row-expense').remove();
                    state_empty();
                }


            });
        });
    </script>



    <script>
        $(document).ready(function() {

            setDefaultSelect2($(".reimbursement_type_id"));

            $('.reimbursement_type_id').select2({
                placeholder: 'Search Type',
                ajax: {
                    url: '{{ route('reimbursement-types.select2') }}', // Server endpoint
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {

                        return {
                            company_id: $("[name='company_id']").val(),
                            query: params.term, // Search query
                            page: params.page || 1 // Pagination
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: $.map(data.items, function(item) {
                                return {
                                    id: item.id,
                                    text: item.name // Display name in the dropdown
                                };
                            }),
                            pagination: {
                                more: data.more // Whether there are more results to load
                            }
                        };
                    },
                    cache: true
                },
                minimumInputLength: 0 // Start search after typing 1 character
            });


        });
    </script>

    <script>
        $(document).ready(function() {
            // Initialize existing selects
            initializeExpenseSelects($(".expenses"));

            // Function to initialize selects
            function initializeExpenseSelects(selects) {
                selects.each(function() {
                    if (!$(this).hasClass('select2-hidden-accessible')) {
                        setDefaultSelect2($(this));


        

                        $(this).select2({
                            placeholder: 'Search Expenses',
                            ajax: {
                                url: '{{ route('reimbursement-expenses.select2') }}',
                                dataType: 'json',
                                delay: 250,
                                data: function(params) {
                                    return {
                                        query: params.term,
                                        page: params.page || 1,
                                        company_id: $('select[name="company_id"]')
                                        .val() // Get company_id from form
                                    };
                                },
                                processResults: function(data, params) {
                                    params.page = params.page || 1;
                                    return {
                                        results: $.map(data.items, function(item) {
                                            return {
                                                id: item.id,
                                                text: item.name
                                            };
                                        }),
                                        pagination: {
                                            more: data.more
                                        }
                                    };
                                },
                                cache: true
                            },
                            minimumInputLength: 0
                        });
                    }
                });


            }

            // Re-initialize when new selects are added
            $(document).on('select2:open', () => {
                document.querySelector('.select2-search__field').focus();
            });

            // Expose the function to global scope so it can be called when adding new rows
            window.initializeExpenseSelects = initializeExpenseSelects;
        });
    </script>
@endif
