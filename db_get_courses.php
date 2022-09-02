<?php
    function get_courses($conn, $q) {
        $sql = "SELECT Srno, recipeName FROM recipe where Course = '".$q."'";
        return mysqli_query($conn, $sql);
    }
?>