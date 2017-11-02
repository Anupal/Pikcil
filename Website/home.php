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
              $_SESSION['message'] = "You must log in before viewing feed!";
              header("location: error.php");
            }
            else {
                // Makes it easier to read
                $first_name = $_SESSION['first_name'];
                $last_name = $_SESSION['last_name'];
                $email = $_SESSION['email'];
                $dp = $_SESSION['dp'];
                //Select queries return a resultset
                $sql = "SELECT title, image FROM blogs";
                $result = $mysqli->query($sql);

            }
        ?>

        <a href="new_blog.php"><img id="add" src="add.png"></a>

        <ul>
            <li class="logo"><a href="home.php"><img src="images/logo.png" alt="logo" style="width:100px;"></a></li>
            <li class="edge-option"><a href="profile.php"><?php echo "{$first_name} {$last_name}" ?> </a></li>
            <li class="options"><a href="home.php">Showcase </a></li>
        </ul>

        <p style="font-family: Rockwell;text-align: center;font-size:40px;color:#630d8b;margin-top:150px;">Featured Work</p>

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



        <script>
            function displayContent(title) {
                window.location.href = "blog_content.php?title="+encodeURI(title);
            }
        </script>

    </body>
</html>
