<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="table my-5">
            <a href="{{ route('book.create') }}" class="btn btn-primary">Create Book</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Publisher</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">Description</th>
                        <th scope="col">Interest</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Image</th>
                        <th scope="col">Code</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">

                    @foreach ($books as $book)
                        <tr>
                            <th>{{ $book->id }}</th>
                            <td>{{ $book->book_name }}</td>
                            <td>{{ $book->publisher }}</td>
                            <td>{{ $book->isbn }}</td>
                            <td>{{ $book->desc }}</td>
                            <td>{{ $book->interest }}</td>
                            <td>{{ $book->stock }}</td>
                            <td>{{ $book->image }}</td>
                            <td>{!! DNS2D::getBarcodeHTML("$book->book_code", 'QRCODE') !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
