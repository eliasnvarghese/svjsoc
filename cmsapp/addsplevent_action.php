<?php
/****************************************
 * @Project     : St Stephen Church
 * @Version     :  1.0.0
 * @Author by	:  Antony Joseph
 * @Created Date : 13/11/2018
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
include_once("includes/utility.php"); ?>
<?php

$log = new Logging();
$userData = unserialize($_SESSION['StStephenChurch_AdminUserData']);
$userId = $userData->getUserName();

$target_path="";
	
$eventObj = new Event();
$eventObj->setEventName($_POST['EventName']);
$eventObj->setEventDetails($_POST['EventDetails']);
$eventObj->setHighlights($_POST['Highlights']);
$eventObj->setFromDate($_POST['FromDate']);
$eventObj->setToDate($_POST['ToDate']);
$eventObj->setCreatedby($userId);

$eventServiceObj = new SpecialEventService();

if(!isValidDateRange($_POST['FromDate'],$_POST['ToDate']))
{
	header('location:addsplevent.php?stat=fail&err=Invalid Date Range!');  
	exit();
}

try{
	if($eventServiceObj->isEventExists(0,$eventObj->getFromDate(),$eventObj->getToDate()))
	{
		header('location:addsplevent.php?stat=fail');  
		exit();
	}
	$EventId = $eventServiceObj->addEvent($eventObj);
}catch(Exception $e){
	header('location:addsplevent.php?stat=fail');  
	exit();
}
if($EventId >0){
	if($_FILES['PhotoPath']['type'] == 'image/pjpeg' ||
		$_FILES['PhotoPath']['type'] == 'image/jpeg' || 
		$_FILES['PhotoPath']['type'] == 'image/gif' ||
		$_FILES['PhotoPath']['type'] == 'image/x-png' ||
		$_FILES['PhotoPath']['type'] == 'image/png')
	{
		$log->userLog("Event Cover photo uploading ....11!!!".$_FILES['PhotoPath']['tmp_name'] );	
		$target_path="uploads/splevents/";
		$isFolder=true;
		if(!is_dir($target_path)){
			makeDirectory($target_path);
			if(!is_dir($target_path)){
				$log->debugLog("Can't Create Folder!!!".$target_path );	
				$isFolder=false;
			}
		}
		if($isFolder){
			$milliseconds = round(microtime(true) * 1000);
			$target_path = $target_path.basename($EventId.".jpg");
			$target_path=str_replace(' ','_',$target_path);
			if(move_uploaded_file($_FILES['PhotoPath']['tmp_name'],$target_path)){
				$log->userLog("Event Cover photo uploading success!!!".$target_path );		
			}
			else{
				$log->userLog("Event Cover photo uploading failed!!!".$target_path );
			}
		}
		else{
			$log->userLog("Event Cover photo uploading failed!!!".$target_path );
		}
	}
	header('location:addsplevent.php?stat=success');
}
else
	header('location:addsplevent.php?stat=fail');  
?>
<?php ob_flush(); ?>