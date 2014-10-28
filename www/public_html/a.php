<?php
//	$host = local;	//http://localhost/a.php
	$host = external;	//http://econference.holmesglenmobileapps.com/a.php

	$getSql = "SELECT * From conference_fb_section";
	get($getSql);
		
	
	
	$updateSql="UPDATE conference_fb_section SET Conference =  3 WHERE Feedback_Section = 16";
	//update($updateSql);
	
	
	

function get($getSql){
	global $host;
	
	try{
			// encapsulate connection stuff in a function
			$db = getConnection($host);
			$stmt=$db->prepare($getSql);
			$stmt->execute();
			$db = null;
			$row=$stmt->fetchAll(PDO::FETCH_OBJ);
			
			//echo json_encode($row);
			echo json_encode($row,JSON_PRETTY_PRINT);
			
		}
	catch(PDOException $e){
			echo $e->getMessage();
	}
}

function update($updateSql){
	global $host;
	try{
			$db = getConnection($host);
			$stmt=$db->prepare($updateSql);
			$stmt->execute();
			$db = null;
			
			//$row=$stmt->fetchAll(PDO::FETCH_OBJ);
			$dbh=null;
			echo "\nUPDATED";
			//echo json_encode($row,JSON_PRETTY_PRINT);
			
		}
	catch(PDOException $e){
			echo $e->getMessage();
	}
}



// function to make database connection
function getConnection($host){
	// Connection details
	
	if($host == local){
		$dbhost="localhost";
		$dbUser="root";
		$dbpass="root";
		$dbName="holmesglen_project";
	}
	else{
		$dbhost="localhost";
		$dbUser="eConference_user";
		$dbpass="UewSLJMV3r%m";
		$dbName="eConference";
	}
	
	try{
		$dbh = new PDO("mysql:host=$dbhost;dbname=$dbName",$dbUser,$dbpass);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $dbh;
	}
	catch(PDOException $e){
		echo "Error PDO Exception";
	}
} // end database connection function


?>