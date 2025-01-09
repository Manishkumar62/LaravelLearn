@extends('layouts.layout')

@section('content')


<body>
    <div class="container py-5">
        @if(session('error'))
            <div id="error-alert" class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center mb-4 my-5">
            <h1 class="text-center mb-4">List of Users</h1>
        </div>
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div class="d-flex">
                <input type="text" id="search" name="search" class="form-control me-2"
                    placeholder="Enter category">
            </div>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->roles->isNotEmpty())
                                {{ $user->roles->pluck('name')->join(', ') }}
                            @else
                                No Roles
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-primary btn-sm assign-role-btn"
                                data-user-id="{{ $user->id }}"
                                data-user-name="{{ $user->name }}">
                                Assign Role
                            </button>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation">
            {{ $users->links('pagination::bootstrap-4') }}
        </nav>
    </div>
    <div class="modal fade" id="assignRoleModal" tabindex="-1" aria-labelledby="assignRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignRoleModalLabel">Assign Role to <span id="user-name"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="assignRoleForm" action ="{{ route('assign.role') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="user_id" id="user-id">
                        <div class="form-group">
                            <label for="role">Select Role</label>
                            <select name="role_id" id="role" class="form-control">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Assign Role</button>
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
            const assignRoleButtons = document.querySelectorAll('.assign-role-btn');

            assignRoleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-user-id');
                    const userName = this.getAttribute('data-user-name');

                    // Set user ID and name in the modal
                    document.getElementById('user-id').value = userId;
                    document.getElementById('user-name').innerText = userName;

                    // Show the modal
                    const assignRoleModal = new bootstrap.Modal(document.getElementById('assignRoleModal'));
                    assignRoleModal.show();
                });
            });
        });
        const deleteUrl = "{{ route('bookmark.delete', ':id') }}";


        $(document).ready(function() {
            $('#search').on('change', function(e) {
                var category = $('#search').val();
                $.ajax({
                    url: "{{ route('user.list') }}/" + category,
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
                data.forEach(function(user) {
                    var row = `<tr>
                    <td>${user.title}</td>
                    <td>${user.name}</td>
                </tr>`;
                    tbody.append(row);
                });
            }
        });
    </script>
</body>

@endsection
