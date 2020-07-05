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

$postingServiceObj=new PostingService();

$log = new Logging();
$error="";
$log->userLog("Video url posting ");

$url=$_REQUEST['txtVideoUrl'];
$title=$_REQUEST['txtVideoTitle'];

$postingObj=new Posting();
$postingObj->setContentType("Video");
$postingObj->setVideoUrl($url);
$postingObj->setTitle($title);
$postingObj->setDescription($_REQUEST['txtVideoDescription']);
if(isset($_POST["postingId"])){
	if(intval($_POST["postingId"])>0){
		$postingObj->setPostingId($_POST["postingId"]);
	}
}
if($postingObj->getPostingId()==0)
	$stat=$postingServiceObj->addPosting($postingObj);
else if($postingObj->getPostingId()>0)
	$stat=$postingServiceObj->updatePosting($postingObj);
if($stat>0)
	header('location:addvideogallery.php?stat=success');	
else
	header('location:addvideogallery.php?stat=failed');
?>
<?php ob_flush(); ?>