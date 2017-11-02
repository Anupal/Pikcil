
<?php session_start();
require 'db.php';?>
<!DOCTYPE html>
<html>
    <head><title>Home</title></head>
    <body>

        <form id="TheForm" method="post" action="display_comment.php">
            <input type="hidden" name="username" value="something" />
            <input type="hidden" name="image" value="something" />
            <input type="hidden" name="title" value="something" />
            <input type="hidden" name="content" value="something" />
        </form>

        <div style="display:none;height:500px;width500px;" id="black">
        </div>
        <?php
            //Select queries return a resultset
            $status='';
            $sql = "SELECT username, title, image, content FROM blogs";
            $result = $mysqli->query($sql); //$result = mysqli_result object
            //var_dump($result);
            ?>

            <span>All Blogs:</span>
            <?php
            while($row = $result->fetch_assoc()){ //returns associative array of fetched row
                echo "<h1>{$row['title']}</h1><br>";
                echo "<div><span>{$row['username']}</span></div><br>";
                echo "<img src='{$row['image']}' onclick='displayComment(\"". $row['title'] ."\")'></div><br>";
            }
        ?>
        <script>
            function displayBlack(){
                document.getElementById("black").style.display='block';
                window.open("", "", "width=300, height=200");
            }

            function displayComment(title) {
                //window.location.href = "http://www.google.com";
                //window.location.href = "displayComment.php?username="+encodeURL(username);
                window.location.href = "blog_content.php?title="+encodeURI(title);
            }

        </script>

    </body>
</html>
