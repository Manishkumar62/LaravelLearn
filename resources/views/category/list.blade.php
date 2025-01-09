@extends('layouts.layout')

@section('content')

<body>
    <div class="container py-5">
        @if(session('error'))
            <div id="error-alert" class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <h1 class="text-center mb-4">List of Category</h1>
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('category.create') }}" class="btn btn-dark">Add Category</a>
                {{-- <a href="{{ route('bookmark.list') }}" class="btn btn-dark">Bookmark List</a> --}}
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
        // Wait for the document to load
        document.addEventListener('DOMContentLoaded', function() {
            // Check if the error alert exists
            const errorAlert = document.getElementById('error-alert');
            if (errorAlert) {
                // Hide the alert after 2 seconds (2000 milliseconds)
                setTimeout(function() {
                    errorAlert.style.display = 'none';
                }, 2000);
            }
        });
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

@endsection
