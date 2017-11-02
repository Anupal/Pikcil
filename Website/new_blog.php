<?php
    session_start();
    $_SESSION['message'] = '';
    require 'db.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $username = "anupal";
            $title = $mysqli->real_escape_string($_POST['title']);
            $content = $mysqli->real_escape_string($_POST['content']);
            $likes=0;
            $image_path = $mysqli->real_escape_string('images/'.$_FILES['image']['name']);

            if (preg_match("!image!",$_FILES['image']['type'])) {
                if (copy($_FILES['image']['tmp_name'], $image_path)){

                        $sql = "INSERT INTO blogs (username, title, image, content, likes) "
                                . "VALUES ('$username', '$title', '$image_path', '$content', '$likes')";

                        if ($mysqli->query($sql) === true){
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
    </head>
    <body>
        <h1>New Blog</h1>
        <?= $_SESSION['message'] ?>
        <form method="post" action="new_blog.php" autocomplete="off" enctype="multipart/form-data">
            <input type="text" placeholder="Title" name="title" required><br><br>
            <textarea rows="20" cols="150" name="content" required></textarea><br><br>
            <input type="file" name="image" accept="image/*" required /><br><br>
            <input type="submit" name="upload" value="Submit" >
        </form>
    </body>
</html>
