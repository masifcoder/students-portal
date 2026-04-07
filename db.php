<?php

// 1. connect to db
    $hostname = "localhost";
    $username = "root";
    $passwrod = "";
    $database = "ticerdb";

    $conn = mysqli_connect($hostname, $username, $passwrod, $database);

    if(!$conn) {
        die("connection failed "  . mysqli_connect_error());
    }

    ?>