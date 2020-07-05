<?php
/****************************************
 * @Project     : St Stephen Church 
 * @Version     :  1.0.0
 * @Author by	:  Antony Joseph
 * @Created Date : 18/11/2018
 * @modified by	: 
 * @modified date: 
 ****************************************/ 
 ?>
<?php 
ob_start();
session_start(); 
$sessionid=session_id();
if(isset($_SESSION['StStephenChurch_AdminUserData'])){
	header("Location:dashboard.php");
}
function __autoload($className){
	$className=strtolower($className);
	require_once "./classes/{$className}_class.php";
}
?>
<?php include_once("includes/utility.php"); 
$log=new Logging();
?>
<?php
$userName=$_POST["userId"];
$passwd=$_POST["password"];
$userServiceObj = new AdminUserService();
$userData = $userServiceObj->adminAuthenticate($userName,$passwd);
if($userData){
	$userId=$userData->getUserId();
	if($userData->getActivated()==1){
		$userServiceObj->addLoginActivity($userId,$sessionid);
		$_SESSION['StStephenChurch_admin_profilefoto']=$userData->getPhotoPath();
		$_SESSION['StStephenChurch_AdminUserData']=serialize($userData);
		if(isset($_REQUEST['remember_me'])){
			if($_REQUEST['remember_me']=="1")
				setcookie("auth", $userId, strtotime( '+90 days' ));
		}
		$log->debugLog("aaaaaaaaaaaa");
		header("Location:dashboard.php");
	}
	else{
		$_SESSION["ADMINLOGINALERT"]="Not activated";
		header("Location:login.php");
	}
}
else{
	header("Location:login.php?err=WRPAS");
		$_SESSION["ADMINLOGINALERT"]="ERROR||The Username or password you entered is incorrect";
	}
?>
<?php ob_flush(); ?>