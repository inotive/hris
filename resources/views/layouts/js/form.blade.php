<script>
    $.fn.serializeWithUnchecked = function() {
        var form = this;

        // Serialize the form, including unchecked checkboxes as "unchecked"
        var formData = form.serializeArray();

        // Find unchecked checkboxes and add them to formData
        form.find('input[type=checkbox]:not(:checked)').each(function() {
            formData.push({
                name: this.name,
                value: '0'
            });
        });

        $(".datepickersingle").each(function() {
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
                    formData[index] = {
                        name: name,
                        value: formattedDate
                    }
                }
            }
        });

        $("input.currency").each(function() {
            var name = $(this).attr("name");
            var val = $(this).val();
            val = val.replace(/\./g, '');
            val = val.replace(/\,/g, '.');

            let index = formData.findIndex(d => d.name === name);
            if (index !== -1) {
                formData[index] = {
                    name: name,
                    value: val
                }
            }
        });

        return formData;
    };
    $("#crud-form").on('submit', function(event) {
        event.preventDefault();

        $(".phone").each(function() {
            // Ensure only numbers are submitted (remove all non-numeric characters)
            let value = $(this).val().replace(/[^0-9]/g, '');
            $(this).val(value);
        });

        var submitButton = $("button[type='submit']");
        submitButton.prop('disabled', true);

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
                        title: '{{ __('Error!') }}',
                        text: response.message,
                        icon: 'error',
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                    });

                    submitButton.prop('disabled', false);

                    $(".phone").each(function() {
                        formatted(this);
                    });
                }
                // window.location.reload();
            },
            error: function(xhr, status, error) {
                if (xhr.status == 403) {
                    Swal.fire({
                        title: '{{ __('Error!') }}',
                        text: '{{ __('Not Authorized') }}',
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

                        var firstKey = "";
                        // Display errors
                        $.each(errors, function(key, value) {
                            if (firstKey == "") {
                                firstKey = key;
                            }
                            $('.' + key + '-error').append('<p>' + value + '</p>');
                        });


                        // focus input
                        console.log(firstKey);
                        $('[name="' + firstKey + '"]').first().focus();

                    } else {
                        // Handle the error response
                        Swal.fire({
                            title: '{{ __('Error!') }}',
                            text: message ?? 'Error',
                            icon: 'error',
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                        });
                    }

                    $(".phone").each(function() {
                        formatted(this);
                    });
                }

                submitButton.prop('disabled', false);
            },

        });
    });


    function formatted(selector) {
        let value = $(selector).val();

        // Remove any non-numeric characters
        value = value.replace(/[^0-9]/g, '');

        // Format the number with a thousands separator
        let formattedValue = value.replace(/\B(?=(\d{4})+(?!\d))/g, '-');

        // Update the input field with the formatted value
        $(selector).val(formattedValue);
    }

   
</script>
