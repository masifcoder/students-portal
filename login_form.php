<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-card {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .btn-dark {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
        }
        .form-control {
            border-radius: 8px;
            padding: 10px;
        }
        .forgot-link {
            font-size: 14px;
            color: green;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="login-card text-center">
    <h2 class="mb-2">Hello!</h2>
    <p class="text-muted mb-4">
        To Log In To Your Account, Enter Your Email Address And Password.
    </p>

    <form>
        <div class="mb-3">
            <input type="email" class="form-control" placeholder="Your email address" required>
        </div>

        <div class="mb-2">
            <input type="password" class="form-control" placeholder="Your password" required>
        </div>

        <div class="text-start mb-3">
            <a href="#" class="forgot-link">Forgot Password?</a>
        </div>

        <button type="submit" class="btn btn-dark">Next step</button>
    </form>

    <p class="mt-4 text-muted" style="font-size: 14px;">
        Don't hesitate to contact us at<br>
        <span style="color: green;">support@bonsante.com</span>
    </p>
</div>

</body>
</html>