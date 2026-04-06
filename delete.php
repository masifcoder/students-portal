<?php

// get id from url 
// echo "<pre>";
//     print_r($_GET);
// echo "</pre>";

$id = $_GET['id'];

// 1. connect to db
$hostname = "localhost";
$username = "root";
$passwrod = "";
$database = "ticerdb";

$conn = mysqli_connect($hostname, $username, $passwrod, $database);

if (!$conn) {
    die("connection failed "  . mysqli_connect_error());
}

// 2. prepare delete query
$query = "DELETE FROM students WHERE id=$id";

// 4. run query   
if (mysqli_query($conn, $query)) {
    // 6. redirect to home page
    header("Location: index.php");
    exit;
} else {
    echo "Error: " . mysqli_error($conn);
}

// 5. connection close =  optional
mysqli_close($conn);
