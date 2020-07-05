<?php ob_start(); ?>
<?php session_start() ?>
<?php 
include("includes/usercredentials.php");

$regUId=$_REQUEST["regUId"];
$regUserId=$_REQUEST["regUserId"];

$messageServiceObj=new MessageService();

$log = new Logging();
$error="";

$messageObj = new Message();
$messageObj->setFromUid($regUId);
$messageObj->setFromAddress($regUserId);
$messageObj->setToUid("churchteam");
$messageObj->setToAddress("churchteam");
$messageObj->setSubject($_POST["subject"]);
$messageObj->setMessage($_POST["message"]);

$status = $messageServiceObj->addMessage($messageObj);
if($stat>0)
		header('location:myaccount.php?stat=success');	
else
		header('location:myaccount.php?stat=failed');
?>
<?php ob_flush(); ?>