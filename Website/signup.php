<?php
/* Registration process, inserts user info into the database
   and sends account confirmation email message
 */

// Set session variables to be used on profile.php page
$_SESSION['email'] = $_POST['email'];
$_SESSION['first_name'] = $_POST['first_name'];
$_SESSION['last_name'] = $_POST['last_name'];

// Escape all $_POST variables to protect against SQL injections
$first_name = $mysqli->escape_string($_POST['first_name']);
$last_name = $mysqli->escape_string($_POST['last_name']);
$email = $mysqli->escape_string($_POST['email']);
$password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
$hash = $mysqli->escape_string( md5( rand(0,1000) ) );

$dp_path = $mysqli->real_escape_string('dps/'.$_FILES['dp']['name']);

// Check if user with that email already exists
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error());

// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {

    $_SESSION['message'] = 'User with this email already exists!';
    header("location: error.php");

}
else { // Email doesn't exist in a database

    if (preg_match("!image!",$_FILES['dp']['type'])) {

        if (copy($_FILES['dp']['tmp_name'], $dp_path)){

            $sql = "INSERT INTO users (first_name, last_name, email, password, hash, dp) "
                . "VALUES ('$first_name','$last_name','$email','$password', '$hash', '$dp_path')";

            // Add user to the database
            if ( $mysqli->query($sql) == true){

                $_SESSION['logged_in'] = true; // So we know the user has logged in
                $_SESSION['message'] = "Account Created!";
                $_SESSION['dp'] = $dp_path;
                header("location: home.php");
            }
            else {
                $_SESSION['message'] = 'Registration failed!';
                header("location: error.php");
            }
        }
        else{
            $_SESSION['message'] = 'Image file upload failed!';
            header("location: error.php");
        }
    }
    else{
        $_SESSION['message'] = 'Please only upload GIF, JPG or PNG images!';
        header("location: error.php");
    }

}
