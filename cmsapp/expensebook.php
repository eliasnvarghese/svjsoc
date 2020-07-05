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
        <title> Expense Book </title>
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
                       Expense Book
                        <small>Report</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Accounts</a></li>
                        <li class="active">Expense Book</li>
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
								$searchString=(isset($_REQUEST['searchString']))? $_REQUEST['searchString']:"";
								$fromDate=(isset($_REQUEST['fromDate']))? $_REQUEST['fromDate'] :  date('m/d/Y');
								$toDate=(isset($_REQUEST['toDate']))? $_REQUEST['toDate'] :  date('m/d/Y');

								$monthFilter=false;
								$yearFilter=false;
								include('includes/inc_periodfilter.php'); 
								?>
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                             <tr>
                                                <th>Exp.Id</th>
                                                <th>Date</th>
                                                <th>Code</th>
                                                <th>Head</th>
                                                <th>Narration</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$MAXPAGENOS=3;
										$NOOFLINES=25;
										include("report/pagination.php");
										$rowNo=$pageno*$NOOFLINES-($NOOFLINES);

										$tot_expamount=0;
										$sumAmount=0;
										$fromDate=(isset($_REQUEST['fromDate']))? convertFromUserDateToYmd($_REQUEST['fromDate']) : date('Y-m-d');
										$toDate=(isset($_REQUEST['toDate']))? convertFromUserDateToYmd($_REQUEST['toDate']) : date('Y-m-d');
										$expenseServiceObj = new ExpenseService();														
										$RESULTDATACOUNT=$expenseServiceObj->getExpenseListForPeriod("DATACOUNT",$fromDate,$toDate);
										if($RESULTDATACOUNT>0){
											$sumAmount=$expenseServiceObj->getExpenseListForPeriod("SUMAMT",$fromDate,$toDate);
											$results=$expenseServiceObj->getExpenseListForPeriod("DATALIST",$fromDate,$toDate,$rowNo,$NOOFLINES);
											while($row=mysqli_fetch_array($results)){
												$tot_expamount=$tot_expamount+$row["amount"];
											?>
												<tr>																	
													<td><?php echo $row["expenseid"]; ?></td>																
													<td><?php echo dateDisplayFormat($row["transdate"],"m-d-Y"); ?></td>																
													<td><?php echo $row["expensecode"]; ?></td>																
													<td><?php echo $row["description"]; ?></td>																
													<td><?php echo $row["narration"]; ?></td>																
													<td align="right"><?php echo moneyDisplayFormat($row["amount"],"0.00"); ?></td>
												<td><span id="<?php echo $row["expenseid"]; ?>" class="edit-expense"><a href="editexpense.php?id=<?php echo $row["expenseid"]; ?>"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i></a></span>
												&nbsp;&nbsp;&nbsp;<a href="delete_expense.php?id=<?php echo $row["expenseid"]; ?>"><span id="<?php echo $row["expenseid"]; ?>" style="color:red;" class="delete-expense"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i></span></a>
												</td>															
												</tr>
										<?php 	
											}
										}
										?>	
                                        </tbody>
										  <tfoot>
											<tr>																	
											<td colspan="5">Page Total</td>																
											<td align="right"><?php echo moneyDisplayFormat($tot_expamount,"0.00") ; ?></td>
											</td>															
											</tr>								   
											<tr>																	
											<td colspan="5">Grand Total</td>																
											<td align="right"><?php echo moneyDisplayFormat($sumAmount,"0.00") ; ?></td>
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
								<button type="submit" id="saveAs" name="<?php echo "fromDate=".$fromDate."&toDate=".$toDate; ?>" value="saveas" data-dismiss="modal" class="btn btn-primary" >
									<i class="fa fa-download"></i> Save Statement</button>
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
				$('#saveAs').click(function(e){
					var url=e.target.name;
					if(url!=""){
						var openurl="expensebook_pdf.php?"+url;
						window.open(openurl, '_blank');
					}
				});

				//Datemask dd/mm/yyyy
                $("#datemask").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
				
				$("#fromDate").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                $('#fromDate').datepicker({format: 'mm/dd/yyyy'});
				$("#toDate").inputmask("dd/mm/yyyy", {"placeholder": "mm/dd/yyyy"});
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
