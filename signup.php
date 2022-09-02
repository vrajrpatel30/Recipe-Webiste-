<?php
    require('dbconnection.php');
    require('db_add_user.php');
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $result = db_add_user($conn, $_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["password"], $_POST["phone"]);
        if ($result === TRUE) {
            echo "<script>alert('Signup successful. Please login');window.location='login.html';</script>";
        } else {
            echo "<script>alert('Signup failed.');</script>";
            echo $conn->error;
        }
    }

    $conn->close();
?>