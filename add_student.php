<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Portal - Add New Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-card {
            max-width: 600px;
            margin: 60px auto;
            padding: 30px;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .btn-success {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            background-color: #198754;
            border: none;
        }
        .btn-success:hover {
            background-color: #157347;
        }
        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px;
        }
        .form-label {
            font-weight: 500;
            margin-bottom: 6px;
        }
        .alert {
            border-radius: 8px;
            font-size: 13px;
            padding: 8px 12px;
            margin-top: 8px;
        }
        .header-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <div class="container">
        <?php require "./navbar.php"; ?>

        <div class="form-card">
            <div class="text-center mb-4">
                <div class="header-icon">📚</div>
                <h2 class="mb-2">Add New Student</h2>
                <p class="text-muted">Fill in the student details below to add them to the system.</p>
            </div>

            <form method="post" action="./store.php">
                <!-- Name Field -->
                <div class="mb-3">
                    <label for="namelabel" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="namelabel" placeholder="student name">
                    <?php if(isset($_SESSION['name_error'] ) && !empty($_SESSION['name_error'] )) { ?>
                        <div class="alert alert-danger"> <?php echo $_SESSION['name_error']; unset($_SESSION['name_error']) ?> </div>
                    <?php } ?>
                </div>

                <!-- Email Field -->
                <div class="mb-3">
                    <label for="amailaddress" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="amailaddress" placeholder="name@example.com">
                </div>

                <!-- Age Field -->
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Age</label>
                    <input type="number" name="age" class="form-control" id="exampleFormControlInput1" placeholder="student age">
                </div>

                <!-- City Field -->
                <div class="mb-3">
                    <label for="citySelect" class="form-label">City</label>
                    <select name="city" id="citySelect" class="form-select">
                        <option value="lodhran">Lodhran</option>
                        <option value="bahawalpur">Bahawalpur</option>
                        <option value="multan">Multan</option>
                    </select>
                </div>

                <!-- Gender Field -->
                <div class="mb-4">
                    <label for="genderSelect" class="form-label">Gender</label>
                    <select name="gender" id="genderSelect" class="form-select">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Add Student</button>
                </div>
            </form>

            <p class="mt-4 text-center text-muted" style="font-size: 14px;">
                All fields marked with <span class="text-danger">*</span> are required<br>
                <a href="./dashboard.php" style="color: #198754; text-decoration: none;">← Back to Dashboard</a>
            </p>
        </div>
    </div>

</body>

</html>