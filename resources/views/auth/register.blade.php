<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #fff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        .container {
            max-width: 500px;
            margin-top: 100px;
            background: #f9f9f9;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
        }

        h2 {
            font-weight: 600;
            margin-bottom: 30px;
            color: #333;
        }

        .form-label {
            font-weight: 500;
            color: #333;
        }

        .form-control {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            color: #333;
            padding: 12px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: #fff;
            box-shadow: none;
            border: 1px solid #333;
        }

        .btn-primary {
            background: #333;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            color: #fff;
        }

        .btn-primary:hover {
            background: #444;
            transform: translateY(-2px);
        }

        .text-danger {
            font-size: 0.875em;
            margin-top: 5px;
            color: #ff6b6b;
        }

        .text-center a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
        }

        .text-center a:hover {
            color: #444;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <h2 class="text-center mb-4">Register</h2>

        <form action="{{ route('register.submit') }}" method="post">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>

            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
        </form>

        <div class="text-center mt-3">
            <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
        </div>
    </div>

    <!-- Optional: Add a subtle animation to the container -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.container');
            container.style.opacity = '0';
            container.style.transform = 'translateY(20px)';
            setTimeout(() => {
                container.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                container.style.opacity = '1';
                container.style.transform = 'translateY(0)';
            }, 100);
        });
    </script>
</body>

</html>
