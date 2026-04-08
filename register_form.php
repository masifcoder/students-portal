<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>


    <div class="container">
        <?php
        require "./navbar.php";
        ?>

        <h1 class="my-3">Register a new account</h1>
        <form method="post" action="./register.php">
            <div class="mb-3">
                <label for="namelabel" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="namelabel" placeholder="student name">
                <?php if (isset($_SESSION['name_error']) && !empty($_SESSION['name_error'])) { ?>
                    <div class="alert alert-danger my-1"> <?php echo $_SESSION['name_error'];
                                                        unset($_SESSION['name_error']) ?> </div>
                <?php } ?>
            </div>
            <div class="mb-3">
                <label for="amailaddress" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="amailaddress" placeholder="your username">
            <?php if (isset($_SESSION['username_error']) && !empty($_SESSION['username_error'])) { ?>
                    <div class="alert alert-danger my-1"> <?php echo $_SESSION['username_error'];
                                                        unset($_SESSION['username_error']) ?> </div>
                <?php } ?>
            </div>
            <div class="mb-3">
                <label for="amailaddress" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="amailaddress" placeholder="secret password">
            <?php if (isset($_SESSION['password_error']) && !empty($_SESSION['password_error'])) { ?>
                    <div class="alert alert-danger my-1"> <?php echo $_SESSION['password_error'];
                                                        unset($_SESSION['password_error']) ?> </div>
                <?php } ?>
            </div>

            <div class="mb-3">
                <button class="btn btn-sm btn-warning">Register</button>
            </div>
        </form>
    </div>
</body>

</html>