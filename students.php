<?php
session_start();

if (!isset($_SESSION['is_login']) || $_SESSION['is_login'] !== true) {
    $_SESSION['auth_error'] = "Please login to view dashboard";
    header("Location: login_form.php");
    exit;
}

require_once "db.php";

// get search query
// echo "<pre>";
// print_r($_GET);
// echo "</pre>";

$search = (isset($_GET['search']) && !empty($_GET['search'])) ?  $_GET['search'] :  NULL;
$gender = (isset($_GET['gender']) && !empty($_GET['gender']) &&  $_GET['gender'] != 'all') ?  $_GET['gender'] :  NULL;



// search query SELECT * FROM `students` WHERE `name` LIKE '%ali%'
// gender query SELECT * FROM `students` WHERE `gender` = 'male'

$sql = "SELECT * FROM students";

// concate gender
if ($gender != NULL && $search === NULL) {
    $sql .= " WHERE `gender` = '$gender'";

} else if ($gender == NULL && $search != NULL) {
    $sql .= " WHERE name LIKE '%$search%' ";

}else if ($search !== NULL && $gender !== NULL) {
    $sql .= " WHERE gender='$gender' AND name LIKE '%$search%' ";
}



$result = mysqli_query($conn, $sql);
$total_students = mysqli_num_rows($result);
mysqli_data_seek($result, 0);



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
            display: flex;
            align-items: center;
            gap: 15px;
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
            <h1>All College Students</h1>
        </div>

        <!-- Table -->
        <div class="container">
            <h5 class="mb-3">Students List</h5>

            <div class="">
                <form method="GET">
                    <div class="mb-4 row g-3 align-items-center">
                        <div class="col-auto">
                            <input type="text" class="form-control" name="search" autocomplete="off" />
                        </div>
                        <div class="col-auto">
                            <select name="gender" id="genderSelect" class="form-select">
                                <option value="all">All Students</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>

                        <div class="col-auto">
                            <button class="btn btn-sm btn-warning me-2">Search</button>
                            <a href="./students.php" class="btn btn-sm btn-warning">All Students</a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-box">

                <?php if ($total_students > 0) { ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>City</th>
                                <th>Age</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>

                                    <td>
                                        <?php if ($row['gender'] == 'male') { ?>
                                            <span class="badge badge-male">Male</span>
                                        <?php } else { ?>
                                            <span class="badge badge-female">Female</span>
                                        <?php } ?>
                                    </td>

                                    <td><?php echo ucfirst($row['city']); ?></td>
                                    <td><?php echo $row['age']; ?></td>

                                    <td>
                                        <a href="update_form.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                <?php } else { ?>
                    <p class="text-muted">No data found</p>
                <?php } ?>
            </div>
        </div>

    </div>

</body>

</html>