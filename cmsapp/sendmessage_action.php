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

$regUId=$_REQUEST["regUId"];
$regUserId=$_REQUEST["regUserId"];

$messageServiceObj=new MessageService();

$log = new Logging();
$error="";

$messageObj = new Message();
$messageObj->setToUid($regUId);
$messageObj->setToAddress($regUserId);
$messageObj->setFromUid("churchteam");
$messageObj->setFromAddress("churchteam");
$messageObj->setSubject($_POST["subject"]);
$messageObj->setMessage($_POST["message"]);

$status = $messageServiceObj->addMessage($messageObj);
if($stat>0)
		header('location:reguserview.php?uid='.$regUId.'&stat=success');	
else
		header('location:reguserview.php?uid='.$regUId.'&stat=failed');
?>
<?php ob_flush(); ?>