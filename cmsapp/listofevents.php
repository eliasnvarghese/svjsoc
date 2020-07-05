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
		

$searchStr=(isset($_REQUEST['searchStr']))? $_REQUEST['searchStr'] : ''; 
$eventServiceObj=new EventService();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>List of Events </title>
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
                    <h1>
                        Events List
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Operation</a></li>
                        <li class="active">Events</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List of Events</h3>
                                </div><!-- /.box-header -->
								<!-- Search options -->
								<form action="<?php echo $thisPage; ?>" role="form" method="GET" id="empForm" >  

									<div class="form-group ">
										<div class="col-xs-5">
											<label>Search String</label>
											<input type="text" class="form-control" id="searchStr" name="searchStr" placeholder="Search String" value="<?php echo $searchStr; ?>""/>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-xs-1"><label>&nbsp;</label><button type="submit" class="btn btn-primary">Submit</button></div>
									</div>
								</form>
								<!-- End of Search options -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th width="15%">Event Name</th>
                                                <th width="15%">Highlights</th>
                                                <th>Details</th>
                                                <th width="8%">From Date</th>
                                                <th width="8%">To Date</th>
                                                <th width="8%">Created On</th>
                                                <th width="4%">Stat</th>
                                                <th width="7%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$MAXPAGENOS=3;
										$NOOFLINES=10;
										include("report/pagination.php");
										$rowNo=$pageno*$NOOFLINES-($NOOFLINES);
										$RESULTDATACOUNT=$eventServiceObj->getEventList('DATACOUNT',$searchStr);
										if($RESULTDATACOUNT>0){
										$results=$eventServiceObj->getEventList('DATALIST',$searchStr,$rowNo,$NOOFLINES);
										while($row=mysqli_fetch_array($results)){
											$image="uploads/events/".$row["eventid"].".jpg";
											if(!file_exists($image))
												$image="images/events/holymass.jpg";
										?>
                                            <tr>
                                                <td><?php echo $row["eventid"]; ?></td>
                                                <td><img src="<?php echo $image; ?>" width="75%"></br><?php echo $row["eventname"]; ?></td>
                                                <td><?php echo $row["highlights"]; ?></td>
                                                <td><?php echo $row["eventdetails"]; ?></td>
                                                <td><?php echo date("m-d-Y",strtotime($row["fromdate"])); ?></td>
                                                <td><?php echo date("m-d-Y",strtotime($row["todate"])); ?></td>
                                                <td><?php echo date("m-d-Y",strtotime($row["createdon"])); ?></td>
												<td><?php echo (($row["deleted"]==1)? "Deleted":"Active"); ?></td>
                                                <td>
													<a href="editevent.php?eventId=<?php echo $row["eventid"]; ?>"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i></a>&nbsp;
													<a href="deleteevent.php?eventId=<?php echo $row["eventid"]; ?>"><i class="fa fa-trash-o" style="color:red" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i></a>&nbsp;
												</td>
                                            </tr>
										<?php 	}
											}
											?>
                                            
                                        </tbody>
                                        
                                    </table>
									<?php
										$report_filename="listofevents.php";
										include("report/pagelink_generator.php");
									?>
	
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
              
                $('#example1').dataTable({
					/* "aoColumns": [{ "bSortable": false },
								{ "asSorting": [ "desc", "asc", "asc" ] },null,
									{ "asSorting": [ "asc" ] },
									
									
									null
								], */
					 "oLanguage": {
						/* "sInfo": "Got a total of _TOTAL_ entries to show (_START_ to _END_)" */
						"sInfo": "Showing _START_  to _END_  of <?php echo $RESULTDATACOUNT; ?> entries"
					},
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>

    </body>
</html>
