<?php
    function get_cuisines($conn, $q) {
        $sql = "SELECT Srno, recipeName FROM recipe where Cuisine = '".$q."'";
        return mysqli_query($conn, $sql);
    }
?>