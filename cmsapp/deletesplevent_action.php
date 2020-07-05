<?php
/****************************************
 * @Project     : St Stephen Church
 * @Version     :  1.0.0
 * @Author by	:  Antony Joseph
 * @Created Date : 16/11/2018
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
$eventId = $_POST['eventId'];

$eventServiceObj = new SpecialEventService();
if(!isset($eventId)){
	header('location:listofsplevents.php');  
	exit();
}
try{
	if(!$eventServiceObj->isEventIdExists($eventId)){
		header('location:listofsplevents.php?eventId='.$eventId.'&stat=fail');  
		exit();
	}
	$stat = $eventServiceObj->deleteEvent($eventId);
	if($eventId >0 && $stat > 0){
		$target_path="uploads/splevents/";
		$target_path = $target_path.basename($eventId.".jpg");
		if(file_exists ($target_path)){
			if(unlink($target_path)){
				$log->userLog("Event photo deleting success!!!".$target_path );		
			}
			else{
				$log->userLog("Event photo deleting failed!!!".$target_path );
			}
		}
	}
	header('location:listofsplevents.php?eventId='.$eventId.'&stat=deleted');  
}catch(Exception $e){
	header('location:listofsplevents.php?eventId='.$eventId.'&stat=fail');  
	exit();
}
?>
<?php ob_flush(); ?>