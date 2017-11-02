<?php
    require 'db.php';
    session_start();
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pikcil</title>
        <style>
            .center{
                font-size:35px;
                text-align: center;
                font-family: Rockwell;
                color: #fff;
                margin-top:40vh;
            }
            #login{
                display:none;
                margin-top: 20vh;
                background: #fff;
                border-radius: 10px;
                width: 40vh;
                color: #630d8b;
                padding: 1vh 0 3vh 0;
                margin-left: 40vw;
            }

            #signup{
                display:none;
                margin-top: 20vh;
                background: #fff;
                border-radius: 10px;
                width: 40vh;
                color: #630d8b;
                padding: 1vh 0 3vh 0;
                margin-left: 40vw;
            }

            .btn{
                color: #fff;
                background: Transparent;
                border-width: 1px;
                border-style: solid;
                border-radius: 5px;
                font-size: 18px;
                padding: 6px 11px 6px 11px;
                border-color: #fff;
                margin: 5px;
            }
            .btnsub{
                color: #fff;
                background: #630d8b;
                border-style: solid;
                border-radius: 5px;
                font-size: 14px;
                border-color: Transparent;
                padding: 6px 11px 6px 11px;
                margin: 4px;
            }

            .btnsub:hover{
                background: #272727;
            }

            .btn:hover{
                background: #fff;
                color: #630d8b;

            }
            .field{
                width:30vh;
                height:30px;
                border-radius: 5px;
                border-color: #630d8b;
                border-width: 1px;
                text-align: center;
                margin: 5px;
                background: Transparent;
                color: #630d8b;
                font-size: 14px;
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

    <body style="background: url(images/coverd.jpg);background-size: 100vw;)">
        <div class="center" id="text">
                <h2>Tell the stories behind your pictures.</h2>
                <p><button class ='btn' onclick="showSignup()">Sign Up</button>   <button class='btn' onclick="showLogin()">Login</button></p>
        </div>

        <div id="signup" class="center">
            <img src='delete.png' style='float:right; width:18px;margin-right:10px;margin-top:5x;' onclick='showStart()'>
            <form action="index.php" method="post" autocomplete="off" enctype="multipart/form-data">
                <p style="font-size:30px">Sign Up</p>
                <input class="field" type="text" name="first_name" placeholder="First Name" required autocomplete="off"><br>
                <input class="field" type="text" name="last_name" placeholder="Last Name" required autocomplete="off"><br>
                <input class="field" type="email" name="email" placeholder="Email" required autocomplete="off"><br>
                <input class="field" type="password" name="password" placeholder="Password" required autocomplete="off"><br>
                <input class="field" type="file" name="dp" accept="image/*" required><br>
                <input class="btnsub" type="submit" name="signup" value="Signup">
            </form>
        </div>

        <div id="login" class="center">
            <img src='delete.png' style='float:right; width:18px;margin-right:10px;margin-top:5x;' onclick='showStart()'>
            <form action="index.php" method="post">
                <p style='font-size:30px;'>Login</p>
                <input class="field" type="email" name="email" placeholder="Email" required><br>
                <input class="field" type="password" name="password" placeholder="Password" required><br>
                <input class="btnsub" type="submit" name="login" value="Login">
            </form>
        </div>

        <script>
            function showSignup(){
                document.getElementById('text').style.display="none";
                document.getElementById('login').style.display="none";
                document.getElementById('signup').style.display="block";
            }

            function showLogin(){
                document.getElementById('text').style.display="none";
                document.getElementById('signup').style.display="none";
                document.getElementById('login').style.display="block";
            }
            function showStart(){
                document.getElementById('text').style.display="block";
                document.getElementById('signup').style.display="none";
                document.getElementById('login').style.display="none";
            }
        </script>

    </body>
</html>
