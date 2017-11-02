<?php
    session_start();
    $_SESSION['message'] = '';
    require 'db.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $email = $_SESSION['email'];
            $title = $mysqli->real_escape_string($_POST['title']);
            $content = $_POST['content'];
            $likes=0;
            $image_path = $mysqli->real_escape_string('images/'.$_FILES['image']['name']);

            if (preg_match("!image!",$_FILES['image']['type'])) {
                if (copy($_FILES['image']['tmp_name'], $image_path)){

                        $sql = "INSERT INTO blogs (email, title, image, content, likes) "
                                . "VALUES ('$email', '$title', '$image_path', '$content', '$likes')";

                        $yolo =$mysqli->query($sql) or die($mysqli->error);
                        if ($yolo){
                            $_SESSION['message'] = "Posted!";
                            header("location: home.php");
                        }
                        else{
                            $_SESSION['message'] = 'Blog could not be added!';
                        }

                }
                else{
                    $_SESSION['message'] = 'Image file upload failed!';
                }

            }
            else {
                $_SESSION['message'] = 'Please only upload GIF, JPG or PNG images!';
            }

    }

 ?>

<!DOCTYPE html>
<html>
    <head>
        <title>New Blog</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <style>
            .field{
                border-radius: 3px;
                border-width: 1px;
                border-color: #630d8b;
                padding: 10px;
                font-size: 14px;
                max-width: 100%;
            }
        </style>
    </head>
    <body>
        <p style="font-family: Rockwell;text-align: center;font-size:30px;color:#630d8b;margin-bottom:0;">New Blog</p>
        <?= $_SESSION['message'] ?>
        <form class='content' style='margin-top:50px' method="post" action="new_blog.php" autocomplete="off" enctype="multipart/form-data">
            <input class='field' type="text" placeholder="Title" name="title" required><br><br>
            <textarea class='field' rows="40" cols="115" name="content" required></textarea><br><br>
            <input class='field' type="file" name="image" accept="image/*" required /><br><br>
            <input class="btnsub" type="submit" name="upload" value="Submit" >
        </form>
    </body>
</html>
