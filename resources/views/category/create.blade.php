<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


     <!-- Include Dropzone CSS -->
 <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />



</head>
<body>

    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header">
                Create Category
            </div>

            <div class="card-body">

                {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}

                <form method="POST" action=" {{ route('categories.store') }} " enctype="multipart/form-data">
                    @csrf


                    <div class="mt-3">
                        <label class="form-label" for="category_name">Category Name</label>
                        <input class="form-control {{ $errors->has('category_name') ? 'is-invalid' : '' }}" type="text"
                            name="category_name" id="category_name" value="{{ old('category_name', '') }}" required>
                        </select>
                        @if ($errors->has('category_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('category_name') }}
                            </div>
                        @endif
                    </div>

                    <div class="mt-3">
                        <label class="form-label required" for="category_image">Category Image</label>
                        <div class="dropzone" style="min-height: 210px" id="document-dropzone"></div>

                    </div>



                    <div class="mt-3">
                        <button class="btn btn-success" type="submit">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


 <!-- Include Dropzone JS -->
 <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>



<script>
    Dropzone.options.documentDropzone = {
        url: '{{ route('categories.storeMedia') }}',  // Correct upload URL
        maxFilesize: 2,  // Maximum file size in MB
        acceptedFiles: '.jpeg,.jpg,.png,.gif',  // Allowed file types
        maxFiles: 1,  // Allow only one file
        addRemoveLinks: true,  // Add remove links for uploaded files
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"  // CSRF token for security
        },
        removedfile: function(file) {
            file.previewElement.remove();
            if (file.status !== 'error') {
                $('form').find('input[name="category_image"]').remove();
                this.options.maxFiles += 1;  // Allow new file upload after one is removed
            }
        },
        success: function(file, response) {
            // Remove any previous input field for category_image
            $('form').find('input[name="category_image"]').remove();
            // Append a new hidden input with the uploaded image URL
            $('form').append('<input type="hidden" name="category_image" value="' + response.url + '">');
        },
        error: function(file, response) {
            let message;
            if (typeof response === 'string') {
                message = response;  // Dropzone error message as string
            } else {
                message = response.errors?.file || 'An error occurred during the upload';  // Custom error handling
            }
            file.previewElement.classList.add('dz-error');
            let errorNodes = file.previewElement.querySelectorAll('[data-dz-errormessage]');
            errorNodes.forEach(function(node) {
                node.textContent = message;
            });
        }
    };
</script>


</body>
</html>
