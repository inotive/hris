<div class="col-12 col-lg-6 mb-4">


    <div class="form-group mb-2 mb20">
        <label for="image" class="form-label">{{ $label }}</label>
    

        <div id="{{ $name }}_preview_div">
        <img id="{{ $name }}_preview" onerror="this.onerror=null; this.src='{{ asset('assets/images/no_image.jpg') }}';" src="{{ old($name, $value ?? '') != null ? Storage::url(old($name, $value ?? '')) : '' }}" height="100" class="mt-2 mb-2 border" />
        </div>

        <div class="input-group mb-3">
            <input type="text" readonly name="{{ $name }}" id="{{ $name }}" 
                class="form-control form-control-solid @error($name) is-invalid @enderror" value="{{ old($name, $value) }}"
                placeholder="{{ $label }}">
            <div class="input-group-append">
                <button class="btn btn-primary" id="{{ $name }}_picker" type="button">{{ __('Choose File') }}</button>
            </div>
        </div>
    
    
        <div class="fv-plugins-message-container invalid-feedback {{ $name }}-error">
            @error($name)
                {{ $message }}
            @enderror
        </div>
    


        <!-- Modal -->
        <div class="modal fade" 
        data-bs-backdrop="static" 
            data-bs-keyboard="false"
        id="{{ $name }}_modal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button> --}}
                    </div>
                    <div class="modal-body">
                        <img id="{{ $name }}_file_preview" src="" width="100%" class="border mb-2">
                        <input type="file" id="{{ $name }}_file" />
                        <div id="{{ $name }}_upload_progress"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="button" id="{{ $name }}_picker_upload" class="btn btn-primary btn-block">{{ __('Upload') }}</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @section('js')
    <script>
        // Get the input element
        const input = $('#{{ $name }}_picker');
        const inputFile = document.getElementById('{{ $name }}_file');
        const pickerUpload = $('#{{ $name }}_picker_upload');
        const imagePreview = $("#{{ $name }}_preview");
        const imagePreviewDiv = $("#{{ $name }}_preview_div");

        @if (old($name, $value ?? ''))
            imagePreviewDiv.show();
        @else
            imagePreviewDiv.hide();
        @endif
        var modal = $('#{{ $name }}_modal');
    
        // Add a click event listener
        input.on('click', function() {
            console.log('asdasd');
            modal.modal('show');

            pickerUpload.attr('disabled', 'disabled');
     
        });
    
        // input file change
        inputFile.addEventListener('change', function(event) {
            var file = event.target.files[0]; // Get the first file
            console.log(file);
            if (file) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    $('#{{ $name }}_file_preview').attr('src', e.target.result).show(); // Set the image source and display it
                    pickerUpload.removeAttr('disabled');    
                 
                }
                
                reader.readAsDataURL(file); // Read the file as a data URL
            }
        });
    
        pickerUpload.on('click', function() {
            var fileInput = $("#{{ $name }}_file")[0];
            var file = fileInput.files[0];
    
            if (file) {
    
                var formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('file', file);
                formData.append('folder', '{{ $folder }}');
    
                var upload_progress = $("#{{ $name }}_upload_progress");
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
                            $("#{{ $name }}").val(response.file);
                            imagePreview.attr('src',response.url)
                            imagePreviewDiv.show();
    
    
                            modal.modal('hide');
                        }
                    },
                    error: function(response) {
                        alert('Failed to upload the image.');
                        upload_progrss.html("");
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
                            upload_progress.html("Upload progress: " + percentComplete + "%");
                        }
                        }, false);
                        return xhr;
                    },
                });
            }
        });
    </script>
    @endsection
    
</div>