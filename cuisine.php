<?php
    require('dbconnection.php');
    require('db_get_cuisines.php');
    if(isset($_GET["q"])) {
        $result = get_cuisines($conn, $_GET["q"]);

        $res = "<h2>".$_GET['q']."</h2>";

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $res .= "<a href='details.html?id=".$row["Srno"]."'>".$row["recipeName"]. "</a><br>";
            }
        } 
        else {
            $res .= "0 results";
        }
    }

    $conn->close();
    echo json_encode($res);
?>