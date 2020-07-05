<?php
/****************************************
 * @Project     : St Stephen Church
 * @Version     :  1.0.0
 * @Author by	:  Antony Joseph
 * @Created Date : 09/11/2018
 * @modified by	:
 * @modified date:
 ****************************************/
 ?>

<?php
date_default_timezone_set('Asia/Calcutta');

$log= new Logging();
$themeImage="";
$remuserid=" User Name ";
if(isset($_COOKIE["mypref"]))
{
	$prefs=explode("|",$_COOKIE["mypref"]);
	if(sizeof($prefs)>0)
		$themeImage=$prefs[0];
	if(sizeof($prefs)>1)
		if(trim($prefs[1])!="")
			$remuserid=$prefs[1];
}
$ipaddr=$_SERVER['REMOTE_ADDR'];
$ippassed=false;
$allowed=array("");
$blocked=array("127.0.1");
for($i=0;$i<sizeof($allowed);$i++){
	$allowedIpLen=strlen($allowed[$i]);
	if ($allowed[$i]==substr($ipaddr,0,$allowedIpLen)){
		$ippassed=true;
		break;
	}
}
for($i=0;$i<sizeof($blocked);$i++){
	$blockedIpLen=strlen($blocked[$i]);
	if ($blocked[$i]==substr($ipaddr,0,$blockedIpLen)){
		$ippassed=false;
		break;
	}
}
//$ippassed=true;  // For time being 
if(!$ippassed){
	$log->debugLog("Invalid Ip...".$ipaddr);
	$_SESSION['StStephenChurch_AdminUserData']=null;
	unset($_SESSION['StStephenChurch_AdminUserData']);
	if($_SERVER["HTTP_HOST"]=="127.0.0.1" || $_SERVER["HTTP_HOST"]=="localhost")
		header("location:http://127.0.0.1/ststephenchurch/");
	else
		header("Location:http://ststephenssanjose.org/");
	exit();
}
if(isset($_SESSION['StStephenChurch_AdminUserData']))
{
	if($_SESSION['StStephenChurch_AdminUserData']!=NULL){
		$log->debugLog("User Logged In");
		if(isset($_SESSION['edp_themeImage']))
			$themeImage=$_SESSION['edp_themeImage'];
		include_once('loggedinheader.php');
	}
	else{
		$log->debugLog("Null Session..Login Header ");
		include_once('loginheader.php');
	}
}
else{
	 $log->debugLog("No Session..Login Header ");
	 include_once('loginheader.php');
}
?>
<body >