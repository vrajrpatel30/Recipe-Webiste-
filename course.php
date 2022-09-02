<?php
    require('dbconnection.php');
    require('db_get_courses.php');

    if(isset($_GET["q"])) {
        $result = get_courses($conn, $_GET["q"]);

        $res = "";
        $res .= "<h2>".$_GET['q']."</h2>";

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $res .= "<a href='details.html?id=".$row["Srno"]."'>".$row["recipeName"]. "</a><br>";
            }
        } 
        else {
            $res .= "0 results";
        }
    }

    echo json_encode($res);
    $conn->close();
?>