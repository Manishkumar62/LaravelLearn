<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bookmark List</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <h1 class="text-center mb-4">List of Bookmarks</h1>
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <a href="{{ route('bookmark.create') }}" class="btn btn-dark">Add Bookmark</a>
            <form action="{{ route('bookmark.search') }}" method="get" class="d-flex">
                @csrf
                <input type="text" id="search" name="search" class="form-control me-2" placeholder="Enter category">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>URL</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookmarks as $bookmark)
                    <tr>
                        <td>{{ $bookmark->title }}</td>
                        <td><a href="{{ $bookmark->url }}" target="_blank">{{ $bookmark->url }}</a></td>
                        <td>{{ $bookmark->category }}</td>
                        <td>
                            <a href="{{ route('bookmark.edit', $bookmark->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('bookmark.delete', $bookmark->id) }}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Add Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
