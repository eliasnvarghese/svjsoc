<?php
/****************************************
 * @Project     : St Stephen Church
 * @Version     :  1.0.0
 * @Author by	:  Antony Joseph
 * @Created Date : 10/12/2018
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
include_once("includes/utility.php"); 

	$incomeCategoryServiceObj = new IncomeCategoryService();		
	$headId = $_REQUEST['headId'];
	//if($_REQUEST['btn-Save'] == 'Add'){
		if($headId == ''){					
				$stat = $incomeCategoryServiceObj->addIncomeCategory($_POST["description"]);
		}else{	
				$stat = $incomeCategoryServiceObj->updateIncomeCategory($_POST["code"],$_POST["description"]);
		}
	//}	
	if($stat>0)
		header('location:addrectcategory.php?stat=success');
	else
		header('location:addrectcategory.php?stat=failed');
?>
<?php ob_flush(); ?>