<?php
session_start();

if (!isset($_SESSION['is_login']) || $_SESSION['is_login'] !== true) {
    $_SESSION['auth_error'] = "Please login to view dashboard";
    header("Location: login_form.php");
    exit;
}

require_once "db.php";
$student_id = $_GET['id'];

if (!$student_id) {
    header("Location: students.php");
    exit;
}

// 2. select all students query
$sql = "SELECT * FROM students WHERE id=$student_id";

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

    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


    <style>
        body {
            background: #f5f6fa;
            font-family: 'Segoe UI', sans-serif;
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
            display: flex;
            align-items: center;
            gap: 15px;
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
        <div claass="container my-4">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <div class="bg-secondary p-3 rounded">
                        <img class="img-fluid" src="./uploads/<?php echo $data['photo'] ?>" />
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="p-3 bg-warning-subtle">
                        <h1 class="border-bottom mb-5 pb-2"><?php echo $data['name'] ?></h1>
                        <h5 class="mb-3"><?php echo  ucfirst($data['gender']) ?></h5>
                        <h6 class="mb-3"><?php echo $data['age'] ?> years old</h6>
                        <h6 class="mb-3">From: <?php echo $data['city'] ?></h6>
                        <h6 class="mb-3"><?php echo $data['email'] ?></h6>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>