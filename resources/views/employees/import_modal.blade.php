<div class="modal fade" id="import_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bolder">{{ __('Import Employees') }}</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <form id="import_form" class="form" action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Steps -->
                    <div class="mb-10">
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Step 1: Download Template</span>
                            </label>
                            <div class="text-muted fs-7 mb-4">
                                Download the latest template to ensure the correct format.
                            </div>
                            <a href="{{ route('employees.download-template') }}" class="btn btn-light-primary">
                                <i class="fas fa-download me-2"></i> {{ __('Download Excel Template') }}
                            </a>
                        </div>

                        <div class="separator mb-8"></div>

                        <div class="d-flex flex-column mb-8 fv-row">
                             <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Step 2: Fill Data</span>
                            </label>
                            <div class="text-muted fs-7">
                                Fill the Excel file with employee data. 
                                <ul>
                                    <li><b>Required:</b> First/Last Name, Email, Phone, NIK, Tax Number.</li>
                                    <li><b>Relationships:</b> Department, Position, Level, Shift must match existing names.</li>
                                    <li><b>Dates:</b> Use YYYY-MM-DD format.</li>
                                </ul>
                            </div>
                        </div>

                        <div class="separator mb-8"></div>

                         <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Step 3: Upload File</span>
                            </label>
                            <input type="file" name="file" class="form-control" accept=".xlsx, .xls" required />
                        </div>

                        <!-- Error Container -->
                        <div id="import_error_container" class="alert alert-danger d-none">
                            <ul id="import_error_list" class="mb-0"></ul>
                        </div>
                    </div>

                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">{{ __('Discard') }}</button>
                        <button type="submit" id="import_submit_btn" class="btn btn-primary">
                            <span class="indicator-label">{{ __('Import') }}</span>
                            <span class="indicator-progress">{{ __('Please wait...') }} 
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        const modal = $('#import_modal');
        const form = $('#import_form');
        const submitBtn = $('#import_submit_btn');
        const errorContainer = $('#import_error_container');
        const errorList = $('#import_error_list');
        const indicatorLabel = submitBtn.find('.indicator-label');
        const indicatorProgress = submitBtn.find('.indicator-progress');

        form.on('submit', function(e) {
            e.preventDefault();
            
            // UI Reset
            submitBtn.prop('disabled', true);
            indicatorLabel.hide();
            indicatorProgress.show();
            
            errorContainer.addClass('d-none');
            errorList.empty();

            // Data
            const formData = new FormData(this);

            $.ajax({
                url: "{{ route('employees.import-check') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if(response.success) {
                        submitBtn.prop('disabled', false);
                        indicatorLabel.show();
                        indicatorProgress.hide();

                        Swal.fire({
                            text: response.message,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function (result) {
                            if (result.isConfirmed) {
                                modal.modal('hide');
                                window.location.reload(); 
                            }
                        });
                    }
                },
                error: function(xhr) {
                    submitBtn.prop('disabled', false);
                    indicatorLabel.show();
                    indicatorProgress.hide();
                    
                    errorContainer.removeClass('d-none');
                    
                    let message = 'An error occurred.';
                    if (xhr.responseJSON) {
                        if (xhr.responseJSON.errors) {
                            // Can be array of strings or object
                            const errors = xhr.responseJSON.errors;
                            if (Array.isArray(errors)) {
                                errors.forEach(err => errorList.append(`<li>${err}</li>`));
                            } else {
                                // Default Laravel validation structure
                                Object.values(errors).forEach(err => errorList.append(`<li>${err}</li>`));
                            }
                        } else {
                             message = xhr.responseJSON.message || message;
                             errorList.append(`<li>${message}</li>`);
                        }
                    } else {
                         errorList.append(`<li>${xhr.statusText}</li>`);
                    }
                }
            });
        });
    });
</script>
@endpush
