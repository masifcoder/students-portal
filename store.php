<?php


echo "<pre>";

print_r($_POST);

echo "</pre>";

// 1. connect to db
    $hostname = "localhost";
    $username = "root";
    $passwrod = "";
    $database = "ticerdb";

    $conn = mysqli_connect($hostname, $username, $password, $database);

    if(!$conn) {
        die("connection failed "  . mysqli_connect_error());
    }

// 2. collect data and validate data
    $name = $_POST['name'];
    $age  = $_POST['age'];
    $city = $_POST['city'];
    $gender = $_POST['gender'];
    $email  = $_POST['email'];

// 3. prepare query
    $sql = "INSERT INTO students (name, email, city, age, gender) VALUES('$name', '$email', '$city', '$age', '$gender') ";


 // 4. run query   
    if( mysqli_query($conn, $sql) ) {
        echo "student successfully inserted";
    } else {
        echo "Error: " . mysqli_error($conn);
    }


// 5. connection close =  optional

    mysqli_close($conn);

?>
