<div>
    <div class="form-group mb-2 mb20">
        <label for="image" class="form-label">{{ $label }}</label>
    


            <img id="{{ $name }}_preview" src="{{ old($name, $value ?? '') }}" height="100" class="mt-2 mb-2 border" />


        <div class="input-group mb-3">
            <input type="text" readonly name="{{ $name }}" id="{{ $name }}" 
                class="form-control form-control-solid @error($name) is-invalid @enderror" value="{{ old($name, $value) }}"
                placeholder="{{ $label }}">
            <div class="input-group-append">
                <button class="btn btn-primary" id="{{ $name }}_picker" type="button">{{ __('Choose File') }}</button>
            </div>
        </div>
    
    
        {!! $errors->first($name, '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    
        <!-- Modal -->
        <div class="modal fade" id="{{ $name }}_modal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="{{ $name }}_file_preview" src="" width="100%" class="border mb-2">
                        <input type="file" id="{{ $name }}_file" accept=".jpg,.png" />
                        <div>File .jpg, .png</div>
                        <div id="{{ $name }}_upload_progress"></div>
                    </div>
                    <div class="modal-footer">
    
                        <button type="button" id="{{ $name }}_picker_upload" class="btn btn-primary btn-block">Unggah</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @section('js')
    <script>
        // Get the input element
        const input = document.getElementById('{{ $name }}_picker');
        const inputFile = document.getElementById('{{ $name }}_file');
        const pickerUpload = document.getElementById('{{ $name }}_picker_upload');
        const imagePreview = $("#{{ $name }}_preview");

        imagePreview.hide();

        var modal = $('#{{ $name }}_modal');
    
        // Add a click event listener
        input.addEventListener('click', function() {
            modal.modal('show');
        });
    
        // input file change
        inputFile.addEventListener('change', function(event) {
            var file = event.target.files[0]; // Get the first file
            console.log(file);
            if (file) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    $('#{{ $name }}_file_preview').attr('src', e.target.result).show(); // Set the image source and display it
                }
                
                reader.readAsDataURL(file); // Read the file as a data URL
            }
        });
    
        pickerUpload.addEventListener('click', function() {
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
                            imagePreview.attr('src',response.url).show();
    
    
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