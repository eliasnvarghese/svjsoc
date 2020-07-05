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

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Event</title>
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
		<link href="css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
 
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
		<style>
			.checkbox .simple{
				background-position: 0px 0px;
				display: inline-block;
				vertical-align: middle;
				margin-left:20px;
				margin: 0px;
				padding: 0px;
				width: 18px;
				height: 18px;
				background: url('css/iCheck/minimal/minimal.png') no-repeat scroll 0% 0% rgba(255, 255, 255, 0.7);
				border: medium none;
				cursor: pointer;
			}
		</style>
		<script>
		function readImageURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#coverimage')
						.attr('src', e.target.result)
						.width('100%')
				};

				reader.readAsDataURL(input.files[0]);
			}
		}

		function validateformoo(){  
			var fromdate=document.getElementById('FromDate').value;
			var todate=document.getElementById('ToDate').value;
			//alert("fromdate="+fromdate+" - todate = "+todate);
			var pattern = /(\d{2})\/(\d{2})\/(\d{4})/;
			var date1 = new Date(fromdate.replace(pattern,'$2-$1-$3'));
			var date2 = new Date(todate.replace(pattern,'$2-$1-$3'));
			alert("date range"+date1 +"  = "+date2);
			var d1   = date1.getTime();
			var d2   = date2.getTime();

			 if ( d2 >= d1) {
				// date is in your valid range
				//alert("date is in the range");
				 return true;
			} else {
				// date is not in your valid range
				alert("date is not in the range"+d1 +"  = "+d2);
				document.getElementById('ToDate').focus();
				return false;
			}
		}  
		function validateform(){  
			var fromdate=document.getElementById('FromDate').value;
			var todate=document.getElementById('ToDate').value;
		var d1 = new Date(fromdate.split('/')[2], fromdate.split('/')[0]-1 , fromdate.split('/')[1]);
        var d2 = new Date(todate.split('/')[2], todate.split('/')[0]-1 , todate.split('/')[1]);

			 if ( d2 >= d1) {
				// date is in your valid range
				//alert("date is in the range");
				 return true;
			} else {
				// date is not in your valid range
				alert("date is not in the range"+d1 +"  = "+d2);
				document.getElementById('ToDate').focus();
				return false;
			}
		}  
   
	</script>
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
                        Add New Event
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Event</a></li>
                        <li class="active">Add New Event</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                      <form onsubmit="return validateform();" action="addevent_action.php" role="form" id="eventForm" method="POST" enctype="multipart/form-data" >   
					  <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Basic Informations</h3><div class="pull-right box-tools">                                        
                                    </div>
                                </div><!-- /.box-header -->
                                <!-- form start -->
								<div class="box-body">
						
									<div class="form-group ">
										<label for="Universityname">Event Name <span style="color:red" id="alertMsg"></span></label>
										<input type="text" class="form-control" required id="EventName" name="EventName" placeholder="Event Name" >
									</div>	
									<div class="form-group ">	
										<label for="City">Highlights </label>
										<input type="text" class="form-control" required id="Highlights" name="Highlights" placeholder="Event Highlights" >
									</div>
									<div class="form-group ">
										<label for="Overview">Event Details </label>
										<textarea class="form-control" id="EventDetails" name="EventDetails"  rows="2" placeholder="Event Details"></textarea>
									</div>	
									<div class="form-group row ">
										<div class="col-xs-6">
											<div class="input-group-addon"><label for="FromDate">From Date </label>
												<i class="fa fa-calendar"></i>
											</div>
											<input class="form-control"  required id="FromDate" name="FromDate" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" type="text" placeholder="mm/dd/yyyy">
										</div>										
										<div class="col-xs-6">
											<div class="input-group-addon"><label for="ToDate">To Date </label>
												<i class="fa fa-calendar"></i>
											</div>
											<input class="form-control"  required id="ToDate" name="ToDate" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" type="text" placeholder="mm/dd/yyyy">
										</div>
									</div>
	
								</div><!-- /.box-body -->
							</div>
								
							<!-- /.box -->
                        </div><!--/.col (left) -->
						
						<!-- right column -->
						<div class="col-md-6">
							<!-- Top right start-->	
                            <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Basic Informations</h3><div class="pull-right box-tools">                                        
                                    </div>
                                </div><!-- /.box-header -->
                                <!-- form start -->
								<div class="box-body">

									<div class="form-group row">
										<div class="col-xs-6">
											<label for="PhotoPath">PhotoPath</label>
											<input type="file" id="PhotoPath" name="PhotoPath" onchange="readImageURL(this);">
											<p class="help-block">Maximum size 2 MB,</p><p class="help-block"> The size of the Cover Photo should be 600x400</p>
										</div>
										<div class="col-xs-6">
											<?php	
											$imagePath="images/events/";
											$imageUrl= $imagePath."holymass.jpg";
											?>
											<img id="coverimage" src="<?php echo $imageUrl; ?>" alt=""  width="100%;" />
										</div>
									</div>
								</div><!-- /.box-body -->
							</div>							
													                            
							<div class="box ">
							<!-- /.box-header -->
							<div class="box-footer" style="text-align:center;">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
							</div>						
                           <!-- /.box -->
                        </div>
                     </form>  
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
       
        <!-- bootstrap date picker -->
		<script src="js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>

		<!-- bootstrap data tables -->
		<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>


       
        <!-- AdminLTE App -->
       		<script type="text/javascript">
			
            $(function() {
				/* >>>>>>>>>>>>>>>>>>>>>>>>>on form submit<<<<<<<<<<<<<<<<<<<<<<<<<< */


				/* checkbox entry */
//				$('input').iCheck('toggle');
				$('input').on('ifChanged');
				/* >>>>>>>>>>>> apply fields>>>>>>>>>>>>>>>>>>>>> */

					
				$("#FromDate").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
				$("#ToDate").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                 $('#FromDate').datepicker({format: 'mm/dd/yyyy'});
               $('#ToDate').datepicker({format: 'mm/dd/yyyy'});
				
				$("[data-widget='collapse']").click();
                //Datemask mm/dd/yyyy
                $("#datemask").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Money Euro
                $("[data-mask]").inputmask();
				
              
                
            });
        </script>
    
    </body>
</html>
