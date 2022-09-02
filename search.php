<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
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
    <form method="post" action="search.php">
        <input id="searchText" name="searchText" type="text" placeholder="Enter text.." required><br>
        Search by
        <input type="radio" name="filter" value="Name">Name
        <input type="radio" name="filter" value="Type">Type
        <br>
        <input id="searchButton" type="submit" value="Search">
    </form>
    <?php
    require('dbconnection.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if($_POST["filter"] == "Name") {
            $sql = "SELECT Srno, recipeName FROM recipe where recipeName like '%" . $_POST["searchText"] . "%'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<a href='details.html?id=".$row["Srno"]."'>".$row["recipeName"]. "</a><br>";
                }
            } 
            else {
                echo "0 results";
            }
        }
        else if($_POST["filter"] == "Type") {
            $sql = "SELECT Srno, recipeName FROM recipe where Cuisine like '%" . $_POST["searchText"] . "%' or Course like '%".$_POST["searchText"]."%'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<a href='details.html?id=".$row["Srno"]."'>".$row["recipeName"]. "</a><br>";
                }
            } 
            else {
                echo "0 results";
            }
        }

        mysqli_close($conn);
    }
    ?>
    </div>
</body>
</html>