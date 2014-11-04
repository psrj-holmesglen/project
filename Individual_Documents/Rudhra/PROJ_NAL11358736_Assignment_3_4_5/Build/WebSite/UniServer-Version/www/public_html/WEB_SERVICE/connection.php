<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 28/05/14
 * Time: 5:28 PM
 */

// encapsulate connection stuff in a function. // When called this function returns a reference // to a PDO Database connection object.
function getConnection(){ // Connection details


	/**
        PLEASE DONT CHANGE THIS VALUES, THEY SHOULD BE COMMENTED, NOT CHANGED.
    
    //SERVER HOST
	$dbhost = "localhost";
    $dbName = "eConference";
    $dbUser = "eConference_user";
    $dbpass = "UewSLJMV3r%m";
	*/
	// LOCALHOST
    //$dbhost="127.0.0.1";
    $dbhost="localhost";
	$dbUser="dstc";
	$dbpass="Traumacare2014";
	$dbName="dstcapp";

//    $dbUser="robfaie_econ";
//    $dbpass="ohmcMJH&VI!T";
//    $dbName="robfaie_econ";

    //$dbh = new PDO("mysql:host=$dbhost;dbname=$dbName",$dbUser,$dbpass);
    //$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return new PDO("mysql:host=$dbhost;dbname=$dbName;charset=utf8", $dbUser, $dbpass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

}