<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="index.css"/>
</head>
<body>
    <div class="jumbotron">
        <h1>Food Recipe</h2>
    </div>
    <div id="sidebar">
        <a href="index.php">Home</a>
        <a href="menu.php">Menu</a>
        <a href="about.html">About</a>
        <a href="search.php">Search</a>
        <a href="contactus.html">Contact Us</a>
        <?php
            session_start();
            if(!isset($_SESSION["username"])) {
                echo "<a href='login.html'>Log In</a>";
            }
            else {
                echo "<a href='add.html'>Add a recipe</a>";
                echo "<a href='logout.php'>Log Out</a>";
            }
        ?>
    </div>
    <div id="main">
    <h2>Course</h2>
    <?php
    require('dbconnection.php');

        $sql = "SELECT DISTINCT Course FROM recipe";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo "<a href='course.html?q=".$row["Course"]."'>".$row["Course"]. "</a><br>";
            }
        } 
        else {
            echo "0 results";
        }
    ?>

<h2>Cuisine</h2>
    <?php

        $sql = "SELECT DISTINCT Cuisine FROM recipe";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo "<a href='cuisine.html?q=".$row["Cuisine"]."'>".$row["Cuisine"]. "</a><br>";
            }
        } 
        else {
            echo "0 results";
        }
    ?>
    </div>
</body>
</html>