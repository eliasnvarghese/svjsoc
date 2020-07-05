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
$regUId=$_REQUEST["uid"];
$userServiceObj= new RegUserService();									
$messageServiceObj=new MessageService();
$userAccountObj=$userServiceObj->getUserAccountByUId($regUId);
$regUserId=$userAccountObj->getUserId();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>View User</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/adminlte.css" rel="stylesheet" type="text/css" />

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
			.box {
				margin-bottom: 0px;
			}
			.grid_cols{
	padding-left:1px;
	padding-right:1px;
}
.table {
    width: 92%;
    max-width: 100%;
    margin: 10px 5px 20px 10px;
}
.table thead tr{
	font-weight:bold;
	 background: #c0c0c0 none repeat scroll 0 0;
}
.table tbody tr:hover{
	 background: #e5e3e3 none repeat scroll 0 0;
}
.modal {
  text-align: center;
}
		</style>
  <script src="js/jquery.js" type="text/javascript"></script>
  <script src="js/facebox.js" type="text/javascript"></script>
  	<script type="text/javascript" src="js/jquery.min.js"></script>
		<script>
		

   function addPosting(){
alert("aaaa");


        // Get form
        var form = $('#fileUploadForm')[0];

		// Create an FormData object
        var data = new FormData(form);

		// If you want to add an extra field for the FormData
        data.append("CustomField", "This is some extra data, testing");

		// disabled the submit button
        $("#btnSubmit").prop("disabled", true);

        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "/api/upload/multi",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (data) {

                $("#result").text(data);
                console.log("SUCCESS : ", data);
                $("#btnSubmit").prop("disabled", false);

            },
            error: function (e) {

                $("#result").text(e.responseText);
                console.log("ERROR : ", e);
                $("#btnSubmit").prop("disabled", false);
            }
        });
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
                        View User
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">User</a></li>
                        <li class="active">Edit </li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                      <form action="editcountry_action.php" role="form" id="empForm" method="POST" enctype="multipart/form-data" >    <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Basic Informations</h3>
									<div class="pull-right box-tools"> 
										<div class="col-xs-12 contact-form-area" style="text-align:center;">
										<?php	
										$imagePath="uploads/user/";
										$imageUrl= $imagePath.$regUId.".jpg";
										if(!file_exists($imageUrl)){
											$imageUrl= "images/user/".strtolower($userAccountObj->getGender()).".jpg";
										}
										?>
										<img style="border:solid 1px #c0c0c0;border-radius:10px;" id="coverimage" src="<?php echo $imageUrl; ?>" alt=""  width="50%"  />
										</div>									
                                    </div>
                                </div><!-- /.box-header -->
                                <!-- form start -->
								<div class="box-body">
									
									<div class="row">
										<div class="col-md-12">
											<label>Name</label>
											<input class="form-control" type="text" readonly placeholder="Enter your name" name="firstname" value="<?php echo $userAccountObj->getName();?>"/>
										</div>                                        
										<div class="col-md-6" >
											<label for="LocalPhone">Phone </label>
											<input type="text" class="form-control" readonly id="LocalPhone" name="LocalPhone" placeholder="Phone" value="<?php echo $userAccountObj->getPhoneNumber();?>">
										</div>
										<div class="col-md-6" >
											<label for="MobileNo">Mobile No.</label>
											<input type="text" class="form-control" readonly id="MobileNo" name="MobileNo" placeholder="Mobile Number" value="<?php echo $userAccountObj->getMobileNumber();?>">
										</div>									
										<div class="col-md-12">
											<label for="Email">Email </label>
											<input type="text" class="form-control" readonly id="Email" name="Email" placeholder="Email Address" value="<?php echo $userAccountObj->getEmail();?>">
										</div>
										<div class="col-md-6">
											<label>Gender</label>
											<?php $gender= $userAccountObj->getGender();?>
											<select class="form-control" readonly id="Gender" name="Gender">
											<option value="Male" <?php echo ($gender=="Male")? "selected" : "";?>>Male</option>
											<option value="Female" <?php echo ($gender=="Female")? "selected" : "";?>>Female</option>
											</select>
										</div>

										<div class="col-md-6">
											<label class=" control-label">Date of birth</label>
											<input class="form-control"  readonly id="Dob" name="Dob" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" type="text" placeholder="mm/dd/yyyy" value="<?php echo dateDisplayFormat($userAccountObj->getDOB(),'m-d-Y');?>">
										</div>	
										<div class="col-md-12">
											<label for="LocalAdr1">Address </label>
											<textarea class="form-control" readonly id="LocalAdr1" name="LocalAdr1" rows="2" required placeholder="Address"><?php echo $userAccountObj->getFullAddress();?></textarea>
										</div>		
										<div class="col-md-6">
											<label for="LocalCity">City </label>
											<input type="text" class="form-control" readonly  id="LocalCity" name="LocalCity" required placeholder=" City" value="<?php echo $userAccountObj->getCity();?>">
										</div>
										<div class="col-md-6" >
											<label for="LocalState">State </label>
											<input type="text" class="form-control" readonly id="LocalState" name="LocalState" placeholder="State" value="<?php echo $userAccountObj->getState();?>">
										</div>
										
										
									</div>
								</div><!-- /.box-body -->
							</div>
							<div class="box ">
							
							</div>		
							<!-- /.box -->
                        </div><!--/.col (left) -->
							</form>
						<!-- right column -->
						<div class="col-md-6">
							<!-- Top right start-->	
				
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
       
        <!-- AdminLTE App -->
       		<script type="text/javascript">
			
            $(function() {
				/*** Function to delete photogallery **/					
				$('.delete-galery').click(function(e){
						var postingId = this.id;	
					var answer = confirm("Are you sure you want to delete this image "+postingId+"?");						
					if (answer){									
						var post_data = {'act':'deletePosting','postingId':postingId};							
						//Ajax post data to server
						 $.post('commonaction.php', post_data, function(response){									
								location.reload();
						}).fail(function(err) {alert(err)});			
					} else {		
						return false;
					}						
				});

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
