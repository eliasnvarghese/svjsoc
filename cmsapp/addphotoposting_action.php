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
$postingObj = new Posting();
if(isset($_POST["postingId"])){
	if(intval($_POST["postingId"])>0){
		$postingObj=$postingServiceObj->getPosting($_POST["postingId"]);
	}
}

/* To upload photo */
$photoTarget_path = "";
if(isset($_FILES['photoGallery']['name'])){
	$log->userLog("Photo uploading ". $_FILES['photoGallery']['type']);
	if($_FILES['photoGallery']['type'] == 'image/pjpeg' ||
		$_FILES['photoGallery']['type'] == 'image/jpeg' || 
		$_FILES['photoGallery']['type'] == 'image/gif' ||
		$_FILES['photoGallery']['type'] == 'image/x-png' ||	
		$_FILES['photoGallery']['type'] == 'image/png')
	{
		$photoTarget_path = "uploads/gallery/";
		if(!is_dir($photoTarget_path)){
			makeDirectory($photoTarget_path);
			if(!is_dir($photoTarget_path)){
				echo "Can't create folder";
				exit();
			}
		}
		$milliseconds = round(microtime(true) * 1000);
		$fileName="_pic".$_FILES['photoGallery']['name'];
		$photoTarget_path = $photoTarget_path.basename($fileName);
		$photoTarget_path=str_replace(' ','_',$photoTarget_path);

		if(move_uploaded_file($_FILES['photoGallery']['tmp_name'],$photoTarget_path)){	
			$log->userLog("Photo uploading success!!!" );		
			$postingObj->setContentType("Image");
			$postingObj->setImageType($_FILES['photoGallery']['type']);
			$postingObj->setImagePath($fileName);			
		}else{
			$log->userLog("Photo uploading failed!!!" );
			echo "not saved"; 
		}
	}
}
$postingObj->setTitle($_POST["contentTitle"]);
$postingObj->setDescription($_POST["contentDesc"]);

if($postingObj->getPostingId()==0)
	$stat = $postingServiceObj->addPosting($postingObj);
else if($postingObj->getPostingId()>0)
	$stat = $postingServiceObj->updatePosting($postingObj);
if($stat>0)
	header('location:addphotogallery.php?stat=success');	
else
	header('location:addphotogallery.php?stat=failed');
?>
<?php ob_flush(); ?>