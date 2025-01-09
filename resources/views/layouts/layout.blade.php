<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Project</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Add your CSS file here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body {
            display: flex;
            height: 100vh;
            margin: 0;
        }
        .sidebar {
            width: 200px;
            background-color: #2d3748;
            color: #fff;
            padding: 20px;
        }
        .sidebar a {
            display: block;
            color: #fff;
            text-decoration: none;
            padding: 10px 0;
        }
        .sidebar a:hover {
            background-color: #4a5568;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>Menu</h3>
        <a href="{{ route('user.list') }}">Users</a>
        <a href="{{ route('role.list') }}">Roles</a>
        <a href="{{ route('category.list') }}">Categories</a>
        <a href="{{ route('bookmark.list') }}">Bookmarks</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
    <div class="content">
        @yield('content')
    </div>
</body>
</html>
