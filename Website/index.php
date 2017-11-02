<?php
    require 'db.php';
    session_start();
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pikcil</title>
        <style>
            body{
                font-size:20px;
            }
            #login{
                display:none;

            }

            #signup{
                display:none;
            }
        </style>
    </head>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if (isset($_POST['login'])) { //user logging in

            require 'login.php';

        }

        elseif (isset($_POST['signup'])) { //user registering

            require 'signup.php';

        }
    }
    ?>

    <body>
        <h1>Welcome to Pikcil, we let you tell the stories behind your pictures.
        <h2>Login or Sign Up to continue<h2>
        <p><button onclick="showSignup()">Sign Up</button>   <button onclick="showLogin()">Login</button></p>

        <div id="signup">
            <form action="index.php" method="post">
                <p>Sign Up</p>
                <input type="text" name="first_name" placeholder="First Name" required value><br>
                <input type="text" name="last_name" placeholder="Last Name" required value><br>
                <input type="email" name="email" placeholder="Email" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <input type="submit" name="signup" value="Signup">
            </form>
        </div>

        <div id="login" onclick="showLogin()">
            <form action="index.php" method="post">
                <p>Login</p>
                <input type="email" name="email" placeholder="Email" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <input type="submit" name="login" value="Login">
            </form>
        </div>

        <script>
            function showSignup(){
                document.getElementById('login').style.display="none";
                document.getElementById('signup').style.display="block";
            }

            function showLogin(){
                document.getElementById('signup').style.display="none";
                document.getElementById('login').style.display="block";
            }
        </script>

    </body>
</html>
