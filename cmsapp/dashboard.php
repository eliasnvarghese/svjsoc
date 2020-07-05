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
$log=new Logging();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>St Stephen Church | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
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
                        Dashboard
                        <small>Control panel</small> 
							<strong class="alert">  <?php if(isset($_SESSION["ADMINLOGINALERT"])) {
							echo $_SESSION["ADMINLOGINALERT"]; unset($_SESSION["ADMINLOGINALERT"]); 
							}?>
							</strong>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>
		
		<?php if(isset($_SESSION["ADMINLOGINALERT"])) {?>
				<div class="box-body">
					<div class="alert alert-danger alert-dismissable">
						<i class="fa fa-ban"></i>
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<b>Alert!</b> <?php echo $_SESSION["ADMINLOGINALERT"];?>
					</div>
				</div>
									<?php } ?>
                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
									<?php 
									$summaryService=new SummaryService();
									$regTotal=$summaryService->getTotalRegSummary();
									$monthRegTotal=$summaryService->getThisMonthRegSummary();
									$todayRegTotal=$summaryService->getTodaysRegSummary();
									
									$mesgTotal=$summaryService->getTotalMesgSummary();
									$monthMesgTotal=$summaryService->getThisMonthMesgSummary();
									$todayMesgTotal=$summaryService->getTodaysMesgSummary();
									
									$evntTotal=$summaryService->getTotalEvntSummary();
									$monthEvntTotal=$summaryService->getThisMonthEvntSummary();
									$todayEvntTotal=$summaryService->getTodaysEvntSummary();
																					
									?>
                                    <h2 style="margin-top:0px;">Directory</h2>
                                    <p><span style="font-weight:bold;"><?php echo $regTotal;?> </span> Total</p>
                                    <p><span style="font-weight:bold;"><?php echo $monthRegTotal;?> </span> For the Month</p>
                                    <p><span style="font-weight:bold;"><?php echo $todayRegTotal;?></span> Today</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="listofregusers.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                 <div class="inner">

                                    <h2 style="margin-top:0px;">Messages</h2>
									<p><span style="font-weight:bold;"><?php echo $mesgTotal;?> </span> Total</p>
                                    <p><span style="font-weight:bold;"><?php echo $monthMesgTotal;?> </span> For the Month</p>
                                    <p><span style="font-weight:bold;"><?php echo $todayMesgTotal;?></span> Today</p>
                                 </div>
                                <div class="icon">
                                    <i class="ion ion-ios7-people"></i>
                                </div>
                                <a href="listofmessages.php?dir=in" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                 <div class="inner">
                                    <h2 style="margin-top:0px;">Events</h2>
                                    <p><span style="font-weight:bold;"><?php echo $evntTotal;?> </span> Total</p>
                                    <p><span style="font-weight:bold;"><?php echo $monthEvntTotal;?></span> For the Month</p>
                                    <p><span style="font-weight:bold;"><?php echo $todayEvntTotal;?></span> Today</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-calendar"></i>
									
                                </div>
                                <a href="listofevents.php?dir=in" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                              <div class="inner">
                                    <h2 style="margin-top:0px;">Login</h2>
                                    <p><span style="font-weight:bold;"></span> antony : 11/11/2018 12:00</p>
                                    <p><span style="font-weight:bold;"> </span>Self : 11/11/2018 12:00</p>
                                    <p><span style="font-weight:bold;">&nbsp;</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-clock"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->

                    <!-- top row -->
                    <div class="row">
                        <div class="col-xs-12 connectedSortable">
                            
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-6 connectedSortable"> 
							<!-- Interested  Countries -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="glyphicon glyphicon-list-alt"> </i>
                                    <h3 class="box-title"> Users</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table id="example3" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>Date & Time</th>
												<th>Name </th>
												<th>Email </th>
												<th>Mobile</th>
											</tr>
										</thead>
										<tbody>
										<?php													
										$userServiceObj= new RegUserService();													
										$results=$userServiceObj->getLatestRegUsers(5);
										while($row=mysqli_fetch_array($results)){
										?>
											<tr>
												<td><?php echo dateDisplayFormat($row["createdon"],"m-d-Y"); ?></td>																
												<td class="description-list" ><?php echo $row["uid"]." - ".$row["name"]; ?></td>
												<td class="description-list" ><?php echo $row["email"]; ?></td>
												<td class="description-list" ><?php echo $row["mobilenumber"]; ?></td>
											</tr>
										<?php 	
										}
										?>														
										</tbody>
									</table>
									<a href="listofregusers.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
									</a>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->	
							 <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-envelope"></i>
                                    <h3 class="box-title">Messages</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table id="example3" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>Date & Time</th>
												<th>From</th>
												<th>Subject/Message</th>
											</tr>
										</thead>
										<tbody>
									<?php													
										$messageServiceObj = new MessageService();													
										$results=$messageServiceObj->getInMessages('DATALIST','all',0,5);
										while($row=mysqli_fetch_array($results)){
											?>
											<tr>
												<td><?php echo dateDisplayFormat($row["createdon"],"m-d-Y H:i:s"); ?></td>																
												<td class="description-list" ><?php echo $row["fromaddress"]; ?></td>
												<td class="description-list" >Sub: <?php echo $row["subject"]."<br>Mesg: ".substr($row["message"],0,75); ?></td>
											</tr>
										<?php 	
										}
										?>														
										</tbody>
									</table>
									<a href="listofmessages.php?dir=in" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
									</a>
                                </div><!-- /.box-body -->

                            </div><!-- /.box -->							
                        </section><!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-6 connectedSortable">
                            <!-- Inbox -->
                            <div class="box box-primary">							
                                <div class="box-header">
                                    <i class="fa fa-events"></i>
                                    <h3 class="box-title">Events</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
									<table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th width="15%">Event Name</th>
                                                <th>Details</th>
                                                <th width="12%">From Date</th>
                                                <th width="12%">To Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$eventServiceObj=new EventService();
										$results=$eventServiceObj->getUpComingEvents(5);
										while($row=mysqli_fetch_array($results)){
											$image="uploads/events/".$row["eventid"].".jpg";
											if(!file_exists($image))
												$image="images/events/holymass.jpg";
											?>
                                            <tr>
                                                <td><?php echo $row["eventid"]; ?></td>
                                                <td><img src="<?php echo $image; ?>" width="75%"></br><?php echo $row["eventname"]; ?></td>
                                                <td><?php echo $row["eventdetails"]; ?></td>
                                                <td><?php echo date("m-d-Y",strtotime($row["fromdate"])); ?></td>
                                                <td><?php echo date("m-d-Y",strtotime($row["todate"])); ?></td>
                                            </tr>
											<?php 	
											}
											?>
                                        </tbody>
                                    </table>
									<a href="listofevents.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
									</a>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                        </section><!-- right col -->
                    </div><!-- /.row (main row) -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="js/adminlte/app.js" type="text/javascript"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="js/adminlte/dashboard.js" type="text/javascript"></script>     
        



		 <?php 
			$frmdt=date('Y-m-d');
			$todt=date('Y-m-d',strtotime( "$frmdt +1 day" ));
			//$appointmentServiceObj=new AppointmentService();
			//$results=$appointmentServiceObj->getAppointmentListCount($frmdt); 
						
			?>
 <script>
	    //Calendar
		 var date = new Date();
			var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear();
			
    $('#calendar').fullCalendar({
        editable: false, //Enable drag and drop
        events: [
		<?php /* while($row=mysqli_fetch_array($results)){	
				$dt=date('Y',strtotime($row['appointdate'])).",".(date('m',strtotime($row['appointdate']))-1).",".date('d',strtotime($row['appointdate'])); 	
				?>
				
            {
                title: '<?php echo $row['cnt']; ?>',
                start: new Date(<?php echo $dt; ?>),
                backgroundColor: "#3c8dbc", //light-blue 
                borderColor: "#3c8dbc", //light-blue
                eventDate: "<?php echo $row['appointdate']; ?>", //light-blue
				
            },
		<?php } */?>
        
        ],
        buttonText: {//This is to add icons to the visible buttons
            prev: "<span class='fa fa-caret-left'></span>",
            next: "<span class='fa fa-caret-right'></span>",
            today: 'today',
            month: 'month',
            week: 'week',
            day: 'day'
        },
		
		dayClick: function(date, jsEvent, view) {
			dt=date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
			 var post_data = {'act':'todaysAppintment', 'date':dt};
            //Ajax post data to server
            $.post('commonaction.php', post_data, function(data){
				$('#todaysAppintmentResult').html(data);
                
            }).fail(function(err) {   alert(err)});
		},
		eventClick: function(jsEvent) {
			dt=jsEvent.eventDate;
			 var post_data = {'act':'todaysAppintment', 'date':dt};
            //Ajax post data to server
            $.post('commonaction.php', post_data, function(data){
				$('#todaysAppintmentResult').html(data);
                
            }).fail(function(err) {   alert(err)});
		},
        header: {
            left: 'title',
            center: '',
            right: 'prev,next'
        }
    });
	
	</script>
    </body>
</html>