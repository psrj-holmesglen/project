<?
	
	public static $localhost = "localhost";
    public static $db = "eConference";
    public static $user = "eConference_user";
	public static $password = "UewSLJMV3r%m";

	$connect = mysql_connect($localhost,$user,$password)or die(mysql_error());
	mysql_select_db($db);
	mysql_set_charset("utf8");
	
	var_dump($connect);

	//echo "connected: " . $connect; 

	//SQL change
	//Alter table
	//$query = mysql_query("ALTER TABLE session ALTER COLUMN feedback smallint NULL") or die(mysql_error());

	//$query = mysql_query("Select * from session") or die(mysql_error());
	//$query = mysql_query("UPDATE conference set Download_Avail = 1") or die(mysql_error());
	//echo var_dump($query);
	//echo "Query: " . $query;


?>