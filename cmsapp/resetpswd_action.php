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
$log->debugLog("aaaaaaaaaaaaaaa");
 ?>
<?php

$userData = unserialize($_SESSION['StStephenChurch_AdminUserData']);
$userId = $userData->getUserId();
$uId=$_POST["UId"];
	$oldPaswd = $_POST["oldPswd"];	
	
	$userServiceObj = new AdminUserService();
	$userAccount = $userServiceObj->getUserByUid($uId);
	
	if($userAccount==null){
		header("Location:login.php");
	}
	$stat = 0;
	if($_POST["newPswd"]==$_POST["cnfPswd"]){
		$stat = $userServiceObj->resetPassword($userAccount->getUserId(),$_POST["newPswd"]);
	}
	else{
		$_SESSION["changePaswdError"]="Confirm Password Mismatch!";	
		header('location:resetpassword.php?uid='.$uId.'&stat=failed to change password');
	}
	if($stat>0){
		$_SESSION["changePaswdError"]="Password Changed Successfully";	
		header('location:resetpassword.php?uid='.$uId.'&stat=change password success');
	}
	else{
		$_SESSION["changePaswdError"]="*Failed to change Password";		
		header('location:resetpassword.php?uid='.$uId.'&stat=failed to change password');
	}
	
?>
<?php ob_flush(); ?>