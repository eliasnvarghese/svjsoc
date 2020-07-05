<?php 
ob_start();
session_start(); 
$sessionid=session_id();
if(!isset($_SESSION['StStephenChurch_AdminUserData'])){
	header("Location:login.php");
	exit();
}
function __autoload($className){
	$className=strtolower($className);
	require_once "./classes/{$className}_class.php";
}
require_once("includes/utility.php"); 
$log=new Logging();

$searchString=isset($_REQUEST["srchStr"])?$_REQUEST["srchStr"]:"";
$regUId=isset($_REQUEST["uid"])?$_REQUEST["uid"]:0;
$action=isset($_REQUEST["act"])?$_REQUEST["act"]:"add";

$UserId=$Name=$FamilyName=$Gender=$Dob=$MaritalStatus=$SpouseName=$Address=$City=$State=$Mobile=$Phone=$About=$AboutFamily="";	
$regUserServiceObj= new RegUserService();
$userAccount=$regUserServiceObj->getUserAccountByUId($regUId);
if($userAccount!=null){
	$UserId=$userAccount->getUserId();
	$Name=$userAccount->getName();
	$FamilyName=$userAccount->getFamilyName();
	$Gender=$userAccount->getGender();
	$Dob=$userAccount->getDob();
	$MaritalStatus=$userAccount->getMaritalStatus();
	if($MaritalStatus!="Married" && $MaritalStatus!="Single")
		$MaritalStatus="Married";
	$SpouseName=$userAccount->getSpouseName();
	$Address=$userAccount->getFullAddress();
	$City=$userAccount->getCity();
	$State=$userAccount->getState();
	$Mobile=$userAccount->getMobileNumber();
	$Phone=$userAccount->getPhoneNumber();
	$About=$userAccount->getAboutMe();
	$AboutFamily=$userAccount->getAboutFamily();
}	
else{
	header("Location:addreceipt.php");
	exit();
}		

