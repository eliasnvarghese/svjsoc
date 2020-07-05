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
        <title>St Stephen Church| List of Registered Users </title>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                       List of Members
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Tables</a></li>
                        <li class="active">Data tables</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
								<?php 
								$searchString=(isset($_REQUEST['searchString']))? $_REQUEST['searchString']:"";
								$fromDateFilter=false;
								$toDateFilter=false;
								$keywordFilter=true;
								$keywordTitle="Name";
								$monthFilter=false;
								$yearFilter=false;
								include('includes/inc_periodfilter.php'); 
								?>                                 
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                             <tr>
                                                <th>Uid</th>
                                                <th>Name</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$userServiceObj= new RegUserService();
										$RESULTDATACOUNT=$userServiceObj->getAllRegUsers('DATACOUNT',$searchString);
										if($RESULTDATACOUNT>0){
											$results=$userServiceObj->getAllRegUsers('DATALIST',$searchString,0,99999999);
											while($row=mysqli_fetch_array($results)){
											?>
												<tr>
													<td><?php echo $row["uid"]; ?></td>
													<td><?php echo ucfirst($row["name"]); ?></td>
													<td><?php echo $row["city"]; ?></td>
													<td><?php echo $row["state"]; ?></td>
													<td><?php echo $row["mobilenumber"]; ?></td>
													<td><?php echo $row["email"]; ?></td>
													<td>
													<a href="addincome.php?uid=<?php echo $row["uid"]; ?>"><i class="fa fa-money" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cash Receipt"></i></a>
													</td>
												</tr>
										<?php 	
											}
										}
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
        <!-- AdminLTE App -->
        <script src="js/adminlte/app.js" type="text/javascript"></script>
       
        <!-- page script -->
        <script type="text/javascript">
            $(function() {
                $("#example2").dataTable();
                $('#example1').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>

    </body>
</html>
