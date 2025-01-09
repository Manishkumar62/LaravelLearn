@extends('layouts.layout')

@section('content')
<body>
    <div class="container py-5">
        <h1 class="text-center mb-4">Update Bookmark</h1>
        <form action="{{ route('bookmark.update') }}" method="post" class="mx-auto" style="max-width: 600px;">
            @csrf
            <input type="hidden" name="id" value="{{ $data->id }}">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $data->title }}">
                @error('title')
                    <div>{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="url" class="form-label">URL</label>
                <input type="text" name="url" id="url" class="form-control" value="{{ $data->url }}">
                @error('url')
                    <div>{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select name="category_id" id="category" class="form-control">
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $data->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
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
