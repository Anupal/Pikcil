<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Welcome <?= $first_name.' '.$last_name ?></title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>

<body id="body">

    <?php
        /* Displays user information and some useful messages */
        session_start();
        require 'db.php';
        // Check if user is logged in using the session variable
        if ( $_SESSION['logged_in'] != 1 ) {
          $_SESSION['message'] = "You must log in before viewing your profile page!";
          header("location: error.php");
        }
        else {

            // Makes it easier to read
            $first_name = $_SESSION['first_name'];
            $last_name = $_SESSION['last_name'];
            $email = $_SESSION['email'];
            $dp = $_SESSION['dp'];

            $email_post = $_GET['email_post'];
            $sql = "SELECT dp, first_name, last_name FROM users WHERE email = '$email_post'";
            $result = $mysqli->query($sql) or die($mysqli->error);
            $post_user = $result->fetch_assoc();

            $f_name = $post_user['first_name'];
            $l_name = $post_user['last_name'];
            $image_user = $post_user['dp'];

            $sql = "SELECT title, image FROM blogs WHERE email='{$email_post}'";
            $result = $mysqli->query($sql) or die($mysqli->error);
        }
    ?>

    <ul>
        <li class="logo"><a href="home.php"><img src="images/logo.png" alt="logo" style="width:100px;"></a></li>
        <li class="edge-option"><a href="profile.php"><?php echo "{$first_name} {$last_name}" ?> </a></li>
        <li class="options"><a href="home.php">Showcase </a></li>
    </ul>

    <div class="content" style='border-bottom-style: solid;border-bottom-color:#d8d8d8;border-bottom-width:1px;'>
          <img <?php echo "src='{$image_user}'" ?> style='border-radius:100px; width:150px;'>
          <h2><?php echo $f_name.' '.$l_name; ?></h2>
          <p><?= $email_post ?></p>
    </div>

    <p style="font-family: Rockwell;text-align: center;font-size:30px;color:#630d8b;">Featured Work</p>

    <?php
        while($row = $result->fetch_assoc()){ //returns associative array of fetched row
            echo "<div class='content'>";
                echo "<div>";
                    echo "<a href='#'><img onclick='displayContent(\"". $row['title'] ."\")' src='{$row['image']}' style='width:100%;'></a>";
                    echo "<div style='width:100%;text-align:center;margin-top:20px;'>";
                        echo "<span style='font-size:25px;'>{$row['title']}</span>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
        }

        ?>

    <script
        function displayContent(title) {
            window.location.href = "blog_content.php?title="+encodeURI(title);
        }
    </script>

</body>
</html>
