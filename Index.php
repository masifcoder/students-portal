<?php
session_start();

if ( !isset($_SESSION['is_login']) || $_SESSION['is_login'] !== true) {
    $_SESSION['auth_error'] = "Please login to view dashboard";
    header("Location: login_form.php");
    exit;
}

?>

<?php
// 1. connect to db
// incude database connection
require_once "db.php";


// 2. select all students query
$sql = "SELECT * FROM students";

// 4. run query   
$result = mysqli_query($conn, $sql);

// Get total students count
$total_students = mysqli_num_rows($result);

// Reset result pointer for display
mysqli_data_seek($result, 0);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Dashboard | Ticer Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Remix Icon CDN -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .dashboard-card {
            max-width: 1400px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 20px;
            background: #fff;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }

        /* Header Section */
        .page-header {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e9ecef;
        }

        .page-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: #1a1a2e;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-header h1 i {
            color: #28a745;
            font-size: 32px;
        }

        .page-header p {
            color: #6c757d;
            margin: 8px 0 0 0;
            font-size: 14px;
        }

        /* Stats Bar */
        .stats-bar {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border-radius: 16px;
            padding: 20px 30px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 15px;
            color: white;
        }

        .stat-item i {
            font-size: 36px;
            opacity: 0.9;
        }

        .stat-info h3 {
            font-size: 28px;
            font-weight: 700;
            margin: 0;
            line-height: 1.2;
        }

        .stat-info p {
            margin: 0;
            opacity: 0.9;
            font-size: 13px;
        }

        .add-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.5);
            color: white;
            padding: 10px 24px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .add-btn:hover {
            background: white;
            color: #28a745;
            transform: translateY(-2px);
        }

        /* Table Styles */
        .table-wrapper {
            overflow-x: auto;
            border-radius: 16px;
            background: white;
        }

        .student-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .student-table thead th {
            background: #1a1a2e;
            color: white;
            padding: 16px 15px;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
        }

        .student-table thead th:first-child {
            border-top-left-radius: 12px;
        }

        .student-table thead th:last-child {
            border-top-right-radius: 12px;
        }

        .student-table tbody tr {
            transition: all 0.2s ease;
            border-bottom: 1px solid #eef2f6;
        }

        .student-table tbody tr:hover {
            background-color: #f8f9ff;
            transform: scale(1.01);
        }

        .student-table tbody td {
            padding: 14px 15px;
            color: #2c3e50;
            font-size: 14px;
            vertical-align: middle;
        }

        /* Badge styles for gender */
        .badge-gender {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-male {
            background: #e3f2fd;
            color: #1976d2;
        }

        .badge-female {
            background: #fce4ec;
            color: #c2185b;
        }

        /* City badge */
        .badge-city {
            background: #f3e5f5;
            color: #7b1fa2;
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-action {
            padding: 6px 14px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-edit {
            background: #fff3e0;
            color: #ed6c02;
            border: 1px solid #ffe0b2;
        }

        .btn-edit:hover {
            background: #ed6c02;
            color: white;
            transform: translateY(-2px);
        }

        .btn-delete {
            background: #ffe5e5;
            color: #d32f2f;
            border: 1px solid #ffcdd2;
        }

        .btn-delete:hover {
            background: #d32f2f;
            color: white;
            transform: translateY(-2px);
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 64px;
            color: #cbd5e0;
            margin-bottom: 20px;
        }

        .empty-state p {
            color: #6c757d;
            font-size: 16px;
        }

        /* Footer */
        .table-footer {
            margin-top: 20px;
            text-align: center;
            color: #6c757d;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php require "./navbar.php"; ?>

        <div class="dashboard-card">
            <!-- Header -->
            <div class="page-header">
                <h1>
                    <i class="ri-graduation-cap-fill"></i>
                    Student Management Dashboard
                </h1>
                <p>Manage and view all student records in one place</p>
            </div>

            <!-- Stats Bar -->
            <div class="stats-bar">
                <div class="stat-item">
                    <i class="ri-team-line"></i>
                    <div class="stat-info">
                        <h3><?php echo $total_students; ?></h3>
                        <p>Total Students</p>
                    </div>
                </div>
                <div class="stat-item">
                    <i class="ri-user-star-line"></i>
                    <div class="stat-info">
                        <h3>Active</h3>
                        <p>All Records</p>
                    </div>
                </div>
                <a href="./create.php" class="add-btn">
                    <i class="ri-add-line"></i>
                    Add New Student
                </a>
            </div>

            <!-- Table -->
            <div class="table-wrapper">
                <?php if (mysqli_num_rows($result) > 0) { ?>
                    <table class="student-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Student Name</th>
                                <th>Email Address</th>
                                <th>Gender</th>
                                <th>City</th>
                                <th>Age</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) {  ?>
                                <tr>
                                    <td><strong>#<?php echo $row['id'] ?></strong></td>
                                    <td>
                                        <i class="ri-user-3-line" style="color: #28a745; margin-right: 8px;"></i>
                                        <?php echo htmlspecialchars($row['name']) ?>
                                    </td>
                                    <td>
                                        <i class="ri-mail-line" style="color: #6c757d; margin-right: 6px;"></i>
                                        <?php echo htmlspecialchars($row['email']) ?>
                                    </td>
                                    <td>
                                        <?php if ($row['gender'] == 'male') { ?>
                                            <span class="badge-gender badge-male">
                                                <i class="ri-men-line"></i> Male
                                            </span>
                                        <?php } else { ?>
                                            <span class="badge-gender badge-female">
                                                <i class="ri-women-line"></i> Female
                                            </span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <span class="badge-city">
                                            <i class="ri-map-pin-line"></i>
                                            <?php echo ucfirst(htmlspecialchars($row['city'])) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <i class="ri-calendar-line" style="color: #6c757d; margin-right: 5px;"></i>
                                        <?php echo $row['age'] ?> years
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="./update_form.php?id=<?php echo $row['id'] ?>" class="btn-action btn-edit">
                                                <i class="ri-edit-line"></i> Edit
                                            </a>
                                            <a href="./delete.php?id=<?php echo $row['id'] ?>" class="btn-action btn-delete" onclick="return confirm('Are you sure you want to delete this student?')">
                                                <i class="ri-delete-bin-line"></i> Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <div class="empty-state">
                        <i class="ri-information-line"></i>
                        <p>No students found in the database.</p>
                        <a href="./create.php" class="add-btn" style="background: #28a745; color: white; display: inline-flex; margin-top: 15px;">
                            <i class="ri-add-line"></i> Add Your First Student
                        </a>
                    </div>
                <?php } ?>
            </div>

            <div class="table-footer">
                <i class="ri-database-2-line"></i> Showing <?php echo $total_students; ?> record(s) | Last updated: <?php echo date('F j, Y'); ?>
            </div>
        </div>
    </div>
</body>

</html>