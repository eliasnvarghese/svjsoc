<?php
/****************************************
 * @Project     : St. Stephen Church
 * @Version     :  1.0.0
 * @Author by	:  Antony Joseph
 * @Created Date : 23/11/2018
 * @modified by	: 
 * @modified date: 
 ****************************************/ 
 ?>
<?php ob_start(); 
session_start(); 
$sessionid=session_id();
?>
<?php
function __autoload($className){
	$className=strtolower($className);
	require_once "./cmsapp/classes/{$className}_class.php";
}
?>
<?php include_once("cmsapp/includes/utility.php"); ?>
<?php

setcookie("auth","",time()-60*60*24*30*12);
	//setcookie('auth', '', 1,'/');   
	if(isset($_SESSION['StStephenChurch_RegUserData']))
	{
		$userData=unserialize($_SESSION['StStephenChurch_RegUserData']);
		$userId = $userData->getUserId();
	}
	$userServiceObj = new RegUserService();
	$userServiceObj->removeLoginActivity($userId,$sessionid);
	removeUserCred();
	$log = new Logging();
	$log->userLog("User Logged Out!!!");
	//session_destroy();
	$_SESSION['StStephenChurch_RegUserData']=NULL;
	unset($_SESSION['StStephenChurch_RegUserData']);

	header("Location:login.php");
	
	function removeUserCred()
	{
		if(isset($_SESSION['StStephenChurch_RegUserData'])){
			if($_SESSION['StStephenChurch_RegUserData']!=NULL)	{
				$userData = unserialize($_SESSION['StStephenChurch_RegUserData']);
				//$fp = fopen("userlogdata/".strtolower($userId) . '.xml', 'w') or exit("Can't open $lfile!");
				unlink("userlogdata/".strtolower($userData->getUserId()) . '.xml');
			}
		}
	}
	
?>

<?php ob_flush(); ?>
