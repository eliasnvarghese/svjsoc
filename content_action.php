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
include("includes/usercredentials.php");

$log = new Logging();
$regUId=$uId;
$form=isset($_POST['form']) ? $_POST['form'] : "";
$formaction=isset($_POST['formaction']) ? $_POST['formaction'] : "";
if($form=="reguser"){
	$regUserServiceObj= new RegUserService();
	if($formaction=="update"){
		$userAccount = new RegUserAccount();
		$userAccount=$regUserServiceObj->getUserAccountByUId($regUId);
		$userAccount->setUserId($_POST['UserId']);
		$userAccount->setName($_POST["Name"]);
		$userAccount->setFamilyName($_POST["FamilyName"]);
		$userAccount->setGender($_POST["Gender"]);
		$userAccount->setDOB($_POST["Dob"]);
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
				$target_path = "cmsapp/uploads/user/";
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
			header('location:myaccount.php?editstat=success');
		}catch(Exception $e){
			header('location:myaccount.php?editstat=fail');  
			exit();
		}		
	}	
	else{
		header('location:myaccount.php');
	}
}
else if($form=="member"){
	$log->debugLog("member");
	$regUserServiceObj= new RegUserService();
	if($formaction=="add"){
		$log->debugLog("member add ");
		$otherMemberObj=new OtherMember();
		$otherMemberObj->setUId($regUId);
		$otherMemberObj->setName($_POST['OthMemberName']);
		$otherMemberObj->setGender($_POST['OthMemberGender']);
		$otherMemberObj->setDob($_POST['OthMemberDob']);
		$otherMemberObj->setRelation($_POST['OthMemberReln']);
		$regUserServiceObj->addMember($otherMemberObj);
	
		header('location:addmymember.php');
	}
	else if($formaction=="update"){
		$log->debugLog("update");
		$otherMemberObj=new OtherMember();
		$otherMemberObj->setUId($regUId);
		$otherMemberObj->setMemberId($_POST['memberId']);
		$otherMemberObj->setName($_POST['OthMemberName']);
		$otherMemberObj->setGender($_POST['OthMemberGender']);
		$otherMemberObj->setDob($_POST['OthMemberDob']);
		$otherMemberObj->setRelation($_POST['OthMemberReln']);
		$regUserServiceObj->updateMember($otherMemberObj);

		header('location:addmymember.php');
	}	
	else if($formaction=="del"){
		$log->debugLog("delete");
		$regUserServiceObj->deleteMember($regUId,$_POST['memberId']);
		header('location:addmymember.php');
	}
	else{
		header('location:addmymember.php');
	}
}
else{
	header('location:myaccount.php?stat=success');
}
?>
<?php ob_flush(); ?>