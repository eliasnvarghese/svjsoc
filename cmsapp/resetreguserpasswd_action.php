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
$regUId=$_POST["UId"];
	$regUserServiceObj = new RegUserService();
	$userAccount = $regUserServiceObj->getUserAccountByUId($regUId);
	
	if($userAccount==null){
		header("Location:login.php");
	}
	if($_POST["newPswd"]==$_POST["cnfPswd"]){
		$stat = $regUserServiceObj->resetPassword($userAccount->getUserId(),$_REQUEST["newPswd"]);
	}
	else{
		$log->debugLog("Errrrr passwd not matching...");
		$_SESSION["changePaswdError"]="Confirm Password mismatching!";	
		header('location:resetreguserpasswd.php?uid='.$regUId.'&stat=mismatching');		
	}
	if($stat>0){
		$_SESSION["changePaswdError"]="Password changed successfully!";		
		header('location:resetreguserpasswd.php?uid='.$regUId.'&stat=success');
	}
	else{
		$_SESSION["changePaswdError"]="*Failed to change Password";		
		header('location:resetreguserpasswd.php?uid='.$regUId.'&stat=failed');
	}
	
?>
<?php ob_flush(); ?>