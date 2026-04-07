<?php


// echo "<pre>";

// print_r($_POST);

// echo "</pre>";

// exit;

//  UPDATE `students` SET `city` = 'multan', `age` = '22' WHERE `id` = 7;

// 1. connect to db
$hostname = "localhost";
$username = "root";
$passwrod = "";
$database = "ticerdb";

$conn = mysqli_connect($hostname, $username, $passwrod, $database);

if (!$conn) {
    die("connection failed "  . mysqli_connect_error());
}

// 2. collect data and validate data
$id   = $_POST['id'];
$name = $_POST['name'];
$age  = $_POST['age'];
$city = $_POST['city'];
$gender = $_POST['gender'];
$email  = $_POST['email'];

// 3. prepare query
$sql = "UPDATE students SET name='$name', age='$age', city='$city', gender='$gender', email='$email' WHERE id=$id ";


// 4. run query   
if (mysqli_query($conn, $sql)) {
    // 6. redirect to home page
    header("Location: index.php");
    exit;
} else {
    echo "Error: " . mysqli_error($conn);
}


// 5. connection close =  optional
mysqli_close($conn);
