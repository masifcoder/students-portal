<?php

if (empty($_GET['id'])  || !isset($_GET['id'])) {
    die("student id is required");
}


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


// 2. select all students query
$sql = "SELECT * FROM students WHERE id=$id";

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
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>


    <div class="container">
        <?php
        require "./navbar.php";
        ?>

        <h1 class="my-3">Update Student</h1>
        <form method="post" action="./update.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="mb-3">
                <label for="namelabel" class="form-label">Name</label>
                <input type="text" name="name" value="<?php echo $data['name'] ?>" class="form-control" id="namelabel" placeholder="student name">
            </div>
            <div class="mb-3">
                <label for="amailaddress" class="form-label">Email address</label>
                <input type="email" name="email" value="<?php echo $data['email'] ?>" class="form-control" id="amailaddress" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Age</label>
                <input type="number" name="age" value="<?php echo $data['age'] ?>" class="form-control" id="exampleFormControlInput1" placeholder="student age">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">City</label>
                <select name="city" id="" class="form-select">
                    <option value="lodhran" <?php echo ($data['city'] == 'lodhran') ? 'selected' : '' ?>>Lodhran</option>
                    <option value="bahawalpur" <?php echo ($data['city'] == 'bahawalpur') ? 'selected' : '' ?>>Bahawalpur</option>
                    <option value="multan" <?php echo ($data['city'] == 'multan') ? 'selected' : '' ?>>Multan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Gender</label>
                <select name="gender" id="" class="form-select">
                    <option value="male" <?php echo ($data['gender'] == 'male') ? 'selected' : '' ?>>Male</option>
                    <option value="female" <?php echo ($data['gender'] == 'female') ? 'selected' : '' ?>>Female</option>
                </select>
            </div>
            <div class="mb-3">
                <button class="btn btn-sm btn-warning">Update Student</button>
            </div>
        </form>
    </div>
</body>

</html>