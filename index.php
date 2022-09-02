<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
        <h2>Welcome to Food Recipe!</h2>
        <img src="images/home.jpg" style="width: 100%;" />    
    </div>
    <script src="index.js"></script>
</body>
</html>