<?PHP

if($page == "agenda"){
	require 'PHP_PRES/agenda.php';
	
}
else if($page == "aboutUs"){
	require 'PHP_PRES/aboutUs.php';
	
}
else if($page == "contactUs"){
	require 'PHP_PRES/contactUs.php';
	
}
else if($page == "googlePlay"){
	require 'PHP_PRES/googlePlay.php';
}
else{
	require 'PHP_PRES/home.php';
}

?>
