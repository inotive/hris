<!-- Import Js Files -->
<script>var hostUrl = "assets/";</script>

<script src="{{asset('template/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('template/js/scripts.bundle.js')}}"></script>
<script src="{{asset('template/js/widgets.bundle.js')}}"></script>
<script src="{{asset('template/js/custom/widgets.js')}}"></script>
<script src="{{asset('assets/js/pace.min.js')}}"></script>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>

<script>
    $.fn.serializeWithUnchecked = function() {
        var form = this;

        // Serialize the form, including unchecked checkboxes as "unchecked"
        var formData = form.serializeArray();

        // Find unchecked checkboxes and add them to formData
        form.find('input[type=checkbox]:not(:checked)').each(function() {
            formData.push({ name: this.name, value: '0' });
        });

        $(".datepicker").each(function() {
            var name = $(this).attr("name");
            // Get the current value
            var dateStr = $(this).val();
            // Split the date by "/"
            var parts = dateStr.split("/");
            // Rearrange to YYYY-MM-DD
            if (parts.length === 3) {
                var formattedDate = parts[2] + '-' + parts[1] + '-' + parts[0];
                // Update the input value
                // $(this).val(formattedDate);

                let index = formData.findIndex(d => d.name === name);
                if (index !== -1) {
                    formData[index] = { name: name, value: formattedDate }
                }
            }
        });

        $("input.currency").each(function(){
            var name = $(this).attr("name");
            var val = $(this).val();
            val = val.replace(/\./g, '');
            val = val.replace(/\,/g, '.');
            
            let index = formData.findIndex(d => d.name === name);
            if (index !== -1) {
                formData[index] = { name: name, value: val }
            }
        });

        return formData;
    };
    $("#crud-form").on('submit', function(event){
        event.preventDefault(); 



        var submitButton = $("button[type='submit']");
        submitButton.prop('disabled',true);

        var action = $(this).attr('action');


        $.ajax({
            url: action,
            type: 'POST',
            data: $(this).serializeWithUnchecked(), // Serialize the form data
            success: function(response) {
                console.log(response);
                // Handle the success response
                // alert('Item deleted successfully!');
                // Optionally, redirect or update the page

                if (response.success == true) {
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toastr-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                        };

                        toastr.success(response.message);

                        setTimeout(function() {
                            console.log('This message is shown after 2 seconds');
                            window.location.href = response.redirect;
                        }, 500); 

                     
                } else {
                    Swal.fire({
                        title:'{{ __("Error!") }}',
                        text: response.message,
                        icon: 'error',
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                    });

                    submitButton.prop('disabled',false);
                }
                // window.location.reload();
            },
            error: function(xhr, status, error) {
                if (xhr.status == 403) {
                    Swal.fire({
                            title:'{{ __("Error!") }}',
                            text: '{{ __("Not Authorized") }}',
                            icon: 'error',
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                        });
                } else {
                    // Handle validation errors
                    var errors = xhr.responseJSON.errors;
                    var message = xhr.responseJSON.message;

                    $('.invalid-feedback').html("");
                    
                    if (errors != null) {
                       
                        // Display errors
                        $.each(errors, function (key, value) {
                            $('.' + key + '-error').append('<p>' + value + '</p>');
                        });

                    }  else {
                        // Handle the error response
                        Swal.fire({
                                title:'{{ __("Error!") }}',
                                text: message ?? 'Error',
                                icon: 'error',
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                },
                            });
                    }
                }

                submitButton.prop('disabled',false);
            },
            
        });
    });
