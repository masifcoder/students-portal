<?php
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
$sql = "SELECT * FROM students";

// 4. run query   
$result = mysqli_query($conn, $sql);


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



        <h1 class="my-3">Ticer Students Dashboard</h1>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Gender</th>
                    <th scope="col">City</th>
                    <th scope="col">Age</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php while ($row = mysqli_fetch_assoc($result)) {  ?>
                    <tr>
                        <th><?php echo $row['id'] ?> </th>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['gender'] ?></td>
                        <td><?php echo $row['city'] ?></td>
                        <td><?php echo $row['age'] ?></td>
                        <td>
                            <a href="./delete.php?id=<?php echo $row['id'] ?>">delete</a>
                            <a href="./update_form.php?id=<?php echo $row['id'] ?>">update</a>
                        </td>
                    </tr>
                <?php }  ?>

            </tbody>
        </table>


    </div>
</body>

</html>