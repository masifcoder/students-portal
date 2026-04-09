<?php
session_start();

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit;


// incude database connection
require_once "db.php";

// 2. collect data and validate data
$username = $_POST['username'];
$password  = $_POST['password'];

if (!isset($username) || empty($username)) {
    $_SESSION['username_error'] = "Username field is required";
    header("Location: login_form.php");
    exit;
}
if (!isset($password) || empty($password)) {
    $_SESSION['password_error'] = "Password field is required";
    header("Location: login_form.php");
    exit;
}


// 1. check user is registered or not
$sel_sql = "SELECT * FROM users WHERE username='$username' ";
$sel_result = mysqli_query($conn, $sel_sql);
if (mysqli_num_rows($sel_result) == 0) {
    $_SESSION['notregister_error'] = "Username or Password is incorrect";
    header("Location: login_form.php");
    exit;
}

// 2.  get registerd user
$user = mysqli_fetch_assoc($sel_result);

// 3. verify password is correct
if (password_verify($password, $user['password']) === true) {
    $_SESSION['is_login'] = true;
    $_SESSION['name'] = $user['name'];
     header("Location: index.php");
     exit;
} else {
    $_SESSION['notregister_error'] = "Username or Password is incorrect";
    header("Location: login_form.php");
    // unset($_SESSION['is_login']);
    // unset($_SESSION['name']);
    exit;
}
