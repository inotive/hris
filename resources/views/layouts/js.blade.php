<!-- Import Js Files -->
<script>var hostUrl = "assets/";</script>

<script src="{{asset('template/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('template/js/scripts.bundle.js')}}"></script>
<script src="{{asset('template/js/widgets.bundle.js')}}"></script>
<script src="{{asset('template/js/custom/widgets.js')}}"></script>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>



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
            
            
            // // Proceed with the delete action
            // console.log('Item deleted');
            // Swal.fire(
            //     '{{ __("Deleted!") }}',
            //     '{{ __("Your item has been deleted.") }}',
            //     'success'
            // );

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
                    alert('An error occurred while deleting the item.');
                }
            });
        }
    });
});
</script>