</script>
<script>
$(".employee-reset-password").on('click', function(){

    Swal.fire({
        title: '{{ __("Are you sure?") }}',
        text: '{{ __("Are you sure want to send password, to employee?") }}',
        icon: 'warning',
        showCancelButton: true,
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-danger"
        },
        confirmButtonText: '{{ __("Yes, reset it!") }}',
        cancelButtonText: '{{ __("Cancel") }}'
    }).then((result) => {
            var email = $(this).data('email');
            var reset_password_url = $(this).data('reset-password-url');
            if (email.length == 0) {
                Swal.fire({
                        title:'{{ __("Email required") }}',
                        text: '{{ __("Email required") }}',
                        icon: 'error'
                    })
                return;
            }

            

            $.ajax({
                url:  reset_password_url,
                type: 'POST',
                data: {
                    '_token' : '{{ csrf_token() }}',
                    '_method': 'PUT',
                }, // Serialize the form data
                success: function(response) {
                    console.log(response);
                    // Handle the success response
                    // alert('Item deleted successfully!');
                    // Optionally, redirect or update the page

                    if (response.success == true) {
                        Swal.fire({
                            title:'{{ __("Success!") }}',
                            text: response.message,
                            icon: 'success'
                        }).then((result2) => {
                            // alert(result2);
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title:'{{ __("Error!") }}',
                            text: response.message,
                            icon: 'error'
                        })
                    }
                    // window.location.reload();
                },
                error: function(xhr) {
                    // Handle the error response
                    Swal.fire({
                        title:'{{ __("Error!") }}',
                        text: 'Error',
                        icon: 'error'
                    })
                }
            });

        });
});
</script>
<script>
$(".delete-button").click(function(e) {

    var delete_url = $(this).data('delete-url');

    Swal.fire({
        title: '{{ __("Are you sure?") }}',
        text: '{{ __("You won`t be able to revert this!") }}',
        icon: 'warning',
        showCancelButton: true,
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-danger"
        },
        confirmButtonText: '{{ __("Yes, delete it!") }}',
        cancelButtonText: '{{ __("Cancel") }}'
    }).then((result) => {
        if (result.isConfirmed) {
            
            $.ajax({
                url: delete_url,
                type: 'POST',
                data: {
                    '_token' : '{{ csrf_token() }}',
                    '_method': 'DELETE',
                }, // Serialize the form data
                success: function(response) {
                    console.log(response);
                    // Handle the success response
                    // alert('Item deleted successfully!');
                    // Optionally, redirect or update the page

                    if (response.success == true) {
                        Swal.fire({
                            title:'{{ __("Deleted!") }}',
                            text: '{{ __("Your item has been deleted.") }}',
                            icon: 'success'
                        }).then((result2) => {
                            // alert(result2);
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title:'{{ __("Error!") }}',
                            text: response.message,
                            icon: 'error'
                        })
                    }
                    // window.location.reload();
                },
                error: function(xhr) {
                    // Handle the error response


                    Swal.fire({
                        title:'{{ __("Error!") }}',
                        text: xhr.responseJSON.message ?? 'Error',
                        icon: 'error'
                    })
                }
            });
        }
    });
});
</script>

<script>
$('#role').on('change', function() {
    var val = $(this).val();

    if (val != "superadmin") {
        $("#company_id_div").show();
    } else {
        $("#company_id_div").hide();
    }
});
$("#role").trigger('change');
</script>

<script>
    var dropdown = $('.table-filter');
    dropdown.select2({
        placeholder: dropdown.data('placeholder'), // Placeholder text
        allowClear: true // Enable the clear button
    });
    dropdown.on('change', function() {
        $(this).parent('form').submit();
    });
</script>

<script>
$(".datepickersingle").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        maxYear: parseInt(moment().format("YYYY"),12),
        locale: {
            format: "DD/MM/Y"
        },
    }
);



$(".datetimepickerinput").daterangepicker({
        singleDatePicker: true,
        timePicker: true,
        showDropdowns: true,
        minYear: 1901,
        maxYear: parseInt(moment().format("YYYY"),12),
        locale: {
            format: "Y-MM-DD HH:mm:ss"
        }
    }
);
</script>


<script>
    // currency
    function formattedcurrency(selector)
    {
        let value = $(selector).val();
        
        // Remove any non-numeric characters except for dot (.)
        value = value.replace(/[^0-9]/g, '');
        
        // Format the number with a thousands separator
        let formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        
        // Update the input field with the formatted value
        $(selector).val(formattedValue);
    }

    $(document).on('keyup', '.currency', function(){
        formattedcurrency(this);
    });

    $(".currency").each(function(){
        formattedcurrency(this);
    });
</script>



<script>

    function formatted(selector)
    {
        let value = $(selector).val();
        
        // Remove any non-numeric characters
        value = value.replace(/[^0-9]/g, '');
        
        // Format the number with a thousands separator
        let formattedValue = value.replace(/\B(?=(\d{4})+(?!\d))/g, '-');
        
        // Update the input field with the formatted value
        $(selector).val(formattedValue);
    }
   $('.phone').on('keyup', function(e) {
        formatted(this);
    });

    $(".phone").each(function(){
        formatted(this);
    });
</script>

<script>

    function setDefaultSelect2(target)
    {
        var data_id = target.data('data-id');

        if (data_id != null){
            var data_name = target.data('data-name');
            if (data_name.length == 0) {
                data_name = data_id;
            }
        
            var defaultOption = new Option(data_name, data_id, true, true);
            target.append(defaultOption).trigger('change');
        }
    
    }
    
    </script>
<script>
    $(document).ready(function() {

        setDefaultSelect2($(".company_id"));

        $('.company_id').select2({
            placeholder: 'Search Company',
            ajax: {
                url: '{{ route("companies.select2") }}', // Server endpoint
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        query: params.term, // Search query
                        page: params.page || 1 // Pagination
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: $.map(data.items, function (item) {
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
            minimumInputLength: 0// Start search after typing 1 character
        });



    });
</script>



<script>
    $(document).ready(function() {
        setDefaultSelect2($(".department_id"));

        $('.department_id').select2({
            placeholder: 'Search Department',
            ajax: {
                url: '{{ route("employee-departments.select2") }}', // Server endpoint
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        company_id: $("[name='company_id']").val(),
                        query: params.term, // Search query
                        page: params.page || 1 // Pagination
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: $.map(data.items, function (item) {
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
            minimumInputLength: 0// Start search after typing 1 character
        });


  
    });
</script>


<script>
    $(document).ready(function() {
        setDefaultSelect2($(".employee_position_id"));
        
        $('.employee_position_id').select2({
            placeholder: 'Search Position',
            ajax: {
                url: '{{ route("employee-positions.select2") }}', // Server endpoint
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        department_id: $(".department_id").val(),
                        query: params.term, // Search query
                        page: params.page || 1 // Pagination
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: $.map(data.items, function (item) {
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
            minimumInputLength: 0// Start search after typing 1 character
        });


      
    });
</script>


<script>
    $(document).ready(function() {
        $('.company_id').select2({
            placeholder: 'Search Company',
            ajax: {
                url: '{{ route("companies.select2") }}', // Server endpoint
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        query: params.term, // Search query
                        page: params.page || 1 // Pagination
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: $.map(data.items, function (item) {
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
            minimumInputLength: 0// Start search after typing 1 character
        });
    });
</script>

<script>
    $(document).ready(function() {

        setDefaultSelect2($(".manager_id"));


        $('.manager_id').select2({
            placeholder: 'Search Manager',
            ajax: {
                url: '{{ route("employees.select2") }}', // Server endpoint
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        company_id: $("[name='company_id']").val(),
                        query: params.term, // Search query
                        page: params.page || 1 // Pagination
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: $.map(data.items, function (item) {
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
            minimumInputLength: 0// Start search after typing 1 character
        });

        
    });
</script>


<script>
    $(document).ready(function() {

        setDefaultSelect2($(".employee_id"));
        
        $('.employee_id').select2({
            placeholder: 'Search Employee',
            ajax: {
                url: '{{ route("employees.select2") }}', // Server endpoint
                dataType: 'json',
                delay: 250,
                data: function (params) {

                    return {
                        company_id: $("[name='company_id']").val(),
                        query: params.term, // Search query
                        page: params.page || 1 // Pagination
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: $.map(data.items, function (item) {
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
            minimumInputLength: 0// Start search after typing 1 character
        });

       
    });
</script>


@if (strpos( Route::currentRouteName(), "reimbursement-requests.") === 0)
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
        let option = new Option(employee_name,form_data.employee_id, true, true);
        $("[name='employee_id']").append(option).trigger('change');
    }

    if (expenses_data.length > 0) {
        $.each(expenses_data, function (key, value){
            add_expense(value);
        });
    }


    state_empty();

    function state_empty()
    {
        if ($(".expense_div .form").html().trim().length == 0) {
            $(".expense_div .empty").show();
        } else {
            $(".expense_div .empty").hide();
        }

    }

 
    $("#add_expense").on('click', function(){
        add_expense(null);
    });

    function add_expense( value)
    {
        row_expense++;

     
        var insert = `<div class="row row-expense">
            <x-form.select add_class="expense-type-`+row_expense+`" class="col-12 col-lg-6" label="Type" name="expenses[`+row_expense+`][type]" :list="\App\Models\ReimbursementExpense::pluck('name','id')" />
           <x-form.currency class="col-12 col-lg-5" add_class="expense-amount-`+row_expense+`" :label="__('Amount')" name="expenses[`+row_expense+`][amount]" value="" />
            <div class="col-12 col-lg-1">
            <button type="button" class="btn btn-danger w-100 btn-delete-expense" >X</button>

            </div>
        </div>`;
        $(".expense_div .form").append(insert);


        $(".expense-type-" + row_expense).select2();


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




    $(document).on('click','.btn-delete-expense', function(){
        Swal.fire({
            title: '{{ __("Are you sure?") }}',
            text: '{{ __("Are you sure want to delete?") }}',
            icon: 'warning',
            showCancelButton: true,
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-danger"
            },
            confirmButtonText: '{{ __("Yes, Delete it!") }}',
            cancelButtonText: '{{ __("Cancel") }}'
        }).then((result) => {

            if (result.isConfirmed == true) {
                $(this).parent('div').parent('.row-expense').remove(); 
                state_empty();
            }
  

        });
    });
</script>
@endif



@if (strpos( Route::currentRouteName(), "employee-payslips") === 0)
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
        let option = new Option(employee_name,form_data.employee_id, true, true);
        $("[name='employee_id']").append(option).trigger('change');
    }

    if (deduction_details_data.length > 0) {
        $.each(deduction_details_data, function (key, value){
            add_deduction(value);
        });
    }


    if (earning_details_data.length > 0) {
        $.each(earning_details_data, function (key, value){
            add_earning(value);
        });
    }


    state_empty();

    function state_empty()
    {
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

 
    $("#add_deduction").on('click', function(){
        add_deduction(null);
    });

    function add_deduction( value)
    {
        row_deduction++;

     
        var insert = `<div class="row row-payslip">
            <x-form.select add_class="deduction-type-`+row_deduction+`" class="col-12 col-lg-3" label="Type" name="deduction[`+row_deduction+`][type]" :list="\App\Models\EmployeePayslipMaster::type_dropdown()" />
            <x-form.select  add_class="deduction-master-`+row_deduction+`"  label="Deduction Type" :list="\App\Models\EmployeePayslipMaster::masterTypeDeduction()->orderBy('name')->pluck('name','id')" class="col-12 col-lg-5" name="deduction[`+row_deduction+`][master_id]" value="`+master_id+`"/>
            <x-form.currency class="col-12 col-lg-3" add_class="deduction-amount-`+row_deduction+`" :label="__('Amount')" name="deduction[`+row_deduction+`][amount]" value="" />
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
            master_id = value.employee_payslip_master_earning_id;
            amount = value.value;
           
            var amount_input = $(".deduction-amount-" + row_deduction);
            amount_input.val(amount);
            formattedcurrency(amount_input);
            $(".deduction-type-" + row_deduction).val(type).trigger('change');
            $(".deduction-master-" + row_deduction).val(master_id).trigger('change');
        }

        state_empty();
    }



    $("#add_earning").on('click', function(){
      
        add_earning(null);
    });

    function add_earning(value)
    {
        row_earning++;

        var insert = `<div class="row row-payslip">
            <x-form.select add_class="earning-type-`+row_earning+`" class="col-12 col-lg-3" label="Type" name="earning[`+row_earning+`][type]" :list="\App\Models\EmployeePayslipMaster::type_dropdown()" />
            <x-form.select  add_class="earning-master-`+row_earning+`"  label="Earning Type" :list="\App\Models\EmployeePayslipMaster::masterTypeEarning()->orderBy('name')->pluck('name','id')" class="col-12 col-lg-5" name="earning[`+row_earning+`][master_id]" value="`+master_id+`"/>
            <x-form.currency class="col-12 col-lg-3" add_class="earning-amount-`+row_earning+`" :label="__('Amount')" name="earning[`+row_earning+`][amount]" value="" />
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
            master_id = value.employee_payslip_master_earning_id;
            amount = value.value;
           
            var amount_input = $(".earning-amount-" + row_earning);
            amount_input.val(amount);
            formattedcurrency(amount_input);
            $(".earning-type-" + row_earning).val(type).trigger('change');
            $(".earning-master-" + row_earning).val(master_id).trigger('change');
        }

        state_empty();
    }

    $(document).on('click','.btn-delete-payslip-detail', function(){
        Swal.fire({
            title: '{{ __("Are you sure?") }}',
            text: '{{ __("Are you sure want to delete?") }}',
            icon: 'warning',
            showCancelButton: true,
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-danger"
            },
            confirmButtonText: '{{ __("Yes, Delete it!") }}',
            cancelButtonText: '{{ __("Cancel") }}'
        }).then((result) => {

            if (result.isConfirmed == true) {
                $(this).parent('div').parent('.row-payslip').remove(); 
                state_empty();
            }
  

        });
    });
</script>
@endif


@if (in_array(Route::currentRouteName(), ['employees.create','employees.edit']))
<script>
    $(document).ready(function() {
        let typingTimer;                  // Timer identifier
        let typingDelay = 500;            // Delay in milliseconds (500 ms = 0.5 sec)

        $('[name="username"]').on('keyup', function() {
            clearTimeout(typingTimer);    // Clear the previous timer
            let username = $(this).val();
            
            typingTimer = setTimeout(function() {
                $.post('{{ route("employees.check-username") }}', { 
                    _token: "{{ csrf_token() }}",
                    username: username,
                    employee_id: $("#employee_id").val(),
                }, function(response) {
                    console.log(response);
                    if (response.success == true) {
                        $('.username-error').text(response.message).css('color', 'green');
                    } else {
                        $('.username-error').text(response.message).css('color', 'red');
                    }
                }, 'json');
            }, typingDelay); // Trigger the post request after the delay
        
        });


        $('[name="document_is_unlimited"]').trigger('change');

        $('[name="document_is_unlimited"]').on('change', function(){
            var val = $(this).is(':checked');
   
            if (val == true) {
                $('#document_expiry_div').hide();
            } else {
                $('#document_expiry_div').show();
            }
        });
    });
</script>

@endif

<script>
    // Get the input element
    const input = $('.file_picker');

    // Add a click event listener
    input.on('click', function() {
        console.log('asdasd');
        $($(this).data('modal')).modal('show');

        $($(this).data('picker-upload')).attr('disabled', 'disabled');

    });

    // input file change
    $(".input_file").on('change', function(){
        var picker_upload = $(this).data('picker-upload');
        var file = $(this)[0].files[0]; // Get the first file
        console.log(file);
        if (file) {
            var reader = new FileReader();

            reader.onload = function(e) {
                console.log(file);
                $(picker_upload).removeAttr('disabled');


            }

            reader.readAsDataURL(file); // Read the file as a data URL
        }
    });


    $(".picker-upload").on('click', function() {
        var fileInput =  $($(this).data('input-file'))[0];
        var file = fileInput.files[0];

        if (file) {

            var formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('file', file);
            formData.append('folder', $(this).data('folder'));

            var upload_progress = $($(this).data("upload-progress"));
            var input_text = $($(this).data("input-text"));
            var modal = $(this).data('modal');
            
            $.ajax({
                url: "{{ route('upload') }}", // Your server-side upload URL
                type: 'POST',
                data: formData,
                processData: false, // Prevent jQuery from converting the data into a query string
                contentType: false, // Prevent jQuery from setting a default content-type
                success: function(response) {
                    // alert('Image uploaded successfully!');
                    console.log(response);

                    if (response.file != null) {
                 
                       
                        $(modal).modal('hide');

                        input_text.val(response.file);
                    }
                },
                error: function(response) {
                    alert('Failed to upload the image.');
                    // upload_progrss.html("");
                    console.log(response);
                },
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();

                    // Upload progress
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total) * 100;
                            console.log("Upload progress: " + percentComplete + "%");
                            // You can update a progress bar here
                            upload_progress.html("Upload progress: " + percentComplete +
                                "%");
                        }
                    }, false);
                    return xhr;
                },
            });
        }
    });
</script>


<script>
$(document).ready(function() {
  $('.summernote').summernote({
    height: 300, // set editor height
    minHeight: null, // set minimum height of editor
    maxHeight: null, // set maximum height of editor
    focus: true // set focus to editable area after initializing summernote
});
});
</script>