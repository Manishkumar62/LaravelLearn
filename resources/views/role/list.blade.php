@extends('layouts.layout')

@section('content')

<body>
    <div class="container py-5">
        @if(session('error'))
            <div id="error-alert" class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <h1 class="text-center mb-4">List of Role</h1>
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('role.create') }}" class="btn btn-dark">Add Role</a>
            </div>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Role</th>
                    <th>Users</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>
                            @if($role->users->isNotEmpty())
                                {{ $role->users->pluck('name')->join(', ') }}
                            @else
                                No Users
                            @endif
                        </td>
                        <td>
                            {{-- <a href="{{ route('category.edit', $category->id) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <a href="#" onclick="confirmDelete({{ $category->id }})"
                                class="btn btn-danger btn-sm">Delete</a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation">
            {{ $roles->links('pagination::bootstrap-4') }}
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
    </script>
</body>

@endsection
