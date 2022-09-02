<?php

function delete_recipe($conn, $srno) {
    $sql = "DELETE FROM recipe WHERE Srno=".$_GET["Srno"];
    return $conn->query($sql);
}

?>