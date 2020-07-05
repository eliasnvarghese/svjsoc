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

$instId=$_REQUEST["pinstId"];
$universityServiceObj=new UniversityService();
$instGalleryServiceObj=new InstGalleryService();
$universityObj=$universityServiceObj->getUniversity($instId);

$log = new Logging();
$error="";
$galleryObj = new InstGallery();
if(isset($_POST["imageId"])){
	if(intval($_POST["imageId"])>0){
		$galleryObj=$instGalleryServiceObj->getImage($_POST["imageId"]);
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
		$photoTarget_path = "images/university/".trim($instId)."/gallery/";
		if(!is_dir($photoTarget_path)){
			makeDirectory($photoTarget_path);
			if(!is_dir($photoTarget_path)){
				echo "Can't create folder";
				exit();
			}
		}
		$milliseconds = round(microtime(true) * 1000);
		$fileName=$instId."_gal_".$_FILES['photoGallery']['name'];
		$photoTarget_path = $photoTarget_path.basename($fileName);
		$photoTarget_path=str_replace(' ','_',$photoTarget_path);

		if(move_uploaded_file($_FILES['photoGallery']['tmp_name'],$photoTarget_path)){	
			$log->userLog("Photo uploading success!!!" );		
			$galleryObj->setImageType($_FILES['photoGallery']['type']);
			$galleryObj->setFileName($fileName);			
		}else{
			$log->userLog("Photo uploading failed!!!" );
			echo "not saved"; 
		}
	}
}
$galleryObj->setInst_Id($instId);
$galleryObj->setTitle($_POST["contentTitle"]);
$galleryObj->setDescription($_POST["contentDesc"]);

if($galleryObj->getImageId()==0)
	$stat = $instGalleryServiceObj->addGallery($galleryObj);
else if($galleryObj->getImageId()>0)
	$stat = $instGalleryServiceObj->updateGallery($galleryObj);
if($stat>0)
	header('location:edituniversity.php?instId='.$instId.'&imgstat=success');	
else
	header('location:edituniversity.php?instId='.$instId.'&imgstat=failed');
?>
<?php ob_flush(); ?>