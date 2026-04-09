<?php session_start() ?>
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
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
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
        <h2 class="mb-2">Login!</h2>

        <?php if (isset($_SESSION['auth_error']) && !empty($_SESSION['auth_error'])) { ?>
            <div class="alert alert-danger my-2 fs-6"> <?php echo $_SESSION['auth_error'];
                                                        unset($_SESSION['auth_error']) ?> </div>
        <?php } ?>


        <p class="text-muted mb-4">
            To Log In To Your Account, Enter Your Email Address And Password.
        </p>

        <form action="./handle_login.php" method="post">
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Your Username" required>
                <?php if (isset($_SESSION['username_error']) && !empty($_SESSION['username_error'])) { ?>
                    <div class="alert alert-danger my-1"> <?php echo $_SESSION['username_error'];
                                                            unset($_SESSION['username_error']) ?> </div>
                <?php } ?>
            </div>

            <div class="mb-2">
                <input type="password" name="password" class="form-control" placeholder="Your Password" required>
                <?php if (isset($_SESSION['password_error']) && !empty($_SESSION['password_error'])) { ?>
                    <div class="alert alert-danger my-1"> <?php echo $_SESSION['password_error'];
                                                            unset($_SESSION['password_error']) ?> </div>
                <?php } ?>
            </div>

            <div class="text-start mb-3">
                <a href="#" class="forgot-link">Forgot Password?</a>
            </div>

            <button type="submit" class="btn btn-dark">Login</button>

            <?php if (isset($_SESSION['notregister_error']) && !empty($_SESSION['notregister_error'])) { ?>
                <div class="alert alert-danger my-2 fs-6"> <?php echo $_SESSION['notregister_error'];
                                                            unset($_SESSION['notregister_error']) ?> </div>
            <?php } ?>




        </form>

        <p class="mt-4 text-muted" style="font-size: 14px;">
            don't have an account?<br>
            <a href="./register_form.php" style="color: green; text-decoration: none;">Register here</a>
        </p>
    </div>

</body>

</html>