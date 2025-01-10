@extends('layouts.layout')

@section('content')
<body>
    <div class="container py-5">
        {{-- @if(session('error'))
            <div id="error-alert" class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif --}}
        <div class="d-flex justify-content-between align-items-center mb-4 my-5">
            <h1 class="text-center mb-4">List of Bookmarks</h1>
        </div>
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('bookmark.create') }}" class="btn btn-dark">Add Bookmark</a>
            </div>
            <div class="d-flex">
                <input type="text" id="search" name="search" class="form-control me-2"
                    placeholder="Enter category">
            </div>
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
                        <td>{{ $bookmark->category->name }}</td>
                        <td>
                            <a href="{{ route('bookmark.edit', $bookmark->id) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <a href="#" onclick="confirmDelete({{ $bookmark->id }})"
                                class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation">
            {{ $bookmarks->links('pagination::bootstrap-4') }}
        </nav>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const deleteUrl = "{{ route('bookmark.delete', ':id') }}";

        function confirmDelete(bookmarkId) {
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
                    const url = deleteUrl.replace(':id', bookmarkId);
                    window.location.href = url;
                }
            });
        }
        $(document).ready(function() {
            $('#search').on('change', function(e) {
                var category = $('#search').val();
                $.ajax({
                    url: "{{ route('bookmark.list') }}/" + category,
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
                data.forEach(function(bookmark) {
                    var row = `<tr>
                    <td>${bookmark.title}</td>
                    <td><a href="${bookmark.url}" target="_blank">${bookmark.url}</a></td>
                    <td>${bookmark.category.name}</td>
                    <td>
                        <a href="/bookmark/edit/${bookmark.id}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="#" onclick="confirmDelete(${bookmark.id})" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>`;
                    tbody.append(row);
                });
            }
        });
    </script>
</body>
@endsection
