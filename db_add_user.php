<?php
    function db_add_user($conn, $firstname, $lastname, $email, $password, $phone) {
        $sql = "INSERT INTO users (firstname, lastname, emailid, password, phone) VALUES ('".$firstname."', '".$lastname."', '".$email."', '".$password."', '".$phone."')";
        return $conn->query($sql);
    }
?>