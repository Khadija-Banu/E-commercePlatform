<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Product</h1>


        <div class=" mb-3">

            <a href="{{ route('products.create') }}" class="btn btn-primary">Create New Product</a>


        </div>

        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Category Name</th>
                    <th>Subcategory Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->product_name }}</td>

                        <td>
                            @if (!empty($product->product_image))
                                <img src="{{ asset('upload/' . $product->product_image) }}" alt=""
                                    style="width:50px; height:50px">
                            @endif
                        </td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->category->category_name }}</td>
                        <td>{{ $product->subcategory->name }}</td>
                        <td>New-Price: {{ $product->new_price }}</br> Old-Price: {{ $product->old_price }}</td>

                        <td>

                            <a href="{{ route('categories.edit', $product->id) }}"
                                class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('categories.destroy', $product->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- category is not available --}}
        @if ($products->isEmpty())
            <p>No category available.</p>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