$Dob=dateDisplayFormat($Dob,"m/d/Y");
$rectId=isset($_REQUEST["rectid"])?$_REQUEST["rectid"]:0;
$rectDate=$category=$rectdetls=$amount=$cancelled="";
$paymentServiceObj=new PaymentService();
if($rectId>0){
	$receiptObj=$paymentServiceObj->getReceipt($regUId,$rectId);
	if($receiptObj!=null){
		$rectDate=$receiptObj->getRectdate();
		$category=$receiptObj->getCategory();
		$rectdetls=$receiptObj->getRectdetls();
		$amount=$receiptObj->getRectamount();
		$cancelled=$receiptObj->getCancelled();
		$rectDate=dateDisplayFormat($rectDate,"m/d/Y");
	}	
	else{
		header("Location:addreceipt.php");
		exit();
	}
	$action=($action=="add")?"update":$action;
}
$caption=$action;
$caption=($caption=="cancel")? "Cancel" : $caption;
$caption=($caption=="update")? "Edit" : $caption;
$required=($action=="cancel")? "readonly" : "required";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cash Collection</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/adminlte.css" rel="stylesheet" type="text/css" />
        <link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
       <!-- fullCalendar -->
        <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
		       <link href="css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
	</head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
       <?php include('includes/header.php'); ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <?php include("includes/inc_menu.php"); ?>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Cash Collection
                        <small>Add</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Cash Collection</a></li>
                        <li class="active">Add</li>
                    </ol>
                </section>
				<!-- Alert Message -->
				<?php 
				if(isset($_REQUEST["stat"])) {
					$alertMessage="";
					if($_REQUEST["stat"]=="saved") {
						$alertMessage="Cash Receipt Successfully Saved!";
					}
					else if($_REQUEST["stat"]=="updated") {
						$alertMessage="Cash Receipt Successfully Updated!";
					}
					else if($_REQUEST["stat"]=="cancelled") {
						$alertMessage="Cash Receipt Successfully Cancelled!";
					}		
					else if($_REQUEST["stat"]=="savfailed") {
						$alertMessage="Cash Receip tFailed to Save!";
					}	else if($_REQUEST["stat"]=="updfailed") {
						$alertMessage="Cash Receipt Failed to Update!";
					}	else if($_REQUEST["stat"]=="canfailed") {
						$alertMessage="Cash ReceiptFailed to Cancel!";
					}
					if($alertMessage!=""){
						?>
						<div class="box-body">
							<div class="alert alert-danger alert-dismissable">
								<i class="fa fa-ban"></i>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<b>Alert!</b> <?php echo $alertMessage;?>
							</div>
						</div>
					<?php
					}
				} ?>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6"> 
       
							<div class="box box-primary">
								<div class="box-header" style="padding-bottom:0px;">
									<h3 class="box-title" style="padding-bottom:0px;">Search  </h3>
								</div><!-- /.box-header -->
							<div class="box-body">
								<div class="row" id="allowanceTable">
								<div class="box-body table-responsive">
									<form action="cashcollection.php" method="POST" >
									<div class="form-group">
										<input class="form-control"placeHolder="Search By Uid or Name" id="srchStr" name="srchStr"  style="margin-left:0px;float:right;" value="<?php echo $searchString; ?>">
										<input  name="uid" hidden value="<?php echo $regUId; ?>" >
									</div>
									<div class="form-group">
										<button type="submit" id="btn-Srch" class="btn btn-primary">Search</button>
									</div>	
									</form>
                                    <table id="example3" class="table table-bordered table-striped">
                                        <thead>
										<tr>
										<th>RegNo</th><th>Name</th><th>DOB</th><th>Gender</th><th>City</th><th>Action</th>
										</tr>
                                        </thead>
                                        <tbody>
										<?php
										if($searchString!=""){
											$userServiceObj= new RegUserService();
											$results=$userServiceObj->getAllRegUsers('DATALIST',$searchString,0,99999999);
											while($row=mysqli_fetch_array($results)){
											?>
												<tr>
													<td><?php echo $row["uid"]; ?></td>
													<td><?php echo ucfirst($row["name"]); ?></td>
													<td><?php echo $row["dob"]; ?></td>
													<td><?php echo $row["gender"]; ?></td>
													<td><?php echo $row["city"]; ?></td>
													<td>
													<a href="cashcollection.php?uid=<?php echo $row["uid"]; ?>"><i class="fa fa-money" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cash Receipt"></i></a>
													</td>
												</tr>
										<?php 	
											}
										}
										?>
                                        </tbody>
                                    </table>
                                </div>
								
								</div>
							</div>
							
							<!-- /.box-body -->
						</div>

					<!-- /.box -->
					
                        </div><!--/.col (left) -->
                        <!-- right column -->
                        <div class="col-md-6">
						<form action="cashcollection_action.php" method="POST"  role="form" id="ReceiptForm" >
						<div class="box box-primary">
							<!-- /.box-header -->
							 <div class="box-body">
								<div class="form-group row">
									<div class="col-xs-3">
										<label for="RegNo">Uid</label>
										<input type="hidden" hidden id="formaction" name="formaction" value="<?php echo $action; ?>" >
										<input class="form-control" style="margin-right:0px;" id="uid" name="uid" <?php echo $required;?> value="<?php echo $regUId; ?>" style="margin-left:0px;float:right;" readonly >
									</div>
									<div class="col-xs-9">
										<label for="Name">Name </label>
										<div  class="form-control" id="Name" style="margin-left:0px;float:right;"><?php echo $Name; ?></div>
									</div>	
								</div>
								<div class="form-group row">
									<div class="col-xs-6">
										<div class="input-group">
											<div class="input-group-addon"><label for="Dob">Receipt No</label>
											</div>
											<input class="form-control" readonly id="rectId" name="rectId" value="<?php echo $rectId;?>">
										</div>		
									</div>										
									<div class="col-xs-6">
										<div class="input-group">
											<div class="input-group-addon"><label for="Dob">Receipt Date</label>
												<i class="fa fa-calendar"></i>
											</div>
											<input class="form-control" <?php echo $required;?> id="rectDate" name="rectDate" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" type="text" placeholder="mm/dd/yyyy" value="<?php echo $rectDate;?>">
										</div>		
									</div>		
								</div>		
		
								<div class="form-group">
									<label for="Name">Category </label>
									<select class="form-control" id="Category" name="Category" <?php echo $required;?>>
										<option value="Offerings" 			<?php echo ($category=="Offerings")? "selected" : "";?>	>Offerings </option>
										<option value="Annual Subscription" <?php echo ($category=="Annual Subscription")? "selected" : "";?>	>Annual Subscription </option>
										<option value="Donation" 			<?php echo ($category=="Donation")? "selected" : "";?>	>Donation</option>
									</select>
								</div>	
								<div class="form-group row" style="margin-bottom: 0px;">
									<div class="col-xs-12">
									<label for="Amount">Amount </label>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-xs-6">
										<div class="input-group">
											<div class="input-group-addon"><label for="Amount"></label>
												<i class="fa fa-dollar"></i>
											</div>
       <input type="number" <?php echo $required;?> id="Amount" name="Amount" min="0" step="0" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" value="<?php echo $amount;?>" />
										</div>		
									</div>		
								</div>	
																
								<div class="form-group row">
								<div class="col-xs-12">
									<label for="Narration">Narration </label>
									<input type="text" class="form-control" id="Narration" <?php echo $required;?> name="Narration" placeholder="Narration" value="<?php echo $rectdetls;?>">
								</div>		
								</div>		
							</div>
						</div>
						<div class="box ">
							<!-- /.box-header -->
							<div class="box-footer">
								<button type="submit" class="btn btn-primary"><?php echo strtoupper($action); ?></button>
								<a href="addreceipt.php"><button type="button" class="btn btn-primary">Back</button></a>
							</div>
						</div>
						</form>
						<!--right bottom -->
						<div class="box box-primary">
							<!-- /.box-header -->
							<!-- /.box-body -->
							<div class="box-header" style="padding-bottom:0px;">
								<h3 class="box-title" style="padding-bottom:0px;">Receipts </h3><div class="pull-right box-tools"> 
								</div>
							</div><!-- /.box-header -->
							<div class="box-body">
								<div class="row" id="allowanceTable">
								<div class="box-body table-responsive">
									<table id="table-expense" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th width="5%">Rect No</th>
												<th width="9%">Rect Date</th>
												<th>Category</th>
												<th>Narration</th>
												<th width="9%">Amount</th>
												<th width="15%"><i class="fa fa-cogs" aria-hidden="true"></i></th>
											</tr>
										</thead>
										<tbody>
										<?php
											$paymentServiceObj = new PaymentService();													
											$results=$paymentServiceObj->getLedger($regUId);
											while($row=mysqli_fetch_array($results)){
											?>
												<tr>																	
													<td><?php echo $row["rectno"]; ?></td>																
													<td><?php echo dateDisplayFormat($row["rectdate"],"m/d/Y"); ?></td>																
													<td><?php echo $row["category"]; ?></td>																
													<td><?php echo $row["rectdetls"]; ?></td>																
													<td><?php echo $row["rectamount"]; ?></td>
													<td>
													<a target="_blank" href="receipt_pdf.php?uid=<?php echo $row["uid"]; ?>&rectid=<?php echo $row["rectno"]; ?>&act=update"><i class="fa fa-download" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download Receipt"></i></a>
													&nbsp;&nbsp;<a href="cashcollection.php?uid=<?php echo $row["uid"]; ?>&rectid=<?php echo $row["rectno"]; ?>&act=update"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i></a>
													&nbsp;&nbsp;<a href="cashcollection.php?uid=<?php echo $row["uid"]; ?>&rectid=<?php echo $row["rectno"]; ?>&act=cancel"><i class="fa fa-times-circle" style="color:red" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cancel Receipt"></i></a>
													</td>															
												</tr>
											<?php 	
											}
											?>												
										</tbody>
										
									</table>												
								</div>
								</div>
							</div><!-- /.box-body -->										
						</div>	
						<div class="box-footer">      </div>                              
						<!--right bottom -->
						<!--/.col (right) -->
						</div> 
					</div> 
					  <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/adminlte/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="js/adminlte/demo.js" type="text/javascript"></script>  
		<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <!-- date-range-picker -->
		<!-- bootstrap data tables -->
		<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
				<script src="js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>

   <!-- jQuery 2.0.2 -->
        <!-- jQuery UI 1.10.3 -->
        <script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>

        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->

        <!-- AdminLTE App -->
		<script type="text/javascript">
            $(function() {
				$('#ReceiptForm').submit(function(){
					if($('#formaction').val()=="cancel")
					{
						var answer = confirm("Are you sure you want to cancel this receipt ?");						
						if (answer){									
							return true;		
						} else {		
							return false;
						}	
					}
					return true;	
				}); 			
				
				$("[data-widget='collapse']").click();
                //Datemask mm/dd/yyyy
                $("#datemask").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Money Euro
                $("[data-mask]").inputmask();
				
				$("#rectDate").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                $('#rectDate').datepicker({format: 'mm/dd/yyyy' , endDate: '<?php echo date('m-d-Y'); ?>'
				});
 

			$('.modal-content').css('height',($(window).height()-100)+'px');
			$('.modal-tablecontent').css('height',($(window).height()-250)+'px').css('overflow-y','scroll').css('overflow-x','hidden');
				
			/* resize model window of medicine */
				$(window).resize(function(e) {
					$('.modal-content').css('height',($(window).height()-100)+'px');
					$('.modal-tablecontent').css('height',($(window).height()-250)+'px').css('overflow-y','scroll').css('overflow-x','hidden');
				});
					
				//$("[data-widget='collapse']").click();
    
            });
        </script>
     <script type="text/javascript">
            $(function() {
                $('#medicine').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
			
			
        </script>
    </body>
</html>
