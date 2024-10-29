@if (in_array(Route::currentRouteName(), ['employees.create', 'employees.edit']))
    <script>
        $(document).ready(function() {
            let typingTimer; // Timer identifier
            let typingDelay = 500; // Delay in milliseconds (500 ms = 0.5 sec)

            $('[name="username"]').on('keyup', function() {
                clearTimeout(typingTimer); // Clear the previous timer
                let username = $(this).val();

                typingTimer = setTimeout(function() {
                    $.post('{{ route('employees.check-username') }}', {
                        _token: "{{ csrf_token() }}",
                        username: username,
                        employee_id: $("#employee_id").val(),
                    }, function(response) {
                        console.log(response);
                        if (response.success == true) {
                            $('.username-error').text(response.message).css('color',
                                'green');
                        } else {
                            $('.username-error').text(response.message).css('color', 'red');
                        }
                    }, 'json');
                }, typingDelay); // Trigger the post request after the delay

            });


            $('[name="document_is_unlimited"]').trigger('change');

            $('[name="document_is_unlimited"]').on('change', function() {
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
