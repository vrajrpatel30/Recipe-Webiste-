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
                echo "<a href='add.php'>Add a recipe</a>";
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

                $sql = "INSERT INTO recipe (RecipeName, Ingredients, PrepTimeInMins, CookTimeInMins, 
                                            TotalTimeInMins, Servings, Cuisine, Course, Instructions)
                        VALUES ('".$_POST["RecipeName"]."', '".$_POST["Ingredients"]."', '".$_POST["PrepTimeInMins"]."', 
                        '".$_POST["CookTimeInMins"]."', '".((int)$_POST["PrepTimeInMins"]+(int)$_POST["CookTimeInMins"])."' ,
                         '".$_POST["Servings"]."', '".$_POST["Cuisine"]."', '".$_POST["Course"]."', '".$_POST["Instructions"]."')";

                if ($conn->query($sql) === TRUE) {
                        echo "Recipe added successfully with serial number ".$conn->insert_id."<br>";
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
                                $sql = "UPDATE recipe SET image ='".basename($target_file)."' WHERE Srno = ".$conn->insert_id;
                                $conn->query($sql);
                            } else {
                                echo "Sorry, there was an error uploading your image. Go to Modify recipe page to upload again.";
                            }
                        }
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
            }

            $conn->close();
        ?>
        

        <form method="post" action="add.php" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Recipe name</td>
                    <td><input type="text" name="RecipeName" value="<?php if(isset($_POST["RecipeName"])) echo $_POST["RecipeName"]; ?>" required></td>
                </tr>
                <tr>
                    <td>Ingredients</td>
                    <td><textarea name="Ingredients" required><?php if(isset($_POST["Ingredients"])) echo $_POST["Ingredients"]; ?></textarea></td>
                </tr>
                <tr>
                    <td>Preparation Time (in minutes)</td>
                    <td><input type="text" name="PrepTimeInMins" value="<?php if(isset($_POST["PrepTimeInMins"])) echo $_POST["PrepTimeInMins"]; ?>" required></td>
                </tr>
                <tr>
                    <td>Cook Time (in minutes)</td>
                    <td><input type="text" name="CookTimeInMins" value="<?php if(isset($_POST["CookTimeInMins"])) echo $_POST["CookTimeInMins"]; ?>" required></td>
                </tr>
                <tr>
                    <td>Servings</td>
                    <td><input type="text" name="Servings" value="<?php if(isset($_POST["Servings"])) echo $_POST["Servings"]; ?>"></td>
                </tr>
                <tr>
                    <td>Course</td>
                    <td><input type="text" name="Course" value="<?php if(isset($_POST["Course"])) echo $_POST["Course"]; ?>"></td>
                </tr>
                <tr>
                    <td>Cuisine</td>
                    <td><input type="text" name="Cuisine" value="<?php if(isset($_POST["Cuisine"])) echo $_POST["Cuisine"]; ?>"></td>
                </tr>
                <tr>
                    <td>Instructions</td>
                    <td><textarea name="Instructions" required><?php if(isset($_POST["Instructions"])) echo $_POST["Instructions"]; ?></textarea></td>
                </tr>
                <tr>
                    <td>Image</td>
                    <td><input type="file" name="fileToUpload"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Add"></td>
                </tr>
            </table>
        </form>
        <button onClick="clearAddRecipeForm()">Reset</button>
    </div>
</body>
</html>