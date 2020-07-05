<?php 
ob_start();
session_start(); 
$sessionid=session_id();
if(!isset($_SESSION['StStephenChurch_AdminUserData'])){
	header("Location:login.php");
	exit();
}
function __autoload($className){
	$className=strtolower($className);
	require_once "./classes/{$className}_class.php";
}
require_once("includes/utility.php"); 

$act=$_REQUEST["act"];
switch($act)
{
	case "deletePosting":
	{
		$log=new Logging();
		$postingId = $_REQUEST['postingId'];
		$log->debugLog("deletePosting -> postingId="+$postingId);
	
		$postingServiceObj=new PostingService();
		try{
			$stat = $postingServiceObj->deletePosting($postingId);
		}catch(Exception $e){
			echo "error";
			exit();
		}
		if($stat>0)
			echo "success";
		else 
			echo "failed";
		exit();
	}break;	
}

?>