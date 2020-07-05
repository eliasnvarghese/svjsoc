<?php ob_start(); ?>
<?php session_start() ?>
<?php 
if(!isset($_SESSION['StStephenChurch_AdminUserData']))
{
	header("Location:login.php");
}
function __autoload($className){
	$className=strtolower($className);
	require_once "./classes/{$className}_class.php";
}
?>
<?php 
require_once('includes/utility.php'); 

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Change Password</title>
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
                        Change Password
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Forms</a></li>
                        <li class="active">General Elements</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-primary">
							<!-- /.box-header -->
                                <!-- form start -->
								
                                <form action="changepswd_action.php" method="POST" enctype="multipart/form-data">
                                    <div class="box-body"> 
									<div class="form-group">
									<p><?php echo showMessage('changePaswdError') ;?></p>
										<label for="LocalAdr1">UserName </label><p><?php echo showMessage('adduserError') ;?></p>
										<input type="email"  placeholder="Enter email Id" value="<?php echo $userId;?>" required name="UserId" id="UserId" class="form-control" readonly />
										
									</div>				
									<div class="form-group">
										<label for="LocalAdr1">Old Password </label>
										<input type="password"  placeholder="Enter Old Password" required name="oldPswd"  id="oldPswd"  class="form-control" />
									</div>
									<div class="form-group">
										<label for="LocalAdr1">New Password </label>
										<input type="password" pattern=".{5,20}" placeholder="Min 5 characters" required name="newPswd"  id="newPswd"  class="form-control" />
									</div>
								<div class="box ">
							<!-- /.box-header -->
							
								<div class="box-footer" style="padding-left:220px">
									<input type="submit" class="btn btn-primary"  id="btn-Save" name="btn-Save" value="Change" />
									<input type="button" class="btn btn-primary" onclick="location.href='addadminuser.php'" value="New" />
								</div>							
							</div>
						</form>
						</div><!-- /.box-body -->
						 <div class="box-footer">      </div>

                          </div>							
						<!-- /.box -->
                        </div><!--/.col (left) -->
                        <!-- right column -->
                        <div class="col-md-6">
						<div class="box box-primary">
							<!-- /.box-header -->
							<!-- /.box-body -->
							<div class="box box-primary">
								<div class="box-header">
									<h3 class="box-title"> </h3><div class="pull-right box-tools"> 
								</div>
							</div><!-- /.box-header -->
										<div class="box-body">

											<div class="row" id="allowanceTable">
											<div class="box-body table-responsive">
												
											</div>
											</div>
										</div><!-- /.box-body -->										
									</div>	
							<div class="box-footer">      </div>                              
						</div>	
					
					
                            <!-- general form elements disabled -->
                           <!-- /.box -->
                        </div><!--/.col (right) -->
                    </div>   <!-- /.row -->
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

	<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <!-- date-range-picker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- bootstrap color picker -->
        <script src="js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
        <!-- bootstrap time picker -->
        <script src="js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
		<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
       		<script type="text/javascript">
			
            $(function() {
				$('#AddAllowanace').click(function(){
					var AlwArray=new Array();
			var AmtArray=new Array();
					var AlwCode=$('#AllownceCode').val();
					var Amt=$('#Amount').val();
						
						if(AlwCode!="" && Amt!=""){
							AlwArray.push(AlwCode);
							AmtArray.push(Amt);
							for(var i=0;i<AlwArray.length;i++){
								$('#allowanceTable').append('<div class="col-xs-5"> <input type="text" disabled value="'+AlwArray[i]+'"class="form-control" id="AllownceCodeData" name="AllownceCodeData[]" placeholder="AllownceCode"> </div> <div class="col-xs-3">  <input type="text" class="form-control" disabled id="AmountData" name="AmountData[]" value="'+AmtArray[i]+'" placeholder="Amount"> </div>');	
								}
							$('#AllownceCode').val(''); $('#Amount').val(''); 
						}
						
					});
					
					/*$('.edit-user').click(function(e){						
						var descId = "#user"+this.id;
						alert(descId);						
						$("#UserId").val($(descId).html());
						//$("#code").val(this.id);
						$("#btn-Save").val('Update');
					});
					$('.delete-user').click(function(e){
						alert('test');
						var answer = confirm("Are you sure you want to delete this user?");													
											
					});*/
					
					$('#AddDeduction').click(function(){
					var DuductArray=new Array();
					var AmtArray=new Array();
					var AlwCode=$('#DeductionCode').val();
					var Amt=$('#DeductionAmount').val();
						
						if(AlwCode!="" && Amt!=""){
							
							DuductArray.push(AlwCode);
							AmtArray.push(Amt);
							for(var i=0;i<DuductArray.length;i++){
								$('#deductionTable').append('<div class="col-xs-5">  <input type="text" disabled value="'+DuductArray[i]+'"class="form-control" id="DeductionCodeData" name="DeductionCodeData[]" placeholder="AllownceCode"> </div> <div class="col-xs-3">  <input type="text" class="form-control" disabled id="DeductionAmountData" name="DeductionAmount[]" value="'+AmtArray[i]+'" placeholder="Amount"> </div>');
								}
								$('#DeductionCode').val(''); $('#DeductionAmount').val(''); 
								
						}
						
					});
				$("[data-widget='collapse']").click();
                //Datemask mm/dd/yyyy
                $("#datemask").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Money Euro
                $("[data-mask]").inputmask();

                //Date range picker
                $('#reservation').daterangepicker();
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
                //Date range as a button
                $('#daterange-btn').daterangepicker(
                        {
                            ranges: {
                                'Today': [moment(), moment()],
                                'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                                'Last 7 Days': [moment().subtract('days', 6), moment()],
                                'Last 30 Days': [moment().subtract('days', 29), moment()],
                                'This Month': [moment().startOf('month'), moment().endOf('month')],
                                'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                            },
                            startDate: moment().subtract('days', 29),
                            endDate: moment()
                        },
                function(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
                );

                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal',
                    radioClass: 'iradio_minimal'
                });
                //Red color scheme for iCheck
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                    checkboxClass: 'icheckbox_minimal-red',
                    radioClass: 'iradio_minimal-red'
                });
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-red',
                    radioClass: 'iradio_flat-red'
                });

                //Colorpicker
                $(".my-colorpicker1").colorpicker();
                //color picker with addon
                $(".my-colorpicker2").colorpicker();

                //Timepicker
                $(".timepicker").timepicker({
                    showInputs: false
                });
            });
        </script>
		<script type="text/javascript">
            $(function() {
                $('#example3').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": false,
					"iDisplayLength": 10
                });              
                
            });
        </script>
    
    </body>
</html>
