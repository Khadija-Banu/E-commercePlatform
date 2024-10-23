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
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header">
                Create Subcategory
            </div>

            <div class="card-body">
                <!-- Display Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Create Subcategory Form -->
                <form method="POST" action="{{ route('subcategories.store') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Select Category -->
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Parent Category</label>
                        <select name="category_id" class="form-control" required>
                            <option value=""  selected>Select a Category</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Subcategory Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Subcategory Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>

                    <!-- Subcategory Image -->

                    <div class="mb-3">
                        <label class="form-label required" for="subcategory_image">Category Image</label>
                        <div class="dropzone" style="min-height: 210px" id="document-dropzone"></div>

                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success">Save Subcategory</button>
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
            url: '{{ route('subcategories.storeMedia') }}', // Correct upload URL
            maxFilesize: 2, // Maximum file size in MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif', // Allowed file types
            maxFiles: 1, // Allow only one file
            addRemoveLinks: true, // Add remove links for uploaded files
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}" // CSRF token for security
            },
            removedfile: function(file) {
                file.previewElement.remove();
                if (file.status !== 'error') {
                    $('form').find('input[name="subcategory_image"]').remove();
                    this.options.maxFiles += 1; // Allow new file upload after one is removed
                }
            },
            success: function(file, response) {
                // Remove any previous input field for category_image
                $('form').find('input[name="subcategory_image"]').remove();
                // Append a new hidden input with the uploaded image URL
                $('form').append('<input type="hidden" name="subcategory_image" value="' + response.url + '">');
            },
            error: function(file, response) {
                let message;
                if (typeof response === 'string') {
                    message = response; // Dropzone error message as string
                } else {
                    message = response.errors?.file ||
                    'An error occurred during the upload'; // Custom error handling
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
