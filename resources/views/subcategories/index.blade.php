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
    <h1>Subcategories</h1>
    <div class=" mb-3">

        <a href="{{ route('subcategories.create') }}" class="btn btn-primary">Create New SubCategory</a>


</div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Subcategory Name</th>
                <th>Parent Category</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subcategories as $subcategory)
                <tr>
                    <td>{{ $subcategory->name }}</td>
                    <td>{{ $subcategory->category->category_name }}</td>
                    <td>
                        @if(!empty($subcategory->subcategory_image))
                        <img src="{{asset('upload/'.$subcategory->subcategory_image)}}" alt="" style="width:10%; height:10%">
                        @endif</td>
                    <td>

                        <a href="{{ route('subcategories.edit', $subcategory->id) }}"
                            class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST"
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
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>

</html>
