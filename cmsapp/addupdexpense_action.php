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
include_once("includes/utility.php"); ?>
<?php
	$log = new Logging();
	$expenseServiceObj = new ExpenseService();
	$expenseId = $_POST['expenseId'];
	$transDate = $_POST['transDate'];
	if($expenseId == ''){		
		$stat = $expenseServiceObj->addExpenses($_POST["code"],$_POST["narration"],$_POST["amount"],convertFromUserDateToYmd($transDate));
	}else{	
		$stat = $expenseServiceObj->updateExpenses($expenseId,$_POST["code"],$_POST["narration"],$_POST["amount"],convertFromUserDateToYmd($transDate));
	}
	if($stat>0)
		header('location:addexpense.php?stat=success');
	else
		header('location:addexpense.php?stat=failed');
?>
<?php ob_flush(); ?>