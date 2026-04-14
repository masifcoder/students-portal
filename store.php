<?php
session_start();

echo "<pre>";
print_r($_POST);
echo "</pre>";

echo "<br>------------------------------<br>";

echo "<pre>";
print_r($_FILES['photo']);
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

    // UPLOADING STUDENT PHOTO
    $filename = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name'];
    $size     = $_FILES['photo']['size'];

    $folder = "uploads/";

    // check image is valid type
    $ext = strtolower( pathinfo($filename, PATHINFO_EXTENSION) );
    
    if( in_array($ext, ['jpg', 'jpeg', 'png'] ) == false) {
         $_SESSION['photo_error'] = "Please select valid image file";
        header("Location: add_student.php");
        exit;
    }

    // create unique file name 
    $new_name = time() . "_" . $filename;
    $target   = $folder . $new_name;

    // move file to uploads folder
    if(move_uploaded_file($tmp_name, $target) == false) {
         $_SESSION['photo_error'] = "Photo is not uploded please try again.";
        header("Location: add_student.php");
        exit;
    }



// 3. prepare query
    $sql = "INSERT INTO students (name, email, city, age, gender, photo) VALUES('$name', '$email', '$city', '$age', '$gender', '$new_name') ";


 // 4. run query   
    if( mysqli_query($conn, $sql) ) {
        echo "student successfully inserted";
    } else {
        echo "Error: " . mysqli_error($conn);
    }


// 5. connection close =  optional

    mysqli_close($conn);

?>