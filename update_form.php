<?php

if (empty($_GET['id'])  || !isset($_GET['id'])) {
    die("student id is required");
}


$id = $_GET['id'];

// 1. connect to db
require_once "db.php";

// 2. select all students query
$sql = "SELECT * FROM students WHERE id=$id";

// 4. run query   
$result = mysqli_query($conn, $sql);

// 5. fetch data
$data = mysqli_fetch_assoc($result);

// echo "<pre>";
//     print_r($data);
// echo "</pre>";

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #f5f6fa;
            font-family: 'Segoe UI', sans-serif;
        }

        .form-card {
            max-width: 600px;
            margin: 60px auto;
            padding: 30px;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
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

        .form-control,
        .form-select {
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

        /* Sidebar */
        .sidebar {
            width: 240px;
            height: 100vh;
            background: #fff;
            position: fixed;
            border-right: 1px solid #eee;
            padding: 20px;
        }

        .sidebar h4 {
            font-weight: 700;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            margin-bottom: 10px;
            color: #555;
            text-decoration: none;
            border-radius: 8px;
        }

        .sidebar a:hover {
            background: #f0f2f5;
            color: #000;
        }

        /* Topbar */
        .topbar {
            margin-left: 240px;
            height: 70px;
            background: #fff;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
        }

        .topbar .search {
            width: 300px;
        }

        /* Content */
        .content {
            margin-left: 240px;
            padding: 30px;
        }

        /* Card */
        .card-box {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        /* Table */
        .table thead {
            background: #000;
            color: #fff;
        }

        .badge-male {
            background: #e3f2fd;
            color: #1976d2;
        }

        .badge-female {
            background: #fce4ec;
            color: #c2185b;
        }

        .btn-sm {
            padding: 4px 10px;
        }
    </style>

    <style>
        .card-box {
            border-radius: 15px;
            padding: 15px 20px;
            background: #f8f9fa;
        }

        .icon-box {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 20px;
        }

        .icon-blue {
            background: #e7f1ff;
            color: #0d6efd;
        }

        .icon-green {
            background: #e8f8f0;
            color: #198754;
        }

        .icon-purple {
            background: #f3e8ff;
            color: #6f42c1;
        }

        .icon-dark {
            background: #e9ecef;
            color: #212529;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
        }

        .card-text {
            font-size: 13px;
            color: #6c757d;
            margin: 0;
        }
    </style>

</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4><img src="./images/ticer-logo.png" width="120px"></h4>

        <a href="./index.php"><i class="ri-home-4-line"></i> Home</a>
        <a href="./students.php"><i class="ri-group-line"></i> Students</a>
        <a href="./add_student.php"><i class="ri-user-add-line"></i> Add Student</a>
        <a href="./logout.php"><i class="ri-logout-box-r-line"></i> Logout</a>
    </div>

    <!-- Topbar -->
    <div class="topbar">
        <input type="text" class="form-control search" placeholder="Search...">

        <div>
            <i class="ri-notification-3-line me-3"></i>
            <i class="ri-user-3-line"></i>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="container my-4">
            <h1 class="mb-5">Add New Student Record</h1>

            <div class="card-box py-5">
                <form method="post" action="./update.php" enctype="multipart/form-data">
                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="namelabel" class="form-label">Name</label>
                        <input type="text" name="name" value="<?php echo $data['name'] ?>" class="form-control" id="namelabel" placeholder="student name">
                        <?php if (isset($_SESSION['name_error']) && !empty($_SESSION['name_error'])) { ?>
                            <div class="alert alert-danger"> <?php echo $_SESSION['name_error'];
                                                                unset($_SESSION['name_error']) ?> </div>
                        <?php } ?>
                    </div>

                    <!-- photo Field -->
                    <div class="mb-3">
                        <label for="amailaddress" class="form-label">Student Photo</label>
                        <input type="file" name="photo" class="form-control" id="amailaddress">
                        <?php if (isset($_SESSION['photo_error']) && !empty($_SESSION['photo_error'])) { ?>
                            <div class="alert alert-danger"> <?php echo $_SESSION['photo_error'];
                                                                unset($_SESSION['photo_error']) ?> </div>
                        <?php } ?>
                    </div>

                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="amailaddress" class="form-label">Email address</label>
                        <input type="email" name="email" value="<?php echo $data['email'] ?>" class="form-control" id="amailaddress" placeholder="name@example.com">
                    </div>

                    <!-- Age Field -->
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Age</label>
                        <input type="number" name="age" value="<?php echo $data['age'] ?>" class="form-control" id="exampleFormControlInput1" placeholder="student age">
                    </div>

                    <!-- City Field -->
                    <div class="mb-3">
                        <label for="citySelect" class="form-label">City</label>
                        <select name="city" id="citySelect" class="form-select">
                            <option value="lodhran" <?php echo ($data['city'] == 'lodhran') ? 'selected' : '' ?>>Lodhran</option>
                            <option value="bahawalpur" <?php echo ($data['city'] == 'bahawalpur') ? 'selected' : '' ?>>Bahawalpur</option>
                            <option value="multan" <?php echo ($data['city'] == 'multan') ? 'selected' : '' ?>>Multan</option>
                        </select>
                    </div>

                    <!-- Gender Field -->
                    <div class="mb-4">
                        <label for="genderSelect" class="form-label">Gender</label>
                        <select name="gender" id="genderSelect" class="form-select">
                            <option value="male" <?php echo ($data['gender'] == 'male') ? 'selected' : '' ?>>Male</option>
                            <option value="female" <?php echo ($data['gender'] == 'female') ? 'selected' : '' ?>>Female</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">Add Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>