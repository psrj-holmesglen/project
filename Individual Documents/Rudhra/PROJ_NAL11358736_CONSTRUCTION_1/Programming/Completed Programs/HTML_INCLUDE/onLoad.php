<?PHP
////
//// PHP Console Plugin
////

require_once('SCRIPTS_THIRD_PARTY/php-console-master/src/PhpConsole/__autoload.php');
$Console = PhpConsole\Handler::getInstance();
$Console->start();
//$Console->debug('called from handler debug', 'some.three.tags');

////
//// PHP Console Plugin End.
////

////
//// Sessions.
////

session_start();

$headerUserName = "";

// Session timeout code.
if (isset($_SESSION['lastActivity']) && (time() - $_SESSION['lastActivity'] > 1800)) {
    session_unset();
    session_destroy();
}
$_SESSION['lastActivity'] = time();

// Session authorise code.
if (isset($_SESSION["userFirstName"])) {
    $headerUserName = "" . $_SESSION["userFirstName"] . " " . $_SESSION["userLastName"];
	//The code is to restrict username to max of 20 characters- Rudhra
	$headerUserName = substr($headerUserName,0,20); 
	$accesslevel = $_SESSION["userAccessLevel"];
	$userid = $_SESSION["userID"];
	
} else {
    header("Location: PHP_LOGIN/login.php");
}

////
//// Sessions end.
////

// Set up our page identifier variable.
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = "home";
}
// Set up our page action variable.
if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = "view";
}






