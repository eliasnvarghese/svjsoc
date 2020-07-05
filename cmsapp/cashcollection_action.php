<?php
/****************************************
 * @Project     : St. StStephenChurch
 * @Version     :  1.0.0
 * @Author by	:  Antony
 * @Created Date : 8/12/2018
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
	exit();
}
function __autoload($className){
	$className=strtolower($className);
	require_once "./classes/{$className}_class.php";
}
require_once("includes/utility.php"); 
$log=new Logging();

?>
<?php
	$createdby ='' ;
	$paymentServiceObj=new PaymentService();
	$formaction=isset($_POST['formaction']) ? $_POST['formaction'] : "";
	$uId=$_POST['uid'];
	$rectId=$_POST['rectId'];
	$rectdate=convertFromUserDateToYmd($_POST['rectDate']);
	$category= $_POST['Category'];
	$rectdetls=$_POST['Narration'];
	$rectamount= $_POST['Amount'];
	$UserId=$Name="";	
	$regUserServiceObj= new RegUserService();
	$userAccount=$regUserServiceObj->getUserAccountByUId($uId);
	if($userAccount!=null){
		$UserId=$userAccount->getUserId();
		$Name=$userAccount->getName();
	}	
	else{
		header('location:cashcollection.php?uid='.$uId.'&stat=failed');
		exit();
	}	
	if($formaction=="add"){
		$rectId = $paymentServiceObj->add($uId, $rectdate, $category, $rectdetls, $rectamount, $createdby);
		$log->debugLog("......herere....".$rectId);
		$mailSenderService=new MailSenderService();
		if($mailSenderService->sendReceiptMail($uId,$rectId,$UserId,$Name))
		{
		}
		if($rectId>0)
			header('location:cashcollection.php?uid='.$uId.'&stat=saved');
		else
			header('location:cashcollection.php?uid='.$uId.'&stat=savfailed');
		exit();
	}
	else if($formaction=="update"){
		$stat = $paymentServiceObj->update($uId,$rectId, $rectdate,  $category, $rectdetls, $rectamount);
		if($stat>0)
			header('location:cashcollection.php?uid='.$uId.'&stat=updated');
		else
			header('location:cashcollection.php?uid='.$uId.'&stat=updfailed');	
		exit();
	}
	else if($formaction=="cancel"){
		$stat = $paymentServiceObj->cancelCashReceipt($uId,$rectId);
		if($stat>0)
			header('location:cashcollection.php?uid='.$uId.'&stat=cancelled');
		else
			header('location:cashcollection.php?uid='.$uId.'&stat=canfailed');
		exit();
	}
	else{
		header('location:cashcollection.php?uid='.$uId.'&stat=new');
	}
	
?>
<?php ob_flush(); ?>