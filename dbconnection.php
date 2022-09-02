<?php
    $servername = "localhost";
    $username = "vpatel78";
    $password = "vpatel78";
    $dbname = "vpatel78";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    else {
        $sql = "SELECT * FROM recipe";
        $result = $conn->query($sql);

        if($result === FALSE || mysqli_num_rows($result) == 0) {
            include_once("db_create.php");
            if(create_database($conn) === FALSE) {
                echo $conn->error;
            }
        }
    }
?>