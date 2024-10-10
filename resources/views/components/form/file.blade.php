@props([
    'folder' => 'default',
    'label' => '',
    'name' => '',
    'value' => null,
])
<div class="col-12 col-lg-6 mb-4">


    <div class="form-group mb-2 mb20">
        <label for="image" class="form-label">{{ $label }}</label>


        <div class="input-group mb-3">
            <input type="text" readonly name="{{ $name }}" id="{{ $name }}"
                class="form-control form-control-solid @error($name) is-invalid @enderror"
                value="{{ old($name, $value) }}" placeholder="{{ $label }}">
            <div class="input-group-append">
                @if ($value != null)
                    {{-- <a class="btn btn-success" href="{{ Storage::url($value) }}" target="_blank">{{ __('Show') }}</a> --}}
                @endif
                <button class="btn btn-primary file_picker" 
                
                id="{{ $name }}_picker"
                data-input-file="#{{ $name }}_file"
                data-picker-upload="#{{ $name }}_picker_upload"
                data-modal="#{{ $name }}_modal"

                    type="button">{{ __('Upload') }}</button>
            </div>
        </div>


        <div class="fv-plugins-message-container invalid-feedback {{ $name }}-error">
            @error($name)
                {{ $message }}
            @enderror
        </div>



        <!-- Modal -->
        <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="{{ $name }}_modal"
            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button> --}}
                    </div>
                    <div class="modal-body">
                        <input type="file" class="input_file" 
                        
                        id="{{ $name }}_file" 
                         data-picker-upload="#{{ $name }}_picker_upload"
                         data-upload-progress="#{{ $name }}_upload_progress"
                        
                        />
                        <div id="{{ $name }}_upload_progress"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold"
                            data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="button" id="{{ $name }}_picker_upload"
                        data-input-file="#{{ $name }}_file"
                        data-modal="#{{ $name }}_modal"
                        data-folder="{{ $folder }}"
                         data-input-text="#{{ $name }}"
                            class="btn btn-primary btn-block picker-upload">{{ __('Upload') }}</button>

                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
