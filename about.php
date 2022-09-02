<?php
    session_start();
    $res = "";
    if(!isset($_SESSION["username"])) {
        $res .= "<a href='login.html'>Log In</a>";
    }
    else {
        $res .= "<a href='add.html'>Add a recipe</a>";
        $res .= "<a href='logout.php'>Log Out</a>";
    }
    echo json_encode($res);
?>