<?php
if(!isset($monthFilter))       $monthFilter=true;
if(!isset($yearFilter))        $yearFilter=true;
if(!isset($clientFilter))       $clientFilter=true;
if(!isset($siteFilter))         $siteFilter=true;
if(!isset($searchFilter))     $searchFilter=false;
if(!isset($paymodeFilter))     $paymodeFilter=false;
if(!isset($isClientAllReqd))   $isClientAllReqd=true;
if(!isset($isSiteAllReqd))     $isSiteAllReqd=true;

?>
<form action="<?php echo $thisPage; ?>" role="form" method="GET" id="empForm" >  
<?php if($monthFilter==true && $yearFilter==true){ ?>
	<div class="form-group ">
		<div class="col-xs-5">
			<label>Month</label>
			<select class="form-control" id="month" name="month">
				<option value="">Select Month</option>
				<?php
				$MonthArray=getMonthArray();
				for($i=1;$i<13;$i++){ 				
				?>
					<option <?php if($month==$i){ ?> selected <?php } ?> value="<?php echo $i; ?>"><?php echo $MonthArray[$i]; ?></option>
				<?php } ?>			
			</select>
		</div>
		<div class="col-xs-5">
			<label>Year</label>
			<select class="form-control" id="year" name="year">
			<option value="">Select Year</option>
			<?php for($i=0;$i<11;$i++){ 
				$yr=date("Y")-$i;
			?>
				<option <?php if($year==$yr){ ?> selected <?php } ?>  value="<?php echo $yr; ?>"><?php echo $yr; ?></option>
			<?php } ?>			
			</select>
		</div>
		
	</div>
<?php } else if($yearFilter==true){ ?>
	<div class="form-group ">
		
		<div class="col-xs-5">
			<label>Year</label>
			<select class="form-control" id="year" name="year">
			<option value="">Select Year</option>
			<?php for($i=0;$i<11;$i++){ 
				$yr=date("Y")-$i;
			?>
				<option <?php if($year==$yr){ ?> selected <?php } ?>  value="<?php echo $yr; ?>"><?php echo $yr; ?></option>
			<?php } ?>			
			</select>
		</div>
		
	</div>
<?php } 
 if($clientFilter==true && $siteFilter==true){ ?>
	<div class="form-group ">
	<?php
		$clientServiceObj= new ClientService();
		$results=$clientServiceObj->getAllClients();	
	?>
		<div class="col-xs-5">
			<label>Clients</label>
			<select class="form-control" required id="clientIdList" name="clientId" placeholder="clientId">
				<?php if($isClientAllReqd==true){ ?><option value="all">All</option><?php } 
				 else { ?><option value="">Select</option><?php } ?>
				<?php while($row=mysqli_fetch_array($results)){ ?>
					<option <?php if($clientId==$row['client_id']){ ?> selected <?php } ?> value="<?php echo $row['client_id']; ?>"><?php echo $row['client_name']; ?></option>
					<?php } ?>
			</select>
		</div>
		<div class="col-xs-5" id="siteLocationsBlock">
			<label>Site / Location</label>
			<select class="form-control"  id="siteLocations" name="siteId">
				<?php if($isSiteAllReqd==true){ ?><option value="all">All</option><?php } 
				 else { ?><option value="">Select</option><?php } ?>
			</select>
		</div>
	</div>
<?php } else if($clientFilter==true){ ?>
	<div class="form-group ">
	<?php
		$clientServiceObj= new ClientService();
		$results=$clientServiceObj->getAllClients();	
	?>
		<div class="col-xs-5">
			<label>Clients</label>
			<select class="form-control" required id="clientIdList" name="clientId" placeholder="clientId">
				<?php if($isClientAllReqd==true){ ?><option value="all">All</option><?php } 
				 else { ?><option value="">Select</option><?php } ?>
				<?php while($row=mysqli_fetch_array($results)){ ?>
					<option <?php if($clientId==$row['client_id']){ ?> selected <?php } ?> value="<?php echo $row['client_id']; ?>"><?php echo $row['client_name']; ?></option>
					<?php } ?>
			</select>
		</div>
	</div>
<?php }  
 if($searchFilter==true){ ?>
	<div class="form-group ">
		<div class="col-xs-5">
			<label>Search String</label>
			<input type="text" class="form-control" id="searchStr" name="searchStr" placeholder="Search String"/>
		</div>
	</div>
<?php } 
if($paymodeFilter==true){ ?>
	<div class="form-group ">
		<div class="col-xs-5">
		<label for="exampleInputEmail1">Mode of Pay </label>
		<select class="form-control" id="modeOfPay" name="modeOfPay" placeholder="Mode of Pay">
			<option value="all" <?php if($modeOfPay=='Cash'){ ?>selected <?php } ?>>All</option>
			<option <?php if($modeOfPay=='Cash'){ ?>selected <?php } ?>>Cash</option>
			<option <?php if($modeOfPay=='Check'){ ?>selected <?php } ?>>Check</option>
			<option <?php if($modeOfPay=='Bank'){ ?>selected <?php } ?>>Bank</option>
		</select>
		</div>
	</div>
<?php } ?>
	<div class="form-group row">
		<div class="col-xs-1"><label>&nbsp;</label><button type="submit" class="btn btn-primary">Submit</button></div>
	</div>
</form>
 <div class="callout callout-danger" style="margin-bottom: 0!important;">         
		<?php $clientServiceObj=new ClientService();		?>
		<b><?php if(isset($siteId)){ echo $clientServiceObj->getClinetSiteName($clientId,$siteId); }?></b>  <?php if(isset($month)){ echo getMonthText($month);} if(isset($year)){echo "-".$year;}; ?>
</div>
