<?php
    session_start();
    require("db_get_details.php");
    $res = "";
    $res .= "<h2>".$row["RecipeName"]."</h2>"
    . "<img src='images/".$row["image"]."' style='width: 40%'>"
    . "<table border='1'>"
    . "<tr><td>Ingredients</td><td>".$row["Ingredients"]."</td></tr>"
    . "<tr><td>Preparation Time</td><td>".$row["PrepTimeInMins"]." minutes</td></tr>"
    . "<tr><td>Cook Time</td><td>".$row["CookTimeInMins"]." minutes</td></tr>"
    . "<tr><td>Total Time</td><td>".$row["TotalTimeInMins"]." minutes</td></tr>"
    . "<tr><td>Servings</td><td>".$row["Servings"]."</td></tr>"
    . "<tr><td>Cuisine</td><td>".$row["Cuisine"]."</td></tr>"
    . "<tr><td>Course</td><td>".$row["Course"]."</td></tr>"
    . "<tr><td>Instructions</td><td>".$row["Instructions"]."</td></tr>"
    . "</table>";
    if(isset($_SESSION["username"])) {
        $res .= "<a href='modify.html?Srno=".$row["Srno"]."'>Modify</a><br><br>"
        . "<a href='delete.php?Srno=".$row["Srno"]."'>Delete</a><br><br>";
    }
    echo json_encode($res);
?>