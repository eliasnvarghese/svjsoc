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
include_once("./includes/utility.php"); ?>
<?php
$log = new Logging();
$userData = unserialize($_SESSION['StStephenChurch_AdminUserData']);
$userId = $userData->getUserName();
$form=isset($_POST['form']) ? $_POST['form'] : "";
$formaction=isset($_POST['formaction']) ? $_POST['formaction'] : "";
if($form=="gospel"){
	$cmServiceObj = new ContentManagementService();
	if($formaction=="add"){
		try{
			$id = $cmServiceObj->addGospel($_POST['Gospel'],$_POST['BookOf']);
			header('location:addgospel.php?stat=success');
		}catch(Exception $e){
			header('location:addgospel.php?stat=fail');  
			exit();
		}
	}
	else if($formaction=="update"){
		try{
			$id = $cmServiceObj->updateGospel($_POST['GospelId'],$_POST['Gospel'],$_POST['BookOf']);
			header('location:addgospel.php?stat=success');
		}catch(Exception $e){
			header('location:addgospel.php?stat=fail');  
			exit();
		}
	}	
	else if($formaction=="delete"){
		try{
			$id = $cmServiceObj->deleteGospel($_POST['GospelId']);
			header('location:addgospel.php?stat=success');
		}catch(Exception $e){
			header('location:addgospel.php?stat=fail');  
			exit();
		}
	}
	else{
		header('location:addgospel.php');
	}
}
else if($form=="reguser"){
	$regUserServiceObj= new RegUserService();
	if($formaction=="add"){
	
		$userAccount = new RegUserAccount();
		$userAccount->setUserId($_POST['UserId']);
		$userAccount->setPasswd($_POST["Password"]);
		$userAccount->setName($_POST["Name"]);
		$userAccount->setFamilyName($_POST["FamilyName"]);
		$userAccount->setGender($_POST["Gender"]);
		$userAccount->setDOB(convertFromUserDateToYmd($_POST["Dob"]));
		$userAccount->setMaritalStatus($_POST["MaritalStatus"]);
		$userAccount->setSpouseName($_POST["SpouseName"]);
		$userAccount->setFullAddress($_POST["Address"]);
		$userAccount->setCity($_POST["City"]);
		$userAccount->setState($_POST["State"]);
		$userAccount->setMobileNumber($_POST["Mobile"]);
		$userAccount->setPhoneNumber($_POST["Phone"]);
		$userAccount->setEmail($_POST['UserId']);
		$userAccount->setAboutMe($_POST["About"]);
		$userAccount->setAboutFamily($_POST["AboutFamily"]);

		try{
			$id = $regUserServiceObj->addUser($userAccount);
			$log->userLog("Profile photo uploading ". $_FILES['PhotoPath']['type']);
			$target_path = "";
			if($_FILES['PhotoPath']['type'] == 'image/pjpeg' ||
				$_FILES['PhotoPath']['type'] == 'image/jpeg' || 
				$_FILES['PhotoPath']['type'] == 'image/gif' ||
				$_FILES['PhotoPath']['type'] == 'image/x-png' ||	
				$_FILES['PhotoPath']['type'] == 'image/png')
			{
				$target_path = "uploads/user/";
				if(!is_dir($target_path)){
					makeDirectory($target_path);
					if(!is_dir($target_path)){
						echo "Can't create folder";
						exit();
					}
				}
				$target_path = $target_path.$id.".jpg";
				if(move_uploaded_file($_FILES['PhotoPath']['tmp_name'],$target_path)){	
					$log->userLog("User Profile photo uploading success!!!".$target_path );		
				}
				else{
					$log->userLog("User Profile photo uploading failed!!!" );
				}
			}
			header('location:addreguser.php?stat=success');
		}catch(Exception $e){
			header('location:addreguser.php?stat=fail');  
			exit();
		}
	}
	else if($formaction=="update"){
		$userAccount = new RegUserAccount();
		$regUId=$_POST['regUId'];
		$userAccount=$regUserServiceObj->getUserAccountByUId($regUId);
		$userAccount->setUserId($_POST['regUId']);
		$userAccount->setUserId($_POST['UserId']);
		$userAccount->setName($_POST["Name"]);
		$userAccount->setFamilyName($_POST["FamilyName"]);
		$userAccount->setGender($_POST["Gender"]);
		$userAccount->setDOB(convertFromUserDateToYmd($_POST["Dob"]));
		$userAccount->setMaritalStatus($_POST["MaritalStatus"]);
		$userAccount->setSpouseName($_POST["SpouseName"]);
		$userAccount->setFullAddress($_POST["Address"]);
		$userAccount->setCity($_POST["City"]);
		$userAccount->setState($_POST["State"]);
		$userAccount->setMobileNumber($_POST["Mobile"]);
		$userAccount->setPhoneNumber($_POST["Phone"]);
		$userAccount->setEmail($_POST['UserId']);
		$userAccount->setAboutMe($_POST["About"]);
		$userAccount->setAboutFamily($_POST["AboutFamily"]);

	
		try{
			$stat = $regUserServiceObj->updateUser($userAccount);
			$log->userLog("Profile photo uploading ". $_FILES['PhotoPath']['type']);
			$target_path = "";
			if($_FILES['PhotoPath']['type'] == 'image/pjpeg' ||
				$_FILES['PhotoPath']['type'] == 'image/jpeg' || 
				$_FILES['PhotoPath']['type'] == 'image/gif' ||
				$_FILES['PhotoPath']['type'] == 'image/x-png' ||	
				$_FILES['PhotoPath']['type'] == 'image/png')
			{
				$target_path = "uploads/user/";
				if(!is_dir($target_path)){
					makeDirectory($target_path);
					if(!is_dir($target_path)){
						echo "Can't create folder";
						exit();
					}
				}
				$target_path = $target_path.$regUId.".jpg";
				if(move_uploaded_file($_FILES['PhotoPath']['tmp_name'],$target_path)){	
					$log->userLog("User Profile photo uploading success!!!".$target_path );		
				}
				else{
					$log->userLog("User Profile photo uploading failed!!!" );
				}
			}
			header('location:addreguser.php?editstat=success');
		}catch(Exception $e){
			header('location:addreguser.php?editstat=fail');  
			exit();
		}		
	}	
	else if($formaction=="delete"){
		
	}
	else{
		header('location:addreguser.php');
	}
}
else if($form=="member"){
	$log->debugLog("member");
	$regUserServiceObj= new RegUserService();
	if($formaction=="add"){
		$log->debugLog("member add ");
		$otherMemberObj=new OtherMember();
		$otherMemberObj->setUId($_POST['regUId']);
		$otherMemberObj->setName($_POST['OthMemberName']);
		$otherMemberObj->setGender($_POST['OthMemberGender']);
		$otherMemberObj->setDob(convertFromUserDateToYmd($_POST["OthMemberDob"]));
		$otherMemberObj->setRelation($_POST['OthMemberReln']);
		$regUserServiceObj->addMember($otherMemberObj);
	
		header('location:addmember.php?uid='.$otherMemberObj->getUId());
	}
	else if($formaction=="update"){
		$log->debugLog("update");
		$otherMemberObj=new OtherMember();
		$otherMemberObj->setUId($_POST['regUId']);
		$otherMemberObj->setMemberId($_POST['memberId']);
		$otherMemberObj->setName($_POST['OthMemberName']);
		$otherMemberObj->setGender($_POST['OthMemberGender']);
		$otherMemberObj->setDob(convertFromUserDateToYmd($_POST["OthMemberDob"]));
		$otherMemberObj->setRelation($_POST['OthMemberReln']);
		$regUserServiceObj->updateMember($otherMemberObj);

		header('location:addmember.php?uid='.$otherMemberObj->getUId());
	}	
	else if($formaction=="del"){
		$log->debugLog("delete");
		$regUserServiceObj->deleteMember($_POST['regUId'],$_POST['memberId']);
		header('location:addmember.php?uid='.$_POST['regUId']);
	}
	else{
		header('location:addmember.php?uid='.$_POST['regUId']);
	}
}
else{
	header('location:index.php?stat=success');
}
?>
<?php ob_flush(); ?>