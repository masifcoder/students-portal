<?php
session_start();

echo "<pre>";
print_r($_POST);
echo "</pre>";

// incude database connection
    require_once "db.php";

// 2. collect data and validate data
    $name = $_POST['name'];
    $age  = $_POST['age'];
    $city = $_POST['city'];
    $gender = $_POST['gender'];
    $email  = $_POST['email'];

    if( !isset($name) || empty($name)) {
        $_SESSION['name_error'] = "Name field is required";
        header("Location: add_student.php");
        exit;
    }



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