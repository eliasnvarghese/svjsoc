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
	$stat = $expenseHeadServiceObj->deleteExpenseHead($_POST["code"]);
	
	if($stat>0)
		header('location:addexpensehead.php?stat=success');
	else
		header('location:addexpensehead.php?stat=failed');
?>
<?php ob_flush(); ?>