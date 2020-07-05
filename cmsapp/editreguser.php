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
$log=new Logging();
$action=isset($_REQUEST["act"])?$_REQUEST["act"]:"update";
$regUId=isset($_REQUEST["uid"])?$_REQUEST["uid"]:0;
$UserId=$Name=$FamilyName=$Gender=$Dob=$MaritalStatus=$SpouseName=$Address=$City=$State=$Mobile=$Phone=$About=$AboutFamily="";	
$regUserServiceObj= new RegUserService();
$userAccount=$regUserServiceObj->getUserAccountByUId($regUId);
if($userAccount!=null){
	$UserId=$userAccount->getUserId();
	$Name=$userAccount->getName();
	$FamilyName=$userAccount->getFamilyName();
	$Gender=$userAccount->getGender();
	$Dob=$userAccount->getDob();
	$MaritalStatus=$userAccount->getMaritalStatus();
	if($MaritalStatus!="Married" && $MaritalStatus!="Single")
		$MaritalStatus="Married";
	$SpouseName=$userAccount->getSpouseName();
	$Address=$userAccount->getFullAddress();
	$City=$userAccount->getCity();
	$State=$userAccount->getState();
	$Mobile=$userAccount->getMobileNumber();
	$Phone=$userAccount->getPhoneNumber();
	$About=$userAccount->getAboutMe();
	$AboutFamily=$userAccount->getAboutFamily();
}	
else
{
	header("Location:listofregusers.php");
	exit();
}		

