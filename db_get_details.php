<?php
    require('dbconnection.php');
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $sql = "SELECT * FROM recipe where srno = " . $_GET["id"];
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            if($row = mysqli_fetch_assoc($result)) {
                return $row;
            }
        } 
    }
    mysqli_close($conn);    
?>