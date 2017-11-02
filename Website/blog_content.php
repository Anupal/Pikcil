<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    </head>
    <body id="body">

        <?php
            session_start();
            require 'db.php';
            if ( $_SESSION['logged_in'] != 1 ) {
              $_SESSION['message'] = "You must log in before viewing content!";
              header("location: error.php");
            }
            else {
                // Makes it easier to read
                $first_name = $_SESSION['first_name'];
                $last_name = $_SESSION['last_name'];
                $email = $_SESSION['email'];
                $title = $_GET['title'];
                //echo $title;
                //Select queries return a resultset
                $sql = "SELECT email, title, image, content FROM blogs WHERE title = '$title' ";
                $result = $mysqli->query($sql) or die($mysqli->error);
                $post = $result->fetch_assoc();

                $email_post = $post['email'];
                $sql = "SELECT dp, first_name, last_name FROM users WHERE email = '$email_post'";
                $result = $mysqli->query($sql) or die($mysqli->error);
                $post_user = $result->fetch_assoc();
                $f_name = $post_user['first_name'];
                $l_name = $post_user['last_name'];
                $image_user = $post_user['dp'];

            }

            echo "<div>";
                echo "<img src='{$post['image']}' style='width:100%;'>";
                        echo "<div class='content'>";
                        echo "<p style='font-family: Rockwell;font-size:80px;margin-bottom:0;'>{$post['title']}<p>";
                        echo "<p style='font-size:30px;margin-top:0;'>August 2017</p>";

                        echo "<p>{$post['content']}</p><br>";
                        echo "<button onclick='addLike(\"{$email}\",\"{$title}\")' class='button1'>&hearts; Like</button><br><br><br><br><br/>";

                         echo "<div onclick='displayContent(\"{$email_post}\")' style='display:flex;justify-content:flex-start;align-items:center;color:grey;'>";
                         echo "<img style='display:inline-block;width:80px;border-radius:40px' src='{$image_user}'>";
                         echo "<div style='display:inline-block;margin-left:20px;'><p style='margin-bottom:0;'> {$f_name} ";
                         echo " {$l_name} </p>";
                         echo "<p style='margin-top:0;'> {$email_post} </p></div>";
                         echo "</div>";
             echo "</div>";
         echo "</div>";
        ?>

        <script>
            function displayContent(email_post) {
                window.location.href = "profile_o.php?email_post="+encodeURI(email_post);
            }

            function  addLike(email, title){
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("GET", "like.php?email=" + encodeURI(email) + "&title=" + encodeURI(title), true);
                xmlhttp.send();
            }
        </script>

    </body>
</html>
