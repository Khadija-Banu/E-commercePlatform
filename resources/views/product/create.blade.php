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
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Category Dropdown -->
            <div class="form-group mb-3">
                <label for="category" class="form-label">Category</label>
                <select id="category" name="category_id" class="form-select">
                    <option value="" selected disabled>Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Subcategory Dropdown -->
            <div class="form-group mb-3">
                <label for="subcategory" class="form-label">Subcategory</label>
                <select id="subcategory" name="subcategory_id" class="form-select">
                    <option value="" selected disabled>Select Subcategory</option>
                    @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Product Name -->
            <div class="form-group mb-3">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" name="product_name" id="product_name" class="form-control" required>
            </div>

            <!-- Product Description -->
            <div class="form-group mb-3">
                <label for="description" class="form-label">Product Description</label>
                <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
            </div>

            <!-- Product Image -->
            <div class="form-group mb-3">
                <label class="form-label required" for="product_image">Product Image</label>
                <div class="dropzone border border-2 rounded" style="min-height: 210px" id="document-dropzone"></div>
            </div>

            <!-- Old Price -->
            <div class="form-group mb-3">
                <label for="old_price" class="form-label">Old Price</label>
                <input type="text" name="old_price" id="old_price" class="form-control">
            </div>

            <!-- New Price -->
            <div class="form-group mb-3">
                <label for="new_price" class="form-label">New Price</label>
                <input type="text" name="new_price" id="new_price" class="form-control" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>


    <!-- Include Dropzone JS -->
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>



    <script>
        Dropzone.options.documentDropzone = {
            url: '{{ route('products.storeMedia') }}', // Correct upload URL
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
                    $('form').find('input[name="product_image"]').remove();
                    this.options.maxFiles += 1; // Allow new file upload after one is removed
                }
            },
            success: function(file, response) {
                // Remove any previous input field for category_image
                $('form').find('input[name="product_image"]').remove();
                // Append a new hidden input with the uploaded image URL
                $('form').append('<input type="hidden" name="product_image" value="' + response.url + '">');
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
