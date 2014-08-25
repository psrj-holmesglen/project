<?PHP
//
// This script switches the correct content into the content div depending on the $page variable.
//

if($page == "conference"){
	switch($action) {
	case "view":
		require 'PHP_PRES/conferences/view.php';
		break;
	case "edit":
		require 'PHP_PRES/conferences/edit.php';
		break;
	case "add":
		require 'PHP_PRES/conferences/add.php';
		break;
	case "delete":
		require 'PHP_PRES/conferences/delete.php';
		break;
    case "cloneView":
        require 'PHP_PRES/conferences/cloneView.php';
        break;
    case "clone":
        require 'PHP_PRES/conferences/clone.php';
	}
}
else if($page == "section"){
	switch($action) {
	case "view":
		require 'PHP_PRES/sections/view.php';
		break;
	case "edit":
		require 'PHP_PRES/sections/edit.php';
		break;
	case "add":
		require 'PHP_PRES/sections/add.php';
		break;
	case "delete":
		require 'PHP_PRES/sections/delete.php';
		break;
	}
}
else if($page == "session"){
	switch($action) {
	case "view":
		require 'PHP_PRES/session/view.php';
		break;
	case "edit":
		require 'PHP_PRES/session/edit.php';
		break;
	case "add":
		require 'PHP_PRES/session/add.php';
		break;
	case "delete":
		require 'PHP_PRES/session/delete.php';
		break;
	}
}
else if($page == "presenter"){
	switch($action) {
	case "view":
		require 'PHP_PRES/presenters/view.php';
		break;
	case "edit":
		require 'PHP_PRES/presenters/edit.php';
		break;
	case "add":
		require 'PHP_PRES/presenters/add.php';
		break;
	case "delete":
		require 'PHP_PRES/presenters/delete.php';
		break;
	}
}
//================================ CHANGED ===================================//
else if($page == "polling_question")
{
	switch($action) {
	case "view":
		require 'PHP_PRES/polling_question/view.php';
		break;
	case "edit":	
		require 'PHP_PRES/polling_question/edit.php';
		break;
	case "add":
		require 'PHP_PRES/polling_question/add.php';
		break;
	case "delete":
		require 'PHP_PRES/polling_question/delete.php';
		break;	
	}	
}
//================================ END CHANGED ===================================//
else if($page == "attendee_profile"){
	switch($action) {
	case "view":
		require 'PHP_PRES/attendee_profile/view.php';
		break;
	case "edit":
		require 'PHP_PRES/attendee_profile/edit.php';
		break;
	case "add":
		require 'PHP_PRES/attendee_profile/add.php';
		break;
	case "delete":
		require 'PHP_PRES/attendee_profile/delete.php';
		break;
	}
}
else if($page == "user"){
	switch($action) {
	case "view":
		require 'PHP_PRES/users/view.php';
		break;
	case "edit":
		require 'PHP_PRES/users/edit.php';
		break;
	case "add":
		require 'PHP_PRES/users/add.php';
		break;
	case "delete":
		require 'PHP_PRES/users/delete.php';
		break;
	}
}
else if($page == "feedback_question")
{
	switch($action) {
	case "view":
		require 'PHP_PRES/feedback_question/view.php';
		break;
	case "edit":	
		require 'PHP_PRES/feedback_question/edit.php';
		break;
	case "add":
		require 'PHP_PRES/feedback_question/add.php';
		break;
	}	
}
else if($page == "home"){
	require 'PHP_PRES/home.php';
}
?>
