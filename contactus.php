<?php

$name = $_POST["name"];
$email = $_POST["email"];
$query = $_POST["query"];

if (empty($name)) {
    die("ERROR: Please provide your name.");
}

if (empty($email)) {
    die("ERROR: Please provide your email.");
}

$to = "vpatel78";
$from = "codd@cs.gsu.edu";
$subject = "Food Recipe Query";
$body = "Name: $name\r\nEmail: $email\r\nQuery: $query\r\n";
if(mail($to, $subject, $body, "From: $from")) {
    echo "<script>alert('Thank you for your application.');window.location='contactus.html';</script>";
} else {
    die("ERROR: Mail delivery error");
}

?>
