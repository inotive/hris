<div class="col-12 col-lg-6 mb-4">




    <div class="form-group mb-2 mb20">
        <label for="image" class="form-label">{{ $label }}</label>
        
        <div>

<!--begin::Image input-->
<div class="image-input image-input-empty" data-kt-image-input="true" style="background-image: url({{ old($name, $value ?? '') != null ? Storage::url(old($name, $value ?? '')) : asset('template/media/svg/avatars/blank.svg') }})">
    <!--begin::Image preview wrapper-->
    <div class="image-input-wrapper w-125px h-125px"></div>
    <!--end::Image preview wrapper-->

    <!--begin::Edit button-->
    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
       data-kt-image-input-action="change"
       data-bs-toggle="tooltip"
       data-bs-dismiss="click"
       title="Change {{ $label }}">
        <i class="bi bi-pencil-fill fs-7"></i>

        <!--begin::Inputs-->
        <input type="file" id="{{ $name }}_file_picker" accept=".png, .jpg, .jpeg" />
        <input type="hidden" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}"/>
        <!--end::Inputs-->
    </label>
    <!--end::Edit button-->

    <!--begin::Cancel button-->
    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
       data-kt-image-input-action="cancel"
       data-bs-toggle="tooltip"
       data-bs-dismiss="click"
       title="Cancel {{ $label }}">
        <i class="bi bi-x fs-2"></i>
    </span>
    <!--end::Cancel button-->

    <!--begin::Remove button-->
    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
       data-kt-image-input-action="remove"
       data-bs-toggle="tooltip"
       data-bs-dismiss="click"
       title="Remove {{ $label }}">
        <i class="bi bi-x fs-2"></i>
    </span>
    <!--end::Remove button-->
</div>
<!--end::Image input-->

        </div>
    

    
        @error($name)
        <div class="fv-plugins-message-container invalid-feedback {{ $name }}-error">
       
                {{ $message }}

        </div>
        @enderror


    </div>
    
    @section('js')
    <script>
        $("#{{ $name }}_file_picker").on('change', function(){
            upload();
        });
     
        function upload()
        {
            var fileInput = $("#{{ $name }}_file_picker")[0];
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
                        // if (evt.lengthComputable) {
                        //     var percentComplete = (evt.loaded / evt.total) * 100;
                        //     console.log("Upload progress: " + percentComplete + "%");
                        //     // You can update a progress bar here
                        //     upload_progress.html("Upload progress: " + percentComplete + "%");
                        // }
                        }, false);
                        return xhr;
                    },
                });
            }
        }
    </script>
    @endsection
    
</div>