<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dark Themed Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />

    <style>
        body {
            margin: 0;
            background-color: #0d1117;
            font-family: 'Poppins', sans-serif;
            color: #ffffff;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background-color: #161b22;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.6);
            width: 100%;
            max-width: 400px;
        }

        .login-container h2 {
            font-weight: 600;
            margin-bottom: 25px;
            text-align: center;
        }

        .form-control {
            background-color: #0d1117;
            border: 1px solid #30363d;
            color: #ffffff;
            padding: 12px;
            border-radius: 8px;
        }

        .form-control:focus {
            border-color: #f39c12;
            box-shadow: 0 0 0 0.2rem rgba(243, 156, 18, 0.25);
        }

        .btn-custom {
            background: none;
            border: 2px solid #f39c12;
            color: #f39c12;
            padding: 10px 0;
            width: 100%;
            font-weight: 600;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-custom:hover {
            background-color: #f39c12;
            color: #0d1117;
        }

        .form-icon {
            margin-right: 10px;
            color: #f39c12;
        }

        .form-group label {
            margin-top: 10px;
            font-size: 0.9rem;
        }

        .forgot-link {
            color: #f39c12;
            font-size: 0.85rem;
            text-align: center;
            display: block;
            margin-top: 12px;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h2>Sign In</h2>
            {{-- CSRF token jika ini Blade --}}
            {{-- @csrf --}}
            <div class="mb-3">
                <label>Email address</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-0"><i class="fa fa-user form-icon"></i></span>
                    <input type="email" class="form-control" placeholder="Enter email">
                </div>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-0"><i class="fa fa-lock form-icon"></i></span>
                    <input type="password" class="form-control" placeholder="Enter password">
                </div>
            </div>
            <a href="/admin123">
                <button type="submit" class="btn btn-custom mt-3">Login</button>
            </a>
            <a href="#" class="forgot-link">Forgot your password?</a>
    </div>

</body>

</html>
