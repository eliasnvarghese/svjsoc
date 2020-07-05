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
$action=isset($_REQUEST["act"])?$_REQUEST["act"]:"add";
$gospelid=isset($_REQUEST["gospelid"])?$_REQUEST["gospelid"]:0;
$BookOf="";
$Gospel="";
$cmServiceObj= new ContentManagementService();
$results=$cmServiceObj->getGospel($gospelid);
while($row=mysqli_fetch_array($results)){
	$BookOf=$row["bookof"]; 
	$Gospel= $row["gospel"];
}		
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add / Edit Gospel</title>
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

		function validateform(){  
			var Gospel=document.getElementById('BookOf').value;
			var bookof=document.getElementById('Gospel').value;

			 if ( Gospel=="") {
				 alert("Field should be Blank!");
				 document.getElementById('Gospel').focus;
				 return false;
			}	 
			if ( bookof=="") {
				alert("Field should be Blank!");
				document.getElementById('BookOf').focus;
				return false;
			}
			return true;
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
                        Add Gospel
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Gospel</a></li>
                        <li class="active">Add / Edit Gospel</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                      <form onsubmit="return validateform();" action="content_action.php" role="form" id="GospelForm" name="GospelForm" method="POST" enctype="multipart/form-data" >   
					  <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title"><?php echo ucfirst($action); ?></h3><div class="pull-right box-tools">                                        
                                    </div>
                                </div><!-- /.box-header -->
                                <!-- form start -->
								<div class="box-body">
						
									<div class="form-group ">
										<input type="hidden" hidden id="form" name="form" value="gospel" >
										<input type="hidden" hidden id="formaction" name="formaction" value="<?php echo $action; ?>" >
										<input type="hidden" hidden id="GospelId" name="GospelId" value="<?php echo $gospelid; ?>" >
										<label for="Universityname">Text from <span style="color:red" id="alertMsg"></span></label>
										<input type="text" class="form-control" required id="BookOf" name="BookOf" placeholder="Text From" value="<?php echo $BookOf; ?>" >
									</div>	
									<div class="form-group ">
										<label for="Overview">Gospel</label>
										<textarea class="form-control" id="Gospel" name="Gospel"  rows="2" placeholder="Gospel"><?php echo $Gospel; ?></textarea>
									</div>	
								</div><!-- /.box-body -->
							</div>
							<div class="box ">
							<!-- /.box-header -->
							<div class="box-footer" style="text-align:center;">
								<button type="submit" class="btn btn-primary"><?php echo strtoupper($action); ?></button>
								<a href="addgospel.php"><button type="button" class="btn btn-primary">Cancel</button></a>
							</div>
							</div>			
							<!-- /.box -->
                        </div><!--/.col (left) -->
						
						<!-- right column -->
						<div class="col-md-6">
							<!-- Top right start-->	
                            <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title">List of Gospels</h3><div class="pull-right box-tools">                                        
                                    </div>
                                </div><!-- /.box-header -->
                                <!-- form start -->
								<div class="box-body">
									<div class="row" id="allowanceTable">
										<div class="box-body table-responsive">
											<table id="example1" class="table table-bordered table-striped">
												<thead>
													<tr>
														<th>Text From</th>
														<th>Gospel</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
												<?php
												$results=$cmServiceObj->getAllGospels();
												while($row=mysqli_fetch_array($results)){
												?>
													<tr>
														<td><?php echo $row["bookof"]; ?></td>
														<td><?php echo $row["gospel"]; ?></td>
														<td>
														<a href="addgospel.php?act=update&gospelid=<?php echo $row["gospelid"]; ?>">Edit</a>
														&nbsp;&nbsp;<a href="addgospel.php?act=delete&gospelid=<?php echo $row["gospelid"]; ?>">Del</a>
														</td>
													</tr>
												<?php 	}		?>
												</tbody>
											</table>										
										</div>
									</div>
								</div><!-- /.box-body -->
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
				$('#GospelForm').submit(function(){
					console.log("aaaaaaaaaaaaaaaaaaaaa");
					 var fieldSet = $("#GospelForm");
      
                    input = $("<input type=\"text\" id=\"abcd\" name=\"formaction" value=\"addGospel\"/>");
                   
					fieldSet.append(input);
				}); 

                
            });
        </script>
    
    </body>
</html>
