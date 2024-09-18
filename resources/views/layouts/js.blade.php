<!-- Import Js Files -->
<script>var hostUrl = "assets/";</script>

<script src="{{asset('template/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('template/js/scripts.bundle.js')}}"></script>
<script src="{{asset('template/js/widgets.bundle.js')}}"></script>
<script src="{{asset('template/js/custom/widgets.js')}}"></script>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>


<script>
    $("#crud-form").on('submit', function(event){
        event.preventDefault(); 

        var submitButton = $("button[type='submit']");
        submitButton.prop('disabled',true);

        var action = $(this).attr('action');
        $.ajax({
            url: action,
            type: 'POST',
            data: $(this).serialize(), // Serialize the form data
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
                        }, 1000); // 2000 milliseconds = 2 seconds

                     
                } else {
                    Swal.fire({
                        title:'{{ __("Error!") }}',
                        text: response.message,
                        icon: 'error'
                    });

                    submitButton.prop('disabled',false);
                }
                // window.location.reload();
            },
            error: function(xhr) {
                // Handle the error response
                Swal.fire({
                        title:'{{ __("Error!") }}',
                        text: 'Error',
                        icon: 'error'
                    });

                    submitButton.prop('disabled',false);
            }
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
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
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
                        text: 'Error',
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

    if (val == "admin") {
        $("#company_id_div").show();
    } else {
        $("#company_id_div").hide();
    }
});
$("#role").trigger('change');
</script>