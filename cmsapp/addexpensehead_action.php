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

	$expenseHeadServiceObj = new ExpenseHeadService();
	$headId = $_REQUEST['headId'];
	//if($_REQUEST['btn-Save'] == 'Add'){
		if($headId == ''){					
				$stat = $expenseHeadServiceObj->addExpenseHead($_POST["description"]);
		}else{	
				$stat = $expenseHeadServiceObj->updateExpenseHead($_POST["code"],$_POST["description"]);
		}
	//}	
	if($stat>0)
		header('location:addexpensehead.php?stat=success');
	else
		header('location:addexpensehead.php?stat=failed');
?>
<?php ob_flush(); ?>