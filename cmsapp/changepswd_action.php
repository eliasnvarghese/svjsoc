<?php
/****************************************
 * @Project     : St Stephen Church
 * @Version     :  1.0.0
 * @Author by	:  Antony Joseph
 * @Created Date :18/11/2018
 * @modified by	: 
 * @modified date: 
 ****************************************/ 
 ?>
<?php 
ob_start();
session_start(); 
$sessionid=session_id();
if(!isset($_SESSION['StStephenChurch_AdminUserData'])){
	header("Location:login.php");
}
function __autoload($className){
	$className=strtolower($className);
	require_once "./classes/{$className}_class.php";
}
 include_once("includes/utility.php"); 
$log=new Logging();
 ?>
<?php
if(!isset($_SESSION['StStephenChurch_AdminUserData']))
{
	header("Location:login.php");
}
$userData = unserialize($_SESSION['StStephenChurch_AdminUserData']);
$userId = $userData->getUserId();

	$userServiceObj = new AdminUserService();
	$userAccount = $userServiceObj->getUserByUserId($userId);
	
	if($userAccount==null)
	{
		header("Location:login.php");
	}

	$oldPaswd = $_REQUEST["oldPswd"];	
	if(encrypt($oldPaswd,$userAccount->getSaltKey()) == $userAccount->getPasswd()){	
		$stat = $userServiceObj->changePassword($userId,encrypt($oldPaswd,$userAccount->getSaltKey()),$_REQUEST["newPswd"]);
	}
	else{
		$log->debugLog("Errrrr passwd not matching...");
	}
	if($stat>0)
		header('location:addadminuser.php?stat=change password success');
	else{
		$_SESSION["changePaswdError"]="*Failed to change Password";		
		header('location:changepassword.php?stat=failed to change password');
	}
	
?>
<?php ob_flush(); ?>