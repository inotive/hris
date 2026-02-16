<!-- Import Js Files -->
<script>
    var hostUrl = "assets/";
</script>

<script src="{{ asset('template/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('template/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('template/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('template/js/custom/widgets.js') }}"></script>
<script src="{{ asset('assets/js/pace.min.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>




@include('layouts.js.form')
@include('layouts.js.employee-reset-password')
@include('layouts.js.delete-button')

<script>
    $('#role').on('change', function() {
       roleCheckCompanyHide();
    });

    function roleCheckCompanyHide() 
    {
        var val = $('#role').val();

        console.log(val);

        if (val == "admin" || val == "finance" || val == "content") {
            $("#company_id_form_user").show();
        } else {
            $("#company_id_form_user").hide();
        }
    }
    roleCheckCompanyHide();
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
        maxYear: parseInt(moment().format("YYYY"), 12),
        locale: {
            format: "DD/MM/Y"
        },
    });


    $(".table-daterangepicker").daterangepicker({
        singleDatePicker: false,
        showDropdowns: true,
        autoUpdateInput: false,
        minYear: 1901,
        maxYear: parseInt(moment().format("YYYY"), 12),
        locale: {
            format: "DD/MM/YYYY",
            cancelLabel: 'Clear',
            applyLabel: 'Apply',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Date Filter',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
        },
        opens: 'right',
        drops: 'down',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-primary',
        cancelClass: 'btn-secondary',
        alwaysShowCalendars: false,
        showCustomRangeLabel: true
    });

    // Clear the date range when clicking the clear button
    $('.table-daterangepicker').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        $(this).trigger('change');
    });

    $(".table-daterangepicker").on('apply.daterangepicker', function(ev, picker) {
        // Access selected start and end dates
        var startDate = picker.startDate.format('DD/MM/YYYY');
        var endDate = picker.endDate.format('DD/MM/YYYY');

        // Your custom function
        console.log("Selected date range:", startDate, "to", endDate);

        $(".table-daterangepicker").val(startDate + ' - ' + endDate);

        $("form").submit();
    });


    $(".datetimepickerinput").daterangepicker({
        singleDatePicker: true,
        timePicker: true,
        timePicker24Hour: true,
        timePickerSeconds: true,
        showDropdowns: true,
        minYear: 1901,
        maxYear: parseInt(moment().format("YYYY"), 12),
        locale: {
            format: "Y-MM-DD HH:mm:ss"
        }
    });
</script>


<script>
    // currency
    function formattedcurrency(selector) {
        let value = $(selector).val();

        // Remove any non-numeric characters except for dot (.)
        value = value.replace(/[^0-9]/g, '');

        // Format the number with a thousands separator
        let formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

        // Update the input field with the formatted value
        $(selector).val(formattedValue);
    }

    $(document).on('keyup', '.currency', function() {
        formattedcurrency(this);
    });

    $(".currency").each(function() {
        formattedcurrency(this);
    });
</script>



<script>
    function formatted(selector) {
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

    $(".phone").each(function() {
        formatted(this);
    });

</script>

<script>
    function setDefaultSelect2(target) {
        var data_id = target.data('data-id');

        if (data_id != null) {
            var data_name = target.data('data-name');
            if (!data_name || data_name.length == 0) {
                data_name = data_id;
            }

            var defaultOption = new Option(data_name, data_id, true, true);
            target.append(defaultOption).trigger('change');
        }

    }
</script>



@include('layouts.js.department-dropdown')
@include('layouts.js.employee-position-dropdown')
@include('layouts.js.company-dropdown')
@include('layouts.js.manager-dropdown')
@include('layouts.js.employee-dropdown')
@include('layouts.js.leave-type-dropdown')
@include('layouts.js.shift-type-dropdown')


@include('layouts.js.reimbursement-request')

@include('layouts.js.employee-payslip')
@include('layouts.js.employee')
@include('layouts.js.employee-shift-dropdown')
@include('layouts.js.employee-payslip-generate')
@include('layouts.js.payslip-js')

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
    $(".input_file").on('change', function() {
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
        var fileInput = $($(this).data('input-file'))[0];
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

                        // Update display field to show filename
                        var displayInput = input_text.attr('id') + '_display';
                        var filename = response.file.split('/').pop(); // Get filename from path
                        $('#' + displayInput).val(filename);
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
    function formatDecimal(input) {
        // Remove any commas and allow only numbers and dots
        let value = input.value.replace(/[^0-9.]/g, '');

        // Replace multiple dots with a single one and trim to two decimal places
        value = value.replace(/\.+/g, '.').replace(/^(\d+\.)(.*)\.$/, '$1$2');
        if (value.includes('.')) {
            let parts = value.split('.');
            if (parts[1].length > 2) {
                parts[1] = parts[1].substring(0, 2);
            }
            value = parts.join('.');
        }

        input.value = value;
    }
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

<script>
    document.getElementById('submenu-dropdown-select').addEventListener('change', function() {

        if (this.value) { // Check if a valid option is selected
            window.location.href = this.value; // Redirect to the selected URL
        }
    });
</script>

@include('layouts.js.dayoff')
@include('layouts.js.map-picker')