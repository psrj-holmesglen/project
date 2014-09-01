<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 28/05/14
 * Time: 5:28 PM
 */

// encapsulate connection stuff in a function. // When called this function returns a reference // to a PDO Database connection object.
function getConnection()
{ // Connection details

    $dbhost = "127.0.0.1";
    $dbUser = "root";
    $dbpass = "root";
 //   $dbName = "epworth_ec";
 $dbName = "holmesglen_project";

 //   $dbUser="robfaie_econ_2";
 //   $dbpass="ohmcMJH&VI!T";
 //   $dbName="robfaie_econ";

    //$dbh = new PDO("mysql:host=$dbhost;dbname=$dbName",$dbUser,$dbpass);
    //$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return new PDO("mysql:host=$dbhost;dbname=$dbName;charset=utf8", $dbUser, $dbpass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

}