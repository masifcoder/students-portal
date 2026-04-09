<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal - Signup</title>

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
        .alert {
            border-radius: 8px;
            font-size: 13px;
            padding: 8px 12px;
            margin-top: 8px;
        }
    </style>
</head>
<body>

<div class="login-card text-center">
    <h2 class="mb-2">Register a new account</h2>
    <p class="text-muted mb-4">
        Please fill in your details below to create an account.
    </p>

    <form method="post" action="./register.php">
        <!-- Name Field - kept exactly as original -->
        <div class="mb-3 text-start">
            <label for="namelabel" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="namelabel" placeholder="student name">
            <?php if (isset($_SESSION['name_error']) && !empty($_SESSION['name_error'])) { ?>
                <div class="alert alert-danger my-1"> <?php echo $_SESSION['name_error'];
                                                        unset($_SESSION['name_error']) ?> </div>
            <?php } ?>
        </div>

        <!-- Username Field - kept exactly as original -->
        <div class="mb-3 text-start">
            <label for="amailaddress" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="amailaddress" placeholder="your username">
            <?php if (isset($_SESSION['username_error']) && !empty($_SESSION['username_error'])) { ?>
                <div class="alert alert-danger my-1"> <?php echo $_SESSION['username_error'];
                                                        unset($_SESSION['username_error']) ?> </div>
            <?php } ?>
        </div>

        <!-- Password Field - kept exactly as original -->
        <div class="mb-3 text-start">
            <label for="amailaddress" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="amailaddress" placeholder="secret password">
            <?php if (isset($_SESSION['password_error']) && !empty($_SESSION['password_error'])) { ?>
                <div class="alert alert-danger my-1"> <?php echo $_SESSION['password_error'];
                                                        unset($_SESSION['password_error']) ?> </div>
            <?php } ?>
        </div>

        <!-- Register Button - kept as original but styled to match login form -->
        <div class="mb-3">
            <button type="submit" class="btn btn-dark">Register</button>
        </div>
    </form>

    <p class="mt-4 text-muted" style="font-size: 14px;">
        Already have an account?<br>
        <a href="./login_form.php" style="color: green; text-decoration: none;">Sign in here</a>
    </p>
</div>

</body>
</html>