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
	$log = new Logging();
	$expenseServiceObj = new ExpenseService();
	$expenseId = $_REQUEST['expenseId'];
	$stat = $expenseServiceObj->deleteExpenses($expenseId);
	if($stat>0)
		header('location:addexpense.php?stat=success');
	else
		header('location:addexpense.php?stat=failed');
?>
<?php ob_flush(); ?>