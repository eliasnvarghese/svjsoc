<?php
function __autoload($className){
	$className=strtolower($className);
	require_once "./cmsapp/classes/{$className}_class.php";
}
require_once('./cmsapp/includes/utility.php'); 
$log=new Logging();
$regUserData = null;
$userName = "";
$uId = 0;
$userId = "";
$imageBasePath="adminapp/images/";
if(isset($_SESSION['StStephenChurch_RegUserData'])){
	$regUserData = unserialize($_SESSION['StStephenChurch_RegUserData']);
	$userName = strtolower($regUserData->getName());
	$uId = $regUserData->getUId();
	$userId = $regUserData->getUserId();
}
$pagename=basename(__FILE__);
$pagename=basename($_SERVER['PHP_SELF']);
if(isAuthenticationRequired($pagename)){
	if($regUserData==null){
		header("Location:login.php");
		exit();
	}
}

function isAuthenticationRequired($pagename){
	$pagename_array = array(
			"videogallery.php",
			"photogallery.php",
			"directory.php",
			"member.php",
			"editmyaccount.php",
			"myaccount.php"
	);
	if (in_array($pagename, $pagename_array)) {
		return true;
	}
	return false;
}
?>