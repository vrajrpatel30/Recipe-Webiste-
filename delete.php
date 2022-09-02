<?php
  session_start();
  if(!isset($_SESSION["username"])) {
    header("Location: index.php");
  }

  require("dbconnection.php");
  require("db_delete_recipe.php");
  $res = "";
  if (delete_recipe($conn, $_GET["Srno"]) === TRUE) {
    $res .= "<script>alert('Recipe deleted successfully');window.location='index.php';</script>";
  } else {
    $res .= "Error deleting recipe: " . $conn->error;
  }

  echo $res;
  $conn->close();
?>