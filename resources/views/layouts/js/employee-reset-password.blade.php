<script>
    $(".employee-reset-password").on('click', function() {

        Swal.fire({
            title: '{{ __('Are you sure?') }}',
            text: '{{ __('Are you sure want to send password, to employee?') }}',
            icon: 'warning',
            showCancelButton: true,
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-danger"
            },
            confirmButtonText: '{{ __('Yes, reset it!') }}',
            cancelButtonText: '{{ __('Cancel') }}'
        }).then((result) => {
            var email = $(this).data('email');
            var reset_password_url = $(this).data('reset-password-url');
            if (email.length == 0) {
                Swal.fire({
                    title: '{{ __('Email required') }}',
                    text: '{{ __('Email required') }}',
                    icon: 'error'
                })
                return;
            }



            $.ajax({
                url: reset_password_url,
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    '_method': 'PUT',
                }, // Serialize the form data
                success: function(response) {
                    console.log(response);
                    // Handle the success response
                    // alert('Item deleted successfully!');
                    // Optionally, redirect or update the page

                    if (response.success == true) {
                        Swal.fire({
                            title: '{{ __('Success!') }}',
                            text: response.message,
                            icon: 'success'
                        }).then((result2) => {
                            // alert(result2);
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: '{{ __('Error!') }}',
                            text: response.message,
                            icon: 'error'
                        })
                    }
                    // window.location.reload();
                },
                error: function(xhr) {
                    // Handle the error response
                    Swal.fire({
                        title: '{{ __('Error!') }}',
                        text: 'Error',
                        icon: 'error'
                    })
                }
            });

        });
    });
</script>