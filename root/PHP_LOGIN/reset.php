<?PHP
// _____ _____ _____ _____    _____ _____ _____ _____ _____ _____ 
//|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
//  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
//  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|
//                                                                
// * File: reset.php
// * Add User for the dstc e conference web application.
// * Written by TEAM SPARTA 
// * Last updated: 20-05-14 by Jennifer de Peyrecave -->


// Import libraries.
require "../PHP_DB/dbObject.php";

// Get a copy of the DAL object.
$data = new Data();

error_reporting(0);
$email = $_POST['txtEmail'];

session_start();

if ($_POST['submit'] == 'Reset')
{

// Validate the email address.
//$e = true;
    /*if (!empty($_POST['txtEmail'])) {
        $e = escape_data($_POST['txtEmail']);
    } else {
        echo "<p><font color=”red” size=”+1″>You forgot to enter your email address!</font></p>";
        $e = FALSE;
    }*/

    if ($userRow = $data->user->getRowByMatch("Email", $_POST["txtEmail"])) {
        $ResetErr = "User exists";
    } else {
        $ResetErr = "No user exist with this email id";
    }
    if ($userRow = $data->user->getRowByMatch("Email", $_POST["txtEmail"])) {

        //create a new random password

        $password = "Password2";
        $pass = md5($password); //encrypted version for database entry

        //send email
        $to = $email;
        $subject = "Account Details Recovery";
        $body = "Hi, you or someone else have requested your account details. Here is your account information please keep this as you may need this at a later stage. Your new password is $password .Your password has been reset please login and change your password to something more rememberable. Regards Site Admin";
        $additionalheaders = "From: <noreply@econ.robfaie.net>";
        mail($to, $subject, $body, $additionalheaders);
        $ResetErr = "Email Sent";
        $newData = array(
                "Password" => $pass,

        );
        if ($data->user->updateRow($userRow[0]['ID'], $newData))

            echo "<script>window.location = 'login.php?page=login'</script>";
//			header("Location: login.php?page=login");
        /*$code=rand(100,999);
        $message="Your activation link is: http://localhost/webapp/root/PHP_LOGIN/index.php?eEmail=$email&code=$code";
        mail($email, "Password Reset", $message);
        $ResetErr = "Email sent";
        echo "your password has been emailed to you";


        $email_check=mysql_query("SELECT Password FROM user WHERE Email='$email'");
        $count=mysql_num_rows($email_check);
        $subject="Login Info";
        $message="Your password is .$count";
        $from="From: jenniferdepeyrecave@gmail.com";

        mail($email, $subject, $message, $from);
        echo "your password has been emailed to you";*/
    } else {
        $ResetErr = "No user exists with this email id";
    }
}else { ////
//// HTML Form START
////
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>DSTC</title>
    <link rel="stylesheet" type="text/css" href="../CSS/site_wide.css"/>
    <link rel="stylesheet" type="text/css" href="../CSS/login.css"/>
</head>

<body>
<div class="block">
    <!-- Back button -->
    <div id='backButton' style='float: left;'>
        <form action='login.php' method='get'>
            <input type='hidden' name='page' value='presenter'/>
            <input type='submit' class='buttonStyle1' value='Go Back'/>
        </form>
    </div>
    <div class="centered">
        <h1>Reset Password</h1>

        <form action='reset.php?page=reset&action=reset' method='post'>
            Enter you email: <input type="text" name="txtEmail"/><br/><br/>
            <input type="submit" name="submit" value="Reset" class="buttonStyle1"/>
            <span class='errorText'><?= $ResetErr ?></span>
        </form>
        <?php } ?>
    </div>
</div>
</body>
</html>
