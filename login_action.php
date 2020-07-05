<?php
/****************************************
 * @Project     : St.Stephen Church
 * @Version     :  1.0.0
 * @Author by	:  Antony Joseph
 * @Created Date : 23/11/2018
 * @modified by	: 
 * @modified date: 
 ****************************************/ 
 ?>
<?php 
ob_start();
session_start(); 
$sessionid=session_id();
if(!isset($_SESSION['StStephenChurch_RegUserData'])){
	header("Location:login.php");
}
function __autoload($className){
	$className=strtolower($className);
	require_once "./cmsapp/classes/{$className}_class.php";
}
include_once("./cmsapp/includes/utility.php");
$log=new Logging();
?>
<?php
$userName=$_POST["userId"];
$passwd=$_POST["password"];
$userService = new RegUserService();
if(!$userService->isUserExists($userName))
{
	/* $_SESSION["regError"]="User does not exists! Please fill the Details.";
	$userAccount=new UserAccount();
	$userAccount->setUserId($userName);
	$_SESSION["UESRREG"]=serialize($userAccount); */
	//header("Location:registration.php");
	exit();
}
$userData = $userService->authenticate($userName,$passwd);
if($userData){
	$userId=$userData->getUserId();
	if($userData->getActivated()==1){
		$userService->addLoginActivity($userId,$sessionid);
		$_SESSION['StStephenChurch_RegUserData']=serialize($userData);
		$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
		//setcookie("auth", $userName, strtotime( '+730 days' ));
		if(isset($_POST['rememberme'])){
			if($_POST['rememberme']=="1"){
				setcookie("auth", $userName, time()+60*60*24*30);
			}
			else{
				setcookie('auth', null, -1);
				unset($_COOKIE['auth']);
			}
		}
		else{
			setcookie('auth', null, -1);
			unset($_COOKIE['auth']);
		}
		header("Location:index.php");
	}
	else{
		$_SESSION["StStephenChurch_activationuserid"]=$userName;
		$userService->sendActivationOtp($userData->getUId(),$userData->getUserId(),$userData->getMobileNumber());
		$_SESSION["loginError"]="Not activated";
		header("Location:useractivation.php");
	}
}
else{
	$_SESSION["loginError"]="The Username or password you entered is incorrect";
	header("Location:login.php?err=WRPAS");
}
?>
<?php ob_flush(); ?>