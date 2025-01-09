@extends('layouts.layout')

@section('content')

<body>
    <div class="container py-5">
        <h1 class="text-center mb-4">Create Role</h1>
        <form action="{{ route('role.store') }}" method="post" class="mx-auto" style="max-width: 600px;">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Role *</label>
                <input type="text" name="role" id="role" class="form-control" placeholder="Enter role" value="{{ old('role') }}">
                @error('role')
                    <div>{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">Create</button>
        </form>
    </div>
    <!-- Add Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

@endsection
