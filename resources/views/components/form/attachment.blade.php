@props([
    'class' => 'col-12 col-lg-6 mb-4',
    'label' => '',
    'name' => '',
    'folder' => '',
    'files' => [],
])
<div class="{{ $class }}">


    <div class="form-group mb-2">
        <label for="image" class="form-label">{{ $label }}</label>


        <input class="form-control" type="file" id="{{ $name }}_file" multiple>
    
        <div id="{{ $name }}_preview_div">
            
        </div>
    
        <div class="fv-plugins-message-container invalid-feedback {{ $name }}-error">
            @error($name)
                {{ $message }}
            @enderror
        </div>
    

       
    </div>
    
    @section('js')
    <script>

        var files = {!! json_encode($files) !!};

        // Get the input element
        const inputFile = document.getElementById('{{ $name }}_file');
        const inputPreview = document.getElementById('{{ $name }}_preview_div');
      
    
        // input file change
        inputFile.addEventListener('change', function(event) {

            console.log(event.target.files.length);


            for(var i = 0; i < event.target.files.length; i++) {
                var file = event.target.files[i]; // Get the first file
                console.log(file);
                if (file) {
                    var reader = new FileReader();
                    
                    reader.onload = function(e) {
                        uploadFile(file); 
                    
                    }
                    
                    reader.readAsDataURL(file); // Read the file as a data URL
                }
            }
        });
    
        function uploadFile(file)
        {
    
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
                            // $("#{{ $name }}").val(response.file);
                            // imagePreview.attr('src',response.url)
                            // imagePreviewDiv.show();
    
    
                            // modal.modal('hide');

                       
                            files.push({
                                'file': response.file,
                                'url': response.url,
                                'file_id': null,
                            });

                            showFiles();
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
                            upload_progress.html("Upload progress: " + percentComplete + "%");
                        }
                        }, false);
                        return xhr;
                    },
                });
            }
        }

        function showFiles()
        {
            inputPreview.innerHTML = "";

            var html = '';

            console.log("file : " + files.length);

            for(var i = 0; i < files.length; i++) {
                var row = files[i];
                // console.log(row);
                var newFile = `<div class="alert alert-primary mt-3" role="alert">'
                    <input type="hidden" name="{{ $name }}[]" value='`+JSON.stringify(row)+`'>
                        <div class="row">
                            <div class="col-10"><a href="`+row.url+`" target="_blank">`+row.file+`</a></div>
                            <div class="col-2 text-end">
                                <button type="button" class="btn btn-primary btn-sm delete-file" data-delete-index="`+i+`">Hapus</button>
                            </div>
                        </div>
                    </div>`;

                    // console.log(newFile);

                    html += newFile;

            }



            inputPreview.innerHTML = html;

        }

        $(document).on('click', '.delete-file', function(){
            var idx = $(this).data('delete-index');

            const newArray = files.slice(0, idx).concat(files.slice(idx + 1));

            files = newArray;

            showFiles();
        });
        showFiles();
    </script>
    @endsection
    
</div>