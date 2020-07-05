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
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Income Statement </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/adminlte.css" rel="stylesheet" type="text/css" />
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
                       Income Statement
                        <small>Report</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Accounts</a></li>
                        <li class="active">Income Statement</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                </div><!-- /.box-header -->
								<?php 
								$regUId=(isset($_REQUEST['regUId']))? $_REQUEST['regUId']:"";
								$fromDate=(isset($_REQUEST['fromDate']))? $_REQUEST['fromDate'] : date('m/d/Y');
								$toDate=(isset($_REQUEST['toDate']))? $_REQUEST['toDate'] : date('m/d/Y');

								?>
								<form action="memberledger.php" role="form" method="POST" id="empForm" >  
									<div class="form-group ">
										<div class="col-xs-3">
											<label>Select Member</label>
											<select id="regUId" name="regUId" class="form-control col-lg-12 col-md-12 col-sm-4 col-xs-12"  onfocus='this.size=10;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
											<option value="" >Select</selected>
											<?php	
											$userServiceObj= new RegUserService();
											$results=$userServiceObj->getAllRegUsers('DATALIST',"",0,99999999);
											while($row=mysqli_fetch_array($results)){
											$selected=($regUId==$row["uid"])?"selected='selected' ":"";
											?>
												<option <?php echo $selected; ?> value="<?php echo $row["uid"]; ?>"><?php echo ucfirst($row["name"])." - ".$row["familyname"]; ?></option>
											<?php
											}
											?>
											</select>	
										</div>
										<div class="col-xs-2">
											<label>From</label>
											<input type="text"  class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" id="fromDate" name="fromDate" placeholder="from" value="<?php echo $fromDate;?>">
										</div>
										<div class="col-xs-2">
											<label>To Date</label>
											<input type="text"  class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" id="toDate" name="toDate" value="<?php echo $toDate;?>" placeholder="To">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-xs-1"><label>&nbsp;</label><button type="submit" class="btn btn-primary">Submit</button>
										</div>
									</div>
								</form>
 
								<div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                             <tr>
                                                <th width="3%">Rect No</th>
                                                <th width="8%">Date</th>
                                                <th width="3%">Uid.</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th width="35%">Narration</th>
                                                <th width="8%">Amount</th>
                                                <th width="1%"><i class="fa fa-cogs" aria-hidden="true"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$MAXPAGENOS=3;
										$NOOFLINES=25;
										include("report/pagination.php");
										$rowNo=$pageno*$NOOFLINES-($NOOFLINES);

										$tot_rectamount=0;
										$sumAmount=0;
										$fromDate=(isset($_REQUEST['fromDate']))? convertFromUserDateToYmd($_REQUEST['fromDate']) : date('Y/m/d');
										$toDate=(isset($_REQUEST['toDate']))? convertFromUserDateToYmd($_REQUEST['toDate']) : date('Y/m/d');
										$paymentServiceObj = new PaymentService();	
										$RESULTDATACOUNT=$paymentServiceObj->getMemberLedger("DATACOUNT",$regUId,$fromDate,$toDate);
										if($RESULTDATACOUNT>0){
											$sumAmount=$paymentServiceObj->getMemberLedger("SUMRECT",$regUId,$fromDate,$toDate);										
											$results=$paymentServiceObj->getMemberLedger("DATALIST",$regUId,$fromDate,$toDate,$rowNo,$NOOFLINES);
											while($row=mysqli_fetch_array($results)){
											$tot_rectamount=$tot_rectamount+$row["rectamount"];
											?>
												<tr>																	
													<td><?php echo $row["rectno"]; ?></td>																
													<td><?php echo dateDisplayFormat($row["rectdate"],"m-d-Y"); ?></td>																
													<td><?php echo $row["uid"]; ?></td>																
													<td><?php echo $row["name"]; ?></td>																
													<td><?php echo $row["category"]; ?></td>																
													<td><?php echo $row["rectdetls"]; ?></td>																
													<td align="right"><?php echo moneyDisplayFormat($row["rectamount"],"0.00"); ?></td>
													<td>
														<a target="_blank"  href="receipt_pdf.php?uid=<?php echo $row["uid"]; ?>&rectid=<?php echo $row["rectno"]; ?>"><i class="fa fa-download" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download Receipt"></i></a>
													</td>															
												</tr>
										<?php 	
											}
										}
										?>	
                                       <tfoot>
											<tr>																	
											<td colspan="6">Page Total</td>																
											<td align="right"><?php echo moneyDisplayFormat($tot_rectamount,"0.00"); ?></td>
											</td>															
											</tr>								   
											<tr>																	
											<td colspan="6">Grand Total</td>																
											<td align="right"><?php echo moneyDisplayFormat($sumAmount,"0.00"); ?></td>
											</td>															
											</tr>								   
									   </tfoot>
                                    </table>
									 <div class="box-footer">
									 <div class="row">
                                   <?php
										include("report/pagelink_generator.php");
									?>
									</div><!-- /.row -->
									</div><!-- /.box-header -->										
                                </div><!-- /.box-body -->
								<div class="box-footer">  
									<button type="submit" id="downloadStmt" name="<?php echo "regUId=".$regUId."&fromDate=".$fromDate."&toDate=".$toDate; ?>" value="saveas" data-dismiss="modal" class="btn btn-primary" >
									<i class="fa fa-download"></i>Download Statement</button>
								</div>   

                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/adminlte/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
       
        <!-- page script -->
				<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
				<script src="js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>


  <script type="text/javascript">
            $(function() {
				$('#downloadStmt').click(function(e){
					var url=e.target.name;
					if(url!=""){
						var openurl="memberledger_pdf.php?"+url;
						window.open(openurl, '_blank');
					}
				});	
				$('#downloadRectx').click(function(e){
					alert("helloooo");
					var url=e.target.name;
					if(url!=""){
						var openurl="receipt_pdf.php?"+url;
						window.open(openurl, '_blank');
					}
				});
				 $(document).on('click', '#downloadRect', function(e) { alert("hello"+url);
var url=e.target.name;
					if(url!=""){
						var openurl="receipt_pdf.php?"+url;
						window.open(openurl, '_blank');
					}
					});
				//Datemask mm/dd/yyyy
                $("#datemask").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
				
				$("#fromDate").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                $('#fromDate').datepicker({format: 'mm/dd/yyyy'});
				$("#toDate").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                $('#toDate').datepicker({format: 'mm/dd/yyyy'});
                //Money Euro
                $("[data-mask]").inputmask();
                $('#example1').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>

    </body>
</html>
