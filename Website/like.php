<?php
    require 'db.php';
    $email = $_GET['email'];
    $title = $_GET['title'];

    echo $email;
    echo $title;
        $result = $mysqli->query("SELECT * FROM likes WHERE email='$email' AND title='$title'") or die($mysqli->error());
        if ( $result->num_rows == 0 ) {
            $sql = "INSERT INTO likes (title, email) ". "VALUES ('$title','$email')";
            $result = $mysqli->query($sql) or die($mysqli->error());
        }
 ?>
