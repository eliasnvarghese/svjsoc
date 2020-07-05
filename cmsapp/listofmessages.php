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
require_once('includes/utility.php'); 

$direction="in";
if(isset($_REQUEST["dir"])){
	$direction=$_REQUEST["dir"];
	if($direction!="in" && $direction!="sent")
		$direction="in";
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>St Stephen Church| List of Messages </title>
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
					<?php $newDirection=(($direction=="in")?"sent" : "in");?>
                    <h1>
                       List of <?php echo ucfirst($direction);?> Messages
                        <small><a href="listofmessages.php?dir=<?php echo $direction;?>">Refresh</a>
						&nbsp; <a href="listofmessages.php?dir=<?php echo $newDirection;?>">
							<?php echo ucfirst($newDirection);?> Messages</a></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
					
                        <li><a href="listofmessages.php?dir=<?php echo $newDirection;?>">
							<?php echo ucfirst($newDirection);?> Messages</a>
						</li>
                        <li class="active"><a href="listofmessages.php?dir=<?php echo $direction;?>">Refresh</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

                            <div class="box">
                                <div class="box-header">
                                   
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                             <tr>
                                                <th width="10%">Date & Time</th>
                                                <th width="15%">
												<?php echo ($direction=='in') ? "From" : "To"; ?>
													</th>
                                                <th width="15%">Name</th>
                                                <th width="25%">Subject</th>
                                                <th >Message</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$messageServiceObj=new MessageService();
										if($direction=='in'){
											$results=$messageServiceObj->getInMessages('DATALIST','all',0,9999);
										}
										else{
											$results=$messageServiceObj->getSentMessages('DATALIST','all',0,9999);
										}
										while($row=mysqli_fetch_array($results)){
										?>
										<tr>
											<td><?php echo dateDisplayFormat($row["createdon"],"m-d-Y H:i:s"); ?></td>
											<td><?php echo ($direction=='in') ? $row["fromaddress"] : $row["toaddress"];?></td>
											<td><?php echo $row["name"]; ?></td>
											<td><?php echo $row["subject"]; ?></td>
											<td><?php echo $row["message"]; ?></td>
											
										</tr>
										<?php 	
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
                $("#examplex").dataTable();
                $('#example1').dataTable({
					 "aaSorting": [[ 0, "desc" ]],
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
				$('#example2').dataTable({
                    "bPaginate": true,
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
