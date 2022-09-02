<?php
    session_start();
    require('dbconnection.php');
    require('db_get_user.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $result = get_user($conn, $_POST["email"], $_POST["password"]);

            $html = "";
            if ($result && mysqli_num_rows($result) > 0) {
                if($row = mysqli_fetch_assoc($result)) {
                    $_SESSION["username"] = $row["emailId"];
                    $html .= "<script>alert('Welcome, ".$row["firstName"]."');window.location='index.php'</script>";
                }
            } 
            else {
                $html .= "<script>alert('Invalid username or password.');window.location='login.html';</script>";
            }
        }

        mysqli_close($conn);
        echo $html;
    ?>