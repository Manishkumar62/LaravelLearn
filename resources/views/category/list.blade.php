<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bookmark List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>
    <div class="container py-5">
        <h1 class="text-center mb-4">List of Category</h1>
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('category.create') }}" class="btn btn-dark">Add Category</a>
                <a href="{{ route('bookmark.list') }}" class="btn btn-dark">Bookmark List</a>
            </div>
            <div class="d-flex">
                <input type="text" id="search" name="search" class="form-control me-2"
                    placeholder="Enter name">
            </div>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ route('category.edit', $category->id) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <a href="#" onclick="confirmDelete({{ $category->id }})"
                                class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation">
            {{ $categories->links('pagination::bootstrap-4') }}
        </nav>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const deleteUrl = "{{ route('category.delete', ':id') }}";

        function confirmDelete(categoryId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const url = deleteUrl.replace(':id', categoryId);
                    window.location.href = url;
                }
            });
        }
        $(document).ready(function() {
            $('#search').on('change', function(e) {
                var name = $('#search').val();
                $.ajax({
                    url: "{{ route('category.list') }}/" + name,
                    type: "GET",
                    success: function(response) {
                        updateTable(response.data);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
            function updateTable(data) {
                var tbody = $('table tbody');
                tbody.empty();
                data.forEach(function(category) {
                    var row = `<tr>
                    <td>${category.name}</td>
                    <td>
                        <a href="/category/edit/${category.id}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="#" onclick="confirmDelete(${category.id})" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>`;
                    tbody.append(row);
                });
            }
        });
    </script>
</body>

</html>
