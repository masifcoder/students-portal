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

        <h1 class="my-3">Add New Student</h1>
        <form method="post" action="./store.php">
            <div class="mb-3">
                <label for="namelabel" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="namelabel" placeholder="student name">
            </div>
            <div class="mb-3">
                <label for="amailaddress" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="amailaddress" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Age</label>
                <input type="number" name="age" class="form-control" id="exampleFormControlInput1" placeholder="student age">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">City</label>
                <select name="city" id="" class="form-select">
                    <option value="lodhran">Lodhran</option>
                    <option value="bahawalpur">Bahawalpur</option>
                    <option value="multan">Multan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Gender</label>
                <select name="gender" id="" class="form-select">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="mb-3">
                <button class="btn btn-sm btn-warning">Add Student</button>
            </div>
        </form>
    </div>
</body>

</html>