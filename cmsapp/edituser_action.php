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
if(!isset($_SESSION['StStephenChurch_AdminUserData'])){
	header("Location:login.php");
}
function __autoload($className){
	$className=strtolower($className);
	require_once "./classes/{$className}_class.php";
}
?>
<?php include_once("includes/utility.php"); ?>
<?php
if(!isset($_SESSION['StStephenChurch_AdminUserData']))
{
	header("Location:login.php");
}
$userData = unserialize($_SESSION['StStephenChurch_AdminUserData']);
//$userId = $userData->getUserName();
$log = new Logging();
$error="";
$log->userLog("Profile photo uploading ". $_FILES['PhotoPath']['type']);
$target_path = "";
if($_FILES['PhotoPath']['type'] == 'image/pjpeg' ||
		$_FILES['PhotoPath']['type'] == 'image/jpeg' || 
		$_FILES['PhotoPath']['type'] == 'image/gif' ||
		$_FILES['PhotoPath']['type'] == 'image/x-png' ||	
		$_FILES['PhotoPath']['type'] == 'image/png')
	{
		$target_path = "uploads/".$_SESSION['edp_userData_ClientId']."/userprofile/";
		if(!is_dir($target_path)){
			if(!mkdir($target_path, 0777)){
				echo ("Couldn't create directory");
			}
		}
		$milliseconds = round(microtime(true) * 1000);
		$target_path = $target_path.basename($_REQUEST['UserId']."_pic".$_FILES['PhotoPath']['name']);
		$target_path=str_replace(' ','_',$target_path);
	}	
	
	$userAccount_obj=new AdminUserAccount();	
	$userAccount_obj->setUId($_REQUEST["uid"]);
	$userAccount_obj->setUserId($_REQUEST["UserId"]);	
	$userAccount_obj->setFirstName($_REQUEST["Name"]);
	$userAccount_obj->setCity($_REQUEST["Place"]);
	$userAccount_obj->setPhotoPath($target_path);	
	//$userAccount_obj->setCreatedBy($userId);
	$userAccount_obj->setMobileNumber($_REQUEST["Mobile"]);

	$userService_obj = new AdminUserService();
	$error_array =array();
	if($_REQUEST["UserId"] != $_REQUEST["emailid"]){
		$stat = $userService_obj->isUserExists($_REQUEST["UserId"]);
	}
	if($stat==1)
	{
		$_SESSION["adduserError"]="*Username Already Exists";
		header("Location:addadminuser.php?stat=user name exists");
	}
	else
	{
	
		$userService_obj->updateUser($userAccount_obj);
		if($target_path!="")
		{
			if(move_uploaded_file($_FILES['PhotoPath']['tmp_name'],$target_path))
			{	
				$log->userLog("User Profile photo uploading success!!!" );		
			}
			else
			{
				$log->userLog("User Profile photo uploading failed!!!" );
				echo "not saved"; 
			}
		}
		header("Location:addadminuser.php");
	}
?>
<?php ob_flush(); ?>