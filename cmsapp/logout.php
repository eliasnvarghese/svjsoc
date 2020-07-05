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
<?php ob_start(); 
session_start(); 
//session_destroy();
$sessionid=session_id();
?>
<?php
function __autoload($className){
	$className=strtolower($className);
	require_once "./classes/{$className}_class.php";
}
?>
<?php include_once("includes/utility.php"); ?>
<?php
	
	if(isset($_SESSION['StStephenChurch_AdminUserData']))
	{
		$userData=unserialize($_SESSION['StStephenChurch_AdminUserData']);
		$userId = $userData->getUserId();
	}
	$userServiceObj = new AdminUserService();
	$userServiceObj->removeLoginActivity($userId,$sessionid);
	removeUserCred();
	$log = new Logging();
	$log->userLog("User Logged Out!!!");
	//session_destroy();
	$_SESSION['StStephenChurch_AdminUserData']=NULL;
	unset($_SESSION['StStephenChurch_AdminUserData']);

	header("Location:login.php");
	function removeUserCred()
	{
		if(isset($_SESSION['StStephenChurch_AdminUserData']))
		{
			if($_SESSION['StStephenChurch_AdminUserData']!=NULL)
			{
				$userData = unserialize($_SESSION['StStephenChurch_AdminUserData']);
				//$fp = fopen("userlogdata/".strtolower($userId) . '.xml', 'w') or exit("Can't open $lfile!");
				//unlink("userlogdata/".strtolower($userData->getUserId()) . '.xml');
			}
		}
	}
	
?>
<?php ob_flush(); ?>
