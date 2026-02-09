<div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bolder">{{ __('Import Employee') }}</h2>
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
                <form id="importForm" class="form" action="{{ route('employees.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- If company_id is present in the request (filtered), use it. -->
                    <input type="hidden" name="company_id" value="{{ request()->filter['company_id'] ?? auth()->user()->company_id ?? '' }}">
                    
                    <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                        <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
                                <rect x="11" y="14" width="2" height="7" rx="1" fill="black" />
                                <rect x="11" y="17" width="2" height="2" rx="1" fill="black" />
                            </svg>
                        </span>
                        <div class="d-flex flex-stack flex-grow-1">
                            <div class="fw-bold">
                                <h4 class="text-gray-900 fw-bolder">{{ __('Instructions') }}</h4>
                                <div class="fs-6 text-gray-700">
                                    <ol>
                                        <li>{{ __('Download the template by clicking the button below.') }}</li>
                                        <li>{{ __('Fill the excel file starting from Row 4.') }}</li>
                                        <li>{{ __('Ensure Username, Email, and NIK are unique.') }}</li>
                                        <li>{{ __('Do not modify the headers in Row 1, 2, and 3.') }}</li>
                                        <li>{{ __('For columns with dropdowns (Context: Gender, Religion, Department, Position, Level, Shift), pleace checks the comment or select from valid options.') }}</li>
                                        <li>{{ __('Upload the filled excel file.') }}</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="">{{ __('Step 1: Download Template') }}</span>
                        </label>
                         @php
                            $companyId = request()->filter['company_id'] ?? auth()->user()->company_id ?? null;
                        @endphp
                        <a href="{{ route('employees.import-template', ['company_id' => $companyId]) }}" class="btn btn-light-primary w-100">
                            <i class="fas fa-download me-2"></i> {{ __('Download Excel Template') }}
                        </a>
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="required fs-6 fw-bold mb-2">{{ __('Step 2: Upload File') }}</label>
                        <input type="file" name="file" class="form-control form-control-solid" accept=".xlsx, .xls" required />
                    </div>

                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary">
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
