<?php
/*
 _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|

 * File: login.php
 * Login user to website.
 * Written by TEAM SPARTA
 * Last updated: 25-03-14 by Andy
*/

$errLog = "";

session_start();

if (isset($_POST["clicked_submit"])) {
    // Import libraries.
    require "../PHP_DB/dbObject.php";
    //check hashed password
    $hashPassword = md5($_POST["txtPass"]);
    // Get a copy of the DAL object.
    $data = new Data();

    if ($userRow = $data->user->getRowByMatch("User_name", $_POST["txtUser"])) {
		
        // Found username
        if ($userRow[0]["Password"] == $hashPassword) {
            // Found Password.
            $_SESSION["userFirstName"] = $userRow[0]["First_Name"];
            $_SESSION["userLastName"] = $userRow[0]["Last_Name"];
            $_SESSION["userEmail"] = $userRow[0]["Email"];
			$_SESSION["userName"] = $userRow[0]["User_name"];
			$_SESSION["userAccessLevel"] = $userRow[0] ["Access_Level"];
			$_SESSION["userID"] = $userRow[0]["ID"];
			
            header("Location: ../index.php");
        }
    }
    $errLog = "Incorrect Username or Password.";

}



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
    <div class="centered">
        <form method="post" action="login.php">
            <table class="center">
                <tr>
                    <td><h1>Login</h1></td>
                </tr>
                <tr>
                    <td>
                        <div class="center logReport"><?= $errLog ?></div>
                    </td>
                </tr>
                <tr>
                    <td><input placeholder="Username" name="txtUser" type="text" class="textBoxStyle1"/></td>
                </tr>
                <tr>
                    <td><input placeholder="Password" name="txtPass" type="password" class="textBoxStyle1"/></td>
                </tr>
                <br/>
                <tr>
                    <td>
                        <div><input type="submit" name="clicked_submit" value="Login" class="buttonStyle1"/></div>
                    </td>
                </tr>
            </table>
        </form>
        <form method="get" action="reset.php">
            <br/><input type="submit" value="Reset Password" class="buttonStyle1"/>
            <input type="hidden" name="page" value="reset"/>
            <input type="hidden" name="action" value="reset"/>
        </form>
    </div>
</div>
</body>
</html>