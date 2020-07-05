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
<?php require_once('includes/utility.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>User Activity</title>
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
					<?php 
						$fromDate=(isset($_REQUEST['fromDate']))? getDbDate($_REQUEST['fromDate']) : date("Y/m/d");;
						$toDate=(isset($_REQUEST['toDate']))? getDbDate($_REQUEST['toDate']) : $fromDate;
					?>
					<h1>
                       Login Activity
                       
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Admin</a></li>
                        <li><a href="">Login Activity</a></li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Login Activity</h3>
                                </div><!-- /.box-header -->
								
<form action="<?php echo $thisPage; ?>" role="form" method="GET" id="empForm" >  
	<div class="form-group ">
		<div class="col-xs-5">
			<label>From</label>
			<input type="text" class="form-control"  id="fromDate" name="fromDate" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask=""  placeholder="From Date">
		</div>
		<div class="col-xs-5">
			<label>To</label>
			<input type="text" class="form-control"  id="toDate" name="toDate" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" placeholder="To Date">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-xs-1"><label>&nbsp;</label><button type="submit" class="btn btn-primary">Submit</button></div>
	</div>
</form>								
                                <div class="box-body table-responsive">

                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
												<tr>			
													<th>User Id</th>
													<th>Name</th>
													<th>Date </th>
													<th>Host Name</th>
													<th>Activity Performed</th>
												</tr>
                                        </thead>
                                        <tbody >
                                            <?php
												
												
												//$RESULTDATACOUNT=;
												$userService = new AdminUserService();
												$results=$userService->getUserActivityByPeriod($fromDate,$toDate,'Login');
												$resultArray=SqlExecution :: getResultArray($results);
												for($j=0;$j<sizeof($resultArray);$j++){
													$row=$resultArray[$j];
													$photopath=trim($row["photopath"]);
													if($photopath=="")
													{
														$photopath="img/avatar6.png";
													}
												?>
												<tr>
													<td><?php echo trim($row["userid"]); ?><br><img src="<?php echo $photopath; ?>" width="28" height="28" /></td>
													<td><?php echo $row["firstname"]; ?></td>
													<td><?php echo  date("m-d-Y",strtotime($row["createdon"])); ?></td>
													<td><?php echo $row["hostname"]; ?></td>
													<td style="text-align:right;margin-right:5px;"><?php echo $row["activityperformed"]; ?></td>
												</tr>
												<?php 
												} ?>
											<?php 
											 ?>
                                        </tbody>
                                        
                                    </table>
                                </div><!-- /.box-body -->
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
		<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/adminlte/app.js" type="text/javascript"></script>

        <!-- page script -->
        <script type="text/javascript">
            $(function() {
			$('#printAll').click(function(){
				window.print();
			});
			$('#saveAs').click(function(e){
				var url=e.target.name;
				if(url!=""){
					var openurl="loginactivity_pdf.php?"+url;
					window.open(openurl, '_blank');
				}
			});
				$("[data-mask]").inputmask();
                $("#example1").dataTable();
                $("#example2").dataTable();
            });
        </script>

    </body>
</html>