$Dob=dateDisplayFormat($Dob,"m/d/Y");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit User</title>
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
			var Name=document.getElementById('Name').value;
			var UserId=document.getElementById('UserId').value;

			 if (Name=="") {
				 alert("Field should not be Blank!");
				 document.getElementById('Name').focus;
				 return false;
			}	 
			if ( UserId=="") {
				alert("Field should not be Blank!");
				document.getElementById('UserId').focus;
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
                        Edit User
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">User</a></li>
                        <li class="active">Edit User</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                      <form onsubmit="return validateform();" action="content_action.php" role="form" id="RegUserForm" name="RegUserForm" method="POST" enctype="multipart/form-data" >   
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
					
										<input type="hidden" hidden id="form" name="form" value="reguser" >
										<input type="hidden" hidden id="formaction" name="formaction" value="<?php echo $action; ?>" >
										<input type="hidden" hidden id="regUId" name="regUId" value="<?php echo $regUId; ?>" >
										<input type="hidden" hidden id="About" name="About" value="<?php echo $About; ?>" >
									<input type="hidden" hidden id="AboutFamily" name="AboutFamily" value="<?php echo $AboutFamily; ?>" >
									
									<div class="form-group">
										<label for="exampleInputEmail1">Name </label>
										<input type="text" placeholder="Enter Name" required name="Name" id="Name" class="form-control" value="<?php echo $Name; ?>"/>
									</div>
									<div class="form-group">
										<label for="exampleInputFamily">Family Name </label>
										<input type="text" placeholder="Enter Family Name" required name="FamilyName" id="FamilyName" class="form-control" value="<?php echo $FamilyName; ?>"/>
									</div>
									<div class="form-group">
										<label for="LocalAdr1">UserName </label><p><?php echo showMessage('adduserError') ;?></p>
										<input type="email"  placeholder="Enter email Id" readonly name="UserId" id="UserId" class="form-control" value="<?php echo $UserId; ?>"/>
									</div>	
									<div class="form-group row ">
										<div class="col-xs-6">
											<label for="LocalAdr1">Gender </label>
											<select class="form-control" id="Gender" name="Gender">
											<option value="Male" <?php echo ($Gender=="Male")? "selected" : "";?>>Male</option>
											<option value="Female" <?php echo ($Gender=="Female")? "selected" : "";?>>Female</option>
											</select>
										
										</div>										
										<div class="col-xs-6">
											<label for="Dob">Dob <i class="fa fa-calendar"></i></label>
											<input class="form-control"  required id="Dob" name="Dob" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" type="text" placeholder="mm/dd/yyyy" value="<?php echo $Dob; ?>">
										</div>
									</div>
									<div class="form-group row ">
										<div class="col-xs-6">
											<label for="LocalAdr1">Marital Status </label>
											<select class="form-control" id="MaritalStatus" name="MaritalStatus">
											<option value="Married" <?php echo ($MaritalStatus=="Married")? "selected" : "";?>>Married</option>
											<option value="Single" <?php echo ($MaritalStatus=="Single")? "selected" : "";?>>Single</option>
											</select>
										</div>										
										<div class="col-xs-6">
											<label for="SpouseName">Spouse Name </label>
											<input type="text"  placeholder="Enter Spouse Name" <?php echo ($MaritalStatus=="Married")? "required" : "readonly";?> name="SpouseName" id="SpouseName" class="form-control" value="<?php echo $SpouseName; ?>"/>
										</div>
									</div>
									<div class="form-group">
										<label for="LocalAdr1">Address </label>
										<textarea placeholder="Enter Address" required name="Address" rows="2" id="Address"  class="form-control" ><?php echo $Address; ?></textarea>
									</div>	
											
									<div class="form-group row ">
										<div class="col-xs-6">
											<label for="LocalAdr1">City </label>
											<input type="text"  placeholder="Enter City" required name="City" id="City" class="form-control" value="<?php echo $City; ?>"/>
										</div>	
										<div class="col-xs-6">
											<label for="LocalAdr1">State </label>
											<input type="text"  placeholder="Enter State" required name="State" id="State" class="form-control" value="<?php echo $State; ?>"/>
										</div>	
									</div>	
									<div class="form-group row ">
										<div class="col-xs-6">
											<label for="LocalAdr1">Mobile </label>
											<input type="text"  placeholder="Enter Mobile" required name="Mobile" id="Mobile" class="form-control" value="<?php echo $Mobile; ?>" />
										</div>	
										<div class="col-xs-6">
											<label for="LocalAdr1">Phone </label>
											<input type="text"  placeholder="Enter Phone" required name="Phone" id="Phone" class="form-control" value="<?php echo $Phone; ?>"/>
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
                                    <h3 class="box-title"></h3>
									<div class="pull-right box-tools">                                        
                                    </div>
                                </div><!-- /.box-header -->
                                <!-- form start -->
								<div class="box-body">
				

									<div class="form-group row ">
										<div class="col-xs-6">
										<label for="LocalAdr1">Profile Image </label>
										<input type="file" class="uniform-file" name="PhotoPath" id="PhotoPath" onchange="readImageURL(this);"/>
										</div>										
										<div class="col-xs-6">
										<?php	
										$imagePath="uploads/user/";
										$imageUrl= $imagePath.$regUId.".jpg"; 
										if(!file_exists($imageUrl))
											$imageUrl= "images/user/dummy.jpg";
										?>
											<img style="border:solid 1px #c0c0c0;border-radius:10px;" id="coverimage" alt="" src="<?php echo $imageUrl;?>" width="50%;" />
										</div>
									</div>
								</div><!-- /.box-body -->
							</div>	
							<div class="box box-primary">
								<div class="box-header">
									<h3 class="box-title">Family Members </h3>
										<!-- <div class="pull-right box-tools">                                        
										<span class="btn btn-primary btn-sm pull-right" id="AddOthMembersBlock" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></span>
										</div> -->
								</div><!-- /.box-header -->
								<div class="box-body">
									<div class="form-group row" style="padding-right:0px;">
										<div class="col-xs-5" style="padding-right:0px;">
											<label for="Name">Name</label>
										</div>
										<div class="col-xs-3" style="padding-right:0px;">
											<label for="Gender">Gender</label>
										</div>		
										<div class="col-xs-3" style="padding-right:0px;">
											<label for="Relation">Relation </label>
										</div>		
									</div>
									<div  id="OthMemberTable">
										<?php	$membersArray=$regUserServiceObj-> getMembers($regUId); 
										for($i=0;$i<sizeof($membersArray);$i++){
										$memberObj=$membersArray[$i];
										?>
										<div class="form-group row">
											<div class="col-xs-5" style="padding-right:0px;">
											<input type="text" class="form-control"  value="<?php echo $memberObj->getName(); ?>" name="OthMemberName[]" placeholder="Qualification">
											</div>
											<div class="col-xs-3"  style="padding-right:0px;">
											<select class="form-control"  id="OthMemberGender" name="OthMemberGender[]" >
												<option value="Male" <?php echo ($memberObj->getGender()=="Male")? "selected" : "";?>>Male</option>
												<option value="Female"  <?php echo ($memberObj->getGender()=="Female")? "selected" : "";?>>Female</option>
											</select>
											</div>
											<div class="col-xs-3" style="padding-right:0px;">
												<input type="text" class="form-control"  value="<?php echo $memberObj->getRelation(); ?>" id="OthMemberReln" name="OthMemberReln[]" placeholder="Relation">
											</div>	
										</div>	
										<?php } ?>								
									</div>
									<div class="form-group row" >
										<div class="col-xs-5" style="padding-right:0px;">
										<input type="text" class="form-control" id="OthMemberName"  name="OthMemberName[]" placeholder="Name">
										</div>
										<div class="col-xs-3"  style="padding-right:0px;">
											<select class="form-control" style="padding:0px 0px 0px 0px;"  id="OthMemberGender" name="OthMemberGender[]" >
												<option value="Male">Male</option>
												<option value="Female">Female</option>
											</select>
										</div>
										<div class="col-xs-3" style="padding-right:0px;">
											<input type="text" class="form-control" id="OthMemberReln"  name="OthMemberReln[]" placeholder="Relation">
										</div>	
										<div class="col-xs-1" style="padding-right:0px;">
											<a class="btn btn-primary" id="AddOthMember">Add </a>
										</div>		
									</div>		
								</div><!-- /.box-body -->
							</div>							
							<div class="box ">
							<!-- /.box-header -->
							<div class="box-footer" style="text-align:center;">
								<button type="submit" class="btn btn-primary"><?php echo strtoupper($action); ?></button>
								<a href="addreguser.php"><button type="button" class="btn btn-primary">Cancel</button></a>
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
				$('#RegUserForm').submit(function(){
					$('#AddOthMember').click();
					return true;	
				}); 
				$('#AddOthMember').click(function(){
						var name=$('#OthMemberName').val(); 
						var gender=$('#OthMemberGender').val(); 
						var reln=$('#OthMemberReln').val(); 
						if(name!=""){
							$('#OthMemberTable').append('<div class="form-group row"><div class="col-xs-5" style="padding-right:0px;"><input type="text" class="form-control" value="'+name+'" ></div><div class="col-xs-3" style="padding-right:0px;"><input type="text" class="form-control" value="'+gender+'" ></div><div class="col-xs-3" style="padding-right:0px;"><input type="text" class="form-control" value="'+reln+'" ></div></div>');
							$('#RegUserForm').append('<div  style="display:none;"><input type="text" class="form-control"  value="'+name+'" name="OthMemberName[]" ><input type="text" class="form-control" value="'+gender+'" name="OthMemberGender[]" ><input type="text" class="form-control" value="'+reln+'" name="OthMemberReln[]" ></div>');
							name=$('#OthMemberName').val(''); 
							gender=$('#OthMemberGender').val(''); 
							reln=$('#OthMemberReln').val('');  
						 }
				});
				
				/* checkbox entry */
//				$('input').iCheck('toggle');
				$('input').on('ifChanged');
				/* >>>>>>>>>>>> apply fields>>>>>>>>>>>>>>>>>>>>> */
				$("#MaritalStatus").on('change', function() {
					if ($(this).val() == 'Married'){
						$('#SpouseName').removeAttr('readonly');
					    $('#SpouseName').attr('required','required');
					} else {
						$('#SpouseName').removeAttr('required');
						$('#SpouseName').attr('readonly','readonly');
						$('#SpouseName').val('');
					}
				});
					
				$("#Dob").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
               $('#Dob').datepicker({format: 'mm/dd/yyyy'});
				
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
