@extends('layouts.layout')

@section('content')

<body>
    <div class="container py-5">
        <h1 class="text-center mb-4">Update Category</h1>
        <form action="{{ route('category.update') }}" method="post" class="mx-auto" style="max-width: 600px;">
            @csrf
            <input type="hidden" name="id" value="{{ $data->id }}">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $data->name }}">
                @error('name')
                    <div>{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">Update</button>
        </form>
    </div>
    <!-- Add Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

@endsection
