<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Bookmark</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <h1 class="text-center mb-4">Create Bookmark</h1>
        <form action="{{ route('bookmark.store') }}" method="post" class="mx-auto" style="max-width: 600px;">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title *</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Enter title" value="{{ old('title') }}">
                @error('title')
                    <div>{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="url" class="form-label">URL *</label>
                <input type="text" name="url" id="url" class="form-control" placeholder="Enter URL" value="{{ old('url') }}">
                @error('url')
                    <div>{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category *</label>
                <select name="category_id" id="category" class="form-control">
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>
    <!-- Add Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
