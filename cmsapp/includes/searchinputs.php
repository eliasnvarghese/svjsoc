<?php
	$profId=(isset($_REQUEST["profId"]))?	$_REQUEST["profId"]: "";
	$searchStr=(isset($_REQUEST["searchStr"]))?	$_REQUEST["searchStr"]: "";
	$fromDate=(isset($_REQUEST["fromDate"]))?	date("Y-m-d",strtotime($_REQUEST["fromDate"])): "";
	$toDate=(isset($_REQUEST["toDate"]))?	date("Y-m-d",strtotime($_REQUEST["toDate"])): date("Y-m-d H:i:s");
	
	
	$fromDateShow=(isset($_REQUEST["fromDate"]))?	$_REQUEST["fromDate"]: "";
	$toDateShow=(isset($_REQUEST["toDate"]))?	$_REQUEST["toDate"]: "";
	/* if(strtotime($toDate)<strtotime($fromDate)){
		$toDate=$fromDate;
	} */
	if(strtotime($toDate)<strtotime($fromDate)){
			$toDate=date('Y-m-d', strtotime($fromDate. ' + 1 days'));
			$toDateShow=date('m-d-Y', strtotime($fromDateShow. ' + 1 days'));
			
		}
?>
	
	<form action="<?php echo $thisPage; ?>">
		<div class="message"></div>
		<div class="field-wrap" style="float:left;margin-left:20px;">
			
			<input type="text" style="width:100px;" name="profId" value="<?php echo $profId; ?>" placeholder="Profile Id" />
		</div>		
		<div class="field-wrap" style="float:left;margin-left:20px;">
			<input type="text" style="width:320px;" name="searchStr"  value="<?php echo $searchStr; ?>" placeholder="Search Context" />
			<input type="text" style="width:75px;"  id="datepicker" name="fromDate" value="<?php echo $fromDateShow; ?>" placeholder="From date" />
			<input type="text" style="width:75px;" id="datepicker2" name="toDate" value="<?php echo $toDateShow; ?>" placeholder="To date" />
		</div>
		<div class="field-wrap last">
			<input type="submit" style="width:50px;margin-left:20px;"  value="Search" />
		</div>
		<div class="loader"></div>
	</form>
