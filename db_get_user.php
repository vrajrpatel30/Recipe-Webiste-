<?php
    function get_user($conn, $email, $password) {
        $sql = "SELECT * FROM users where emailId = '" . $email . "' and  password = '".$password."'";
        return mysqli_query($conn, $sql);
    }
?>