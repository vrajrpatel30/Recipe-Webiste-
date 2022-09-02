<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="index.css"/>
    <script src="scripts.js"></script>
</head>
<body>
    <div class="jumbotron">
        <h1>Food Recipe</h2>
    </div>
    <div id="sidebar">
        <a href="index.php">Home</a>
        <a href="menu.php">Menu</a>
        <a href="about.html">About</a>
        <a href="search.php">Search</a>
        <a href="contactus.html">Contact Us</a>
        <?php
            session_start();
            if(isset($_SESSION["username"])) {
                echo "<a href='add.html'>Add a recipe</a>";
                echo "<a href='logout.php'>Log Out</a>";
            }
            else {
                header('Location: index.php');
            }
        ?>
    </div>
    <div id="main">
        <?php
            require('dbconnection.php');
            if($_SERVER["REQUEST_METHOD"] == "POST") {

                $sql = "UPDATE recipe SET RecipeName = '".$_POST["RecipeName"]."', 
                                          Ingredients = '".$_POST["Ingredients"]."', 
                                          PrepTimeInMins = '".$_POST["PrepTimeInMins"]."', 
                                          CookTimeInMins = '".$_POST["CookTimeInMins"]."', 
                                          TotalTimeInMins = '".((int)$_POST["PrepTimeInMins"]+(int)$_POST["CookTimeInMins"])."',
                                          Servings = '".$_POST["Servings"]."', 
                                          Cuisine = '".$_POST["Cuisine"]."', 
                                          Course = '".$_POST["Course"]."', 
                                          Instructions = '".$_POST["Instructions"]."' WHERE Srno = ".$_GET["Srno"];

                if ($conn->query($sql) === TRUE) {
                        echo "Recipe updated successfully <br>";
                        if(file_exists($_FILES['fileToUpload']['tmp_name']) && is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
                            $target_dir = "./images/";
                            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                            $uploadOk = 1;
                            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                                if($check !== false) {
                                    $uploadOk = 1;
                                } else {
                                    echo "File is not an image.";
                                    $uploadOk = 0;
                                }

                            if (file_exists($target_file)) {
                                $target_file = $target_dir . $conn->insert_id .rand(0, 11111) . "." . $imageFileType;
                            }

                            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                $uploadOk = 0;
                            }

                            if ($uploadOk == 0) {
                                echo "Sorry, your image was not uploaded. Go to Modify recipe page to upload again.";
                            } else {
                                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                    echo "The image has been uploaded.";
                                    $sql = "UPDATE recipe SET image ='".basename($target_file)."' WHERE Srno = ".$_GET["Srno"];
                                    $conn->query($sql);
                                } else {
                                    echo "Sorry, there was an error uploading your image. Go to Modify recipe page to upload again.";
                                }
                            }
                        }
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
            }

            $sql = "SELECT * FROM recipe where srno = " . $_GET["Srno"];
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            $conn->close();
        ?>
        

        <form method="post" action="modify.php?Srno=<?php echo $_GET["Srno"] ?>" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Recipe name</td>
                    <td><input type="text" name="RecipeName" value="<?php echo $row["RecipeName"]; ?>" required></td>
                </tr>
                <tr>
                    <td>Ingredients</td>
                    <td><textarea name="Ingredients" required><?php echo $row["Ingredients"]; ?></textarea></td>
                </tr>
                <tr>
                    <td>Preparation Time (in minutes)</td>
                    <td><input type="text" name="PrepTimeInMins" value="<?php echo $row["PrepTimeInMins"]; ?>" required></td>
                </tr>
                <tr>
                    <td>Cook Time (in minutes)</td>
                    <td><input type="text" name="CookTimeInMins" value="<?php echo $row["CookTimeInMins"]; ?>" required></td>
                </tr>
                <tr>
                    <td>Servings</td>
                    <td><input type="text" name="Servings" value="<?php echo $row["Servings"]; ?>"></td>
                </tr>
                <tr>
                    <td>Course</td>
                    <td><input type="text" name="Course" value="<?php echo $row["Course"]; ?>"></td>
                </tr>
                <tr>
                    <td>Cuisine</td>
                    <td><input type="text" name="Cuisine" value="<?php echo $row["Cuisine"]; ?>"></td>
                </tr>
                <tr>
                    <td>Instructions</td>
                    <td><textarea name="Instructions" required><?php echo $row["Instructions"]; ?></textarea></td>
                </tr>
                <tr>
                    <td>Image</td>
                    <td><input type="file" name="fileToUpload"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Update"></td>
                </tr>
            </table>
        </form>
        <button onClick="clearAddRecipeForm()">Reset</button>
    </div>
</body>
</html>