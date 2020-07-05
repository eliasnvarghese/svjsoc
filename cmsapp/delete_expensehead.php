<?php 
ob_start();
session_start(); 
$sessionid=session_id();
if(!isset($_SESSION['StStephenChurch_AdminUserData'])){
	header("Location:login.php");
}
function __autoload($className){
	$className=strtolower($className);
	require_once "./classes/{$className}_class.php";
}
include_once("includes/utility.php"); 
$code = "";
$description = "";
$dataExists=false;
if(isset($_REQUEST['code'])){ 
	$code = $_REQUEST['code'];	
	if($code != ''){
		$expenseHeadServiceObj = new ExpenseHeadService();
		$results = $expenseHeadServiceObj->getData($code);
		while($row=mysqli_fetch_array($results)){			
			$description= $row["description"];						
		}	
		$expenseServiceObj = new ExpenseService();
		$dataExists = $expenseServiceObj->isDataExistsOfHead($code);
	}
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Delete Expense Head</title>
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
                        Delete Expense Head
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
								
                                <form action="delete_exphead_action.php" method="POST" >
								<input type="hidden" value="<?php echo $code;?>" id="headId" name="headId"/>
                                    <div class="box-body">   
		
									<div class="form-group">
										<label for="exampleInputEmail1">Code </label>
										<input type="text" class="form-control" id="code" name="code" placeholder="Code" value="<?php echo $code;?>" readonly>
									</div>
									<div class="form-group">
										<label for="LocalAdr1">Head </label><p><?php echo showMessage('errorExpenseHead') ;?></p>
										<textarea class="form-control" id="description" name="description" rows="2" placeholder="Description" readonly ><?php echo $description;?></textarea>
									</div>	
									
								<div class="box ">
							<!-- /.box-header -->
							
								<div class="box-footer" style="padding-left:220px">
								<?php $property=""; if($dataExists ==true){ $property="disabled='disabled'";} ?>
									<input type="submit" readonly <?php echo $property; ?> class="btn btn-primary"  id="btn-Delete" name="btn-Delete" value="Delete" />
									<input type="button" class="btn btn-primary" onclick="location.href='addexpensehead.php'" value="New" />
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
									<h3 class="box-title">List Of Heads </h3><div class="pull-right box-tools"> 
								</div>
							</div><!-- /.box-header -->
										<div class="box-body">

											<div class="row" id="allowanceTable">
											<div class="box-body table-responsive">
												<table id="example3" class="table table-bordered table-striped">
													<thead>
														<tr>
															<th>Code</th>
															<th>Head</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													<?php													
													$expenseHeadServiceObj = new ExpenseHeadService();													
													$results=$expenseHeadServiceObj->getActiveHeadList();
													while($row=mysqli_fetch_array($results)){
													?>
														<tr>
															<td><?php echo $row["expensecode"]; ?></td>																
															<td class="description-list" id="descript<?php echo $row["expensecode"]; ?>"><?php echo $row["description"]; ?></td>
															<td>
															<span id="<?php echo $row["expensecode"]; ?>" class="editHead"><a href="addexpensehead.php?code=<?php echo $row["expensecode"]; ?>"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i></a></span>
															&nbsp;<a href="delete_expensehead.php?code=<?php echo $row["expensecode"]; ?>"><span id="<?php echo $row["expensecode"]; ?>" style="color:red;" class="deleteHead"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i></span></a>
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
		<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
       		<script type="text/javascript">
			
            $(function() {				
					$('#btn-Delete').click(function(e){						
						var answer = confirm("Are you sure you want to delete this Item?");													
						if (answer){							
							return true;							
						} else {						
							return false;
						}						
					});								
                //Money Euro
                $("[data-mask]").inputmask();  
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
