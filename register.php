<?php
session_start();

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

// exit;

// incude database connection
require_once "db.php";

// 2. collect data and validate data
$name       = $_POST['name'];
$username   = $_POST['username'];
$password   = $_POST['password'];

if (!isset($name) || empty($name)) {
    $_SESSION['name_error'] = "Name field is required";
    header("Location: register_form.php");
    exit;
}

if (!isset($username) || empty($username)) {
    $_SESSION['username_error'] = "Username field is required";
    header("Location: register_form.php");
    exit;
}

if (!isset($password) || empty($password)) {
    $_SESSION['password_error'] = "Password field is required";
    header("Location: register_form.php");
    exit;
} else if (strlen($password) < 6) {
    $_SESSION['password_error'] = "Password lenght should be atleast 6 characters";
    header("Location: register_form.php");
    exit;
}


// check username should be unique
// 1. select record from users table to confrim with this username a user is already registered or not?
$sel_sql = "SELECT * FROM users WHERE username='$username' ";
$sel_result = mysqli_query($conn, $sel_sql);
if (mysqli_num_rows($sel_result) > 0) {
    $_SESSION['username_error'] = "Username already registered.";
    header("Location: register_form.php");
    exit;
}

// hashing password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// exit;

// 3. prepare query
$sql = "INSERT INTO users (name, username, password) VALUES('$name', '$username', '$hashed_password') ";


// 4. run query   
if (mysqli_query($conn, $sql)) {
    header("Location: login_form.php");
    exit;
} else {
    echo "Error: " . mysqli_error($conn);
}


// 5. connection close =  optional

mysqli_close($conn);
