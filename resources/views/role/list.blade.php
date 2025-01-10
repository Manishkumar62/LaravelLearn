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
                            <button class="btn btn-danger btn-sm remove-user-btn" data-role-id="{{ $role->id }}" data-role-name="{{ $role->name }}" data-role-users="{{ json_encode($role->users->pluck('id', 'name')) }}">
                                Remove User
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation">
            {{ $roles->links('pagination::bootstrap-4') }}
        </nav>
    </div>

    <div class="modal fade" id="removeUserModal" tabindex="-1" aria-labelledby="removeUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="removeUserModalLabel">Remove User from <span id="role-name"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="removeUserForm" action="{{ route('role.remove') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="role_id" id="role-id">
                        <div class="form-group">
                            <label for="user-select">Select User</label>
                            <select name="user_id" id="user-select" class="form-control">
                                <!-- User options will be dynamically populated -->
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Remove User</button>
                    </div>
                </form>
            </div>
        </div>
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
            $('.remove-user-btn').on('click', function () {
        const roleId = $(this).data('role-id');
        const roleName = $(this).data('role-name');
        const roleUsers = $(this).data('role-users');

        // Populate the modal fields
        $('#role-id').val(roleId);
        $('#role-name').text(roleName);

        // Populate the user dropdown
        const userSelect = $('#user-select');
        userSelect.empty();
        for (const [name, id] of Object.entries(roleUsers)) {
            userSelect.append(new Option(name, id));
        }

        // Show the modal
        const removeUserModal = new bootstrap.Modal(document.getElementById('removeUserModal'));
        removeUserModal.show();
    });
        });
    </script>
</body>

@endsection
