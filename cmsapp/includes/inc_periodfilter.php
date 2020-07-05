
<?php
$fromDateFilter=(isset($fromDateFilter))? $fromDateFilter:true;
$toDateFilter=(isset($toDateFilter))? $toDateFilter:true;
$keywordTitle=(isset($keywordTitle))? $keywordTitle:"Keyword";
$keywordFilter=(isset($keywordFilter))? $keywordFilter:true;
$monthFilter=(isset($monthFilter))? $monthFilter:true;
$yearFilter=(isset($yearFilter))? $yearFilter:true;
$postMethod=(isset($postMethod))? $postMethod:false;
$formMethod=($postMethod==true)? "POST":"GET";
?>
<form action="<?php echo $thisPage; ?>" role="form" method="<?php echo $formMethod; ?>" id="empForm" >  
<?php $searchString=(isset($_REQUEST['searchString']))? $_REQUEST['searchString']:""; ?>
	<div class="form-group ">
	<?php if($keywordFilter){ ?>
		<div class="col-xs-3">
			<label><?php echo $keywordTitle;?></label>
			<input type="text" value="<?php echo $searchString; ?>" class="form-control" id="searString" name="searchString" placeholder="Search">
		</div>
	<?php } if($monthFilter){ ?>
		<div class="col-xs-3">
			<label>Month</label>
			<select class="form-control" id="month" name="month">
			<option value="" >Select Month</option>
			<?php
			$month=(isset($_REQUEST['month']))?$_REQUEST['month']:"";
			$MonthArray=getMonthArray();
			for($i=1;$i<13;$i++){
				
			?>
				<option <?php if($month==$i){ ?> selected <?php } ?> value="<?php echo $i; ?>"><?php echo $MonthArray[$i]; ?></option>
			<?php } ?>			
			</select>
		</div>
		<?php } if($yearFilter){ ?>
		<div class="col-xs-3">
			<label>Year</label>
			<select class="form-control" id="year" name="year">
			<option value="" selected >Select Year</option>
			<?php 
			$year=(isset($_REQUEST['year']))?$_REQUEST['year']:"";
			for($i=0;$i<11;$i++){ 
				$yr=date("Y")-$i;
				
			?>
				<option <?php if($year==$yr){ echo "selected"; } ?>  value="<?php echo $yr; ?>"><?php echo $yr; ?></option>
			<?php } ?>			
			</select>
		</div> 
		<?php } if($fromDateFilter){ ?>
		
		<div class="col-xs-2">
			<label>From</label>
			<input type="text"  class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" id="fromDate" name="fromDate" placeholder="from" value="<?php echo $fromDate;?>">
		</div>
		<?php } 
		if($toDateFilter){ ?>
		<div class="col-xs-2">
			<label>To Date</label>
			<input type="text"  class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" id="toDate" name="toDate" value="<?php echo $toDate;?>" placeholder="To">
		</div>
		 <?php  } ?>
		
	</div>

	<div class="form-group row">
		<div class="col-xs-1"><label>&nbsp;</label><button type="submit" class="btn btn-primary">Submit</button>
		
		</div>
	</div>

</form>

