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

$expenseCode = "";
$id = "";
$transDate = date('d-m-Y');
$narration = "";
$amount = "";
$expenseHead = "";
if(isset($_REQUEST['id'])){ 
	$id = $_REQUEST['id'];	
	if($id != ''){
		$expenseServiceObj = new ExpenseService();		
		$results = $expenseServiceObj->getData($id);		
		while($row=mysqli_fetch_array($results)){
			$expenseCode = $row["expensecode"];
			$transDate = $row["transdate"];
			$narration = $row["narration"];
			$amount = $row["amount"];			
		}		
		$expenseHeadServiceObj = new ExpenseHeadService();	
		$results = $expenseHeadServiceObj->getData($expenseCode);
		while($row=mysqli_fetch_array($results)){
			$expenseHead = $row["description"];				
		}
	}
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Expense</title>
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
                    <h1>Edit Expense</h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Accounts</a></li>
                        <li class="active">  Edit Expense</li>
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
                                <div class="box-body">  
									<form action="addupdexpense_action.php" method="POST" >
										<input type="hidden" value="<?php echo $id;?>" id="expenseId" name="expenseId"/>
										<div class="form-group row">
																
											<div class="col-xs-6">
												<div class="input-group">
													<div class="input-group-addon"><label for="Dob">Date</label>
														<i class="fa fa-calendar"></i>
													</div>
													<input class="form-control" id="transDate" name="transDate" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" type="text" placeholder="mm/dd/yyyy" value="<?php echo date("m-d-Y",strtotime($transDate));?>">
												</div>		
											</div>		
										</div>										 
									
										<div class="form-group">
											<label for="code">Code </label>
											<input type="text" class="form-control" id="code" name="code" value="<?php echo $expenseCode;?>" readonly>
										</div>
										<div class="form-group">
										<label for="Head">Head </label>											
											<textarea class="form-control" id="description" name="description" rows="1"  readonly ><?php echo $expenseHead;?></textarea>
										</div>
										<div class="form-group">
											<label for="Narration">Narration </label><p>
											<textarea class="form-control" id="narration" name="narration" rows="1"   required ><?php echo $narration;?></textarea>
										</div>	
						
								<div class="form-group row">
									<div class="col-xs-6">
										<div class="input-group">
											<div class="input-group-addon"><label for="Amount"></label>
												<i class="fa fa-dollar"></i>
											</div>
       <input type="number" required id="amount" name="amount" min="0" step="0" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" value="<?php echo $amount;?>" />
										</div>		
									</div>		
								</div>	
										<div class="box ">
									<!-- /.box-header -->
									
										<div class="box-footer" style="padding-left:240px">
											<input type="submit" class="btn btn-primary"  id="btn-Save" name="btn-Save" value="Save" />
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<a href="addexpense.php?stat=new"><input type="button" class="btn btn-primary"  id="btn-New" name="btn-New" value="New" /></a>
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
							<!--right bottom -->
							<div class="box box-primary">
								<div class="box-header">
									<h3 class="box-title">List Of Expense Heads </h3><div class="pull-right box-tools"></div>
								</div><!-- /.box-header -->
								<div class="box-bodyx">
									<div class="box-bodyx table-responsive">
										<table id="table-head" class="table table-bordered table-striped">
											<thead>
												<tr><th>Code</th><th>Head</th><th>Action</th></tr>
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
													<td><a href="#" class="add-expense" id="<?php echo $row["expensecode"]; ?>"><i class="fa fa-plus-square" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add"></i></a>																														
												</tr>
											<?php 	
											}
											?>														
											</tbody>
											
										</table>												
									</div>
								</div><!-- /.box-body -->										
								<div class="box-footer">      </div>                              
							</div>	
							<div class="box box-primary">
								<div class="box-header">
									<h3 class="box-title">List Of Expenses </h3>
								</div><!-- /.box-header -->
								<div class="box-bodyx">
									<div class="box-bodyx table-responsive">
										<table id="table-expense" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th>Id</th>
													<th>Code</th>
													<th>Narration</th>
													<th>Amount</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
											<?php													
											$expenseServiceObj = new ExpenseService();													
											$results=$expenseServiceObj->getExpenseListForPeriod('DATALIST',date('Y-m-d'),date('Y-m-d'));
											while($row=mysqli_fetch_array($results)){
											?>
												<tr>																	
													<td><?php echo $row["expenseid"]; ?></td>									
													<td><?php echo $row["expensecode"]; ?></td>																
													<td class="narration-list" id="narration<?php echo $row["expensecode"]; ?>"><?php echo $row["narration"]; ?></td>																
													<td class="amount-list" id="amount<?php echo $row["expensecode"]; ?>"><?php echo $row["amount"]; ?></td>
													<td><span id="<?php echo $row["expenseid"]; ?>" class="edit-expense"><a href="editexpense.php?id=<?php echo $row["expenseid"]; ?>"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i></a></span>
													&nbsp;&nbsp;&nbsp;<a href="delete_expense.php?id=<?php echo $row["expenseid"]; ?>"><span id="<?php echo $row["expenseid"]; ?>" style="color:red;" class="delete-expense"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i></span></a>
													</td>															
												</tr>
											<?php 	
											}
											?>														
											</tbody>
										</table>												
									</div>
								</div><!-- /.box-body -->												
								<div class="box-footer">      </div>                              
							</div>	
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
				<script src="js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>

		<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
       		<script type="text/javascript">
			
            $(function() {	
					$('#btn-Save').click(function(e){						
						code=$("#code").val();	
						amt=$("#amount").val();	
						narr=$("#narration").val();
						if(code==""){
							alert("Please Select an Expense Head!");
							return false;
						}
						if(narr==""){
							alert("Please Enter Narration!");
							$("#narration").focus();
							return false;
						}
						if(amt<=0 ){
							alert("Please Enter Amount!");
							$("#amount").focus();
							return false;
						}
						return true;
					});	
					$('.add-expense').click(function(e){						
						var descId = "#descript"+this.id;						
						$("#description").val($(descId).html());
						$("#code").val(this.id);		
					});
					/*
					$('.delete-expense').click(function(e){
						var answer = confirm("Are you sure you want to delete this item?");						
						if (answer){
							var descId = "#narration"+this.id;					
							$("#narration").val($(descId).html());
							$("#code").val(this.id);
							var amountId = "#amount"+this.id;
							$("#amount").val($(amountId).html());
							$("#btn-Save").val('Delete');						
						} else {							
							return false;
						}						
					});	*/			
					
                //Money Euro
                $("[data-mask]").inputmask();  

				$("#transDate").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                $('#transDate').datepicker({format: 'mm/dd/yyyy', endDate: '<?php echo date('m-d-Y'); ?>'}); 
				
            });
						

        </script>
		<script type="text/javascript">
            $(function() {
                $('#table-expense').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": false,
					"iDisplayLength": 10
                });
                $('#table-head').dataTable({
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