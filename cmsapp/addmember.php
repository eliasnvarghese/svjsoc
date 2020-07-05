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
$action=isset($_REQUEST["act"])?$_REQUEST["act"]:"add";

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
$memberId=isset($_REQUEST["membid"])?$_REQUEST["membid"]:0;
$memberName=$memberReln=$memberGender=$memberDob="";
if($memberId>0){
	$othMemberObj=$regUserServiceObj->getMember($regUId,$memberId);
	if($othMemberObj!=null){
		$memberName=$othMemberObj->getName();
		$memberReln=$othMemberObj->getRelation();
		$memberGender=$othMemberObj->getGender();
		$memberDob=$othMemberObj->getDob();
		$memberDob=dateDisplayFormat($memberDob,"m/d/Y");
	}	
	else{
		header("Location:listofregusers.php");
		exit();
	}
	$action=($action=="add")?"update":$action;
}
$caption=$action;
$caption=($caption=="del")? "Delete" : $caption;
$caption=($caption=="update")? "Edit" : $caption;
$required=($action=="del")? "readonly" : "required";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Member</title>
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
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                        <?php echo $caption;?> Member
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Member</a></li>
                        <li class="active"> <?php echo $caption;?> Member</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
 					  <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-info">
								  <div class="box-header">
                                    <h3 class="box-title" style="text-transform: uppercase;"><?php echo $userAccount->getName();?></h3>
									<div class="pull-right box-tools"> 
										<div class="col-xs-12 contact-form-area" style="text-align:center;">
										<?php	
										$imagePath="uploads/user/";
										$imageUrl= $imagePath.$regUId.".jpg";
										if(!file_exists($imageUrl)){
											$imageUrl= "images/user/".strtolower($userAccount->getGender()).".jpg";
										}
										?>
										<img style="border:solid 1px #c0c0c0;border-radius:10px;" id="coverimage" src="<?php echo $imageUrl; ?>" alt=""  width="50%"  />
										</div>									
                                    </div>
                                </div><!-- /.box-header -->
                                <!-- form start -->
								<div class="box-body">
									<div class="team-detail"  style="width:70%">
										<ul class="team-list">
											<?php $address=makeAddress(array($userAccount->getFullAddress(),$userAccount->getCity(),$userAccount->getState()));?>
											<li style="list-style:none;margin-bottom: 10px;padding-inline-start: 4px;"><i class="fa fa-map-marker" style="font-size:24px"></i> <?php echo $address;?></li>
											<li style="list-style:none;margin-bottom: 10px;padding-inline-start: 4px;"><i class="fa fa-home" style="font-size:24px"></i> <?php echo $userAccount->getFamilyName();?></li>
											<li style="list-style:none;margin-bottom: 10px;padding-inline-start: 4px;"><i class="fa fa-venus-mars custom" style="font-size:24px"></i> <?php echo $userAccount->getGender();?> </li>
										</ul>
									</div>
				
								</div><!-- /.box-body -->
	
							</div>
							<div class="box box-primary">
								<div class="box-header">
									<h3 class="box-title">Family Members </h3>
								</div><!-- /.box-header -->
								<div class="box-body">
									<table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                             <tr>
                                                <th width="8%">Id</th>
                                                <th>Name</th>
                                                <th width="20%">Relation</th>
                                                <th width="5%">Gender</th>
                                                <th width="15%">Dob</th>
                                                <th width="10%">Act</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											$membersArray=$regUserServiceObj-> getMembers($regUId); 
											for($i=0;$i<sizeof($membersArray);$i++){
											$memberObj=$membersArray[$i];
											?>
											<tr>
												<td><?php echo $memberObj->getMemberId(); ?></td>
												<td><?php echo ucfirst($memberObj->getName()); ?></td>
												<td><?php echo $memberObj->getRelation(); ?></td>
												<td><?php echo $memberObj->getGender(); ?></td>
												<td><?php echo dateDisplayFormat($memberObj->getDob(),"m/d/Y"); ?></td>
												<td>
												<a href="addmember.php?uid=<?php echo $regUId; ?>&membid=<?php echo $memberObj->getMemberId(); ?>&act=update"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i></a>
												&nbsp;&nbsp;<a href="addmember.php?uid=<?php echo $regUId; ?>&membid=<?php echo $memberObj->getMemberId(); ?>&act=del"><i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i></a>
												</td>
											</tr>
										<?php 	
											}
										?>
                                        </tbody>
                                    </table>
								</div><!-- /.box-body -->
							</div>	
							<!-- /.box -->
                        </div><!--/.col (left) -->
						
						<!-- right column -->
						<div class="col-md-6">
							 <form onsubmit="return validateform();" action="content_action.php" role="form" id="MemberForm" name="MemberForm" method="POST" enctype="multipart/form-data" >   
								<!-- Top right start-->	
								<div class="box box-info">
									<div class="box-header">
										<h3 class="box-title">Add Member</h3>
										<div class="pull-right box-tools">                                        
										</div>
									</div><!-- /.box-header -->
									<!-- form start -->
									<div class="box-body">
											<input type="hidden" hidden id="form" name="form" value="member" >
											<input type="hidden" hidden id="formaction" name="formaction" value="<?php echo $action; ?>" >
											<input type="hidden" hidden id="regUId" name="regUId" value="<?php echo $regUId; ?>" >
											<input type="hidden" hidden id="memberId" name="memberId" value="<?php echo $memberId; ?>" >
										
										<div class="form-group">
											<label for="exampleInputEmail1">Name </label>
											<input type="text" placeholder="Enter Name" <?php echo $required;?> name="OthMemberName" id="OthMemberName" class="form-control" value="<?php echo $memberName; ?>"/>
										</div>
										<div class="form-group">
											<label for="exampleInputFamily">Relation </label>
											<input type="text" placeholder="Enter Relation " <?php echo $required;?> name="OthMemberReln" id="OthMemberReln" class="form-control"  value="<?php echo $memberReln; ?>"/>
										</div>
										<div class="form-group row ">
											<div class="col-xs-6">
												<label for="LocalAdr1">Gender </label>
												<select class="form-control" id="OthMemberGender" name="OthMemberGender" <?php echo $required;?>>
													<option value="Male" <?php echo ($memberGender=="Male")? "selected" : "";?>>Male</option>
													<option value="Female" <?php echo ($memberGender=="Female")? "selected" : "";?>>Female</option>
												</select>
											</div>										
											<div class="col-xs-6">
												<label for="Dob">Dob <i class="fa fa-calendar"></i></label>
												<input class="form-control" <?php echo $required;?> id="OthMemberDob" name="OthMemberDob" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" type="text" placeholder="mm/dd/yyyy" value="<?php echo $memberDob; ?>" >
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
						    </form>  
                        </div>
                    
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
				$('#MemberForm').submit(function(){
					if($('#formaction').val()=="del")
					{
						var answer = confirm("Are you sure you want to delete this member ?");						
						if (answer){									
							return true;		
						} else {		
							return false;
						}	
					}
					return true;	
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
					
				$("#OthMemberDob").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
               $('#OthMemberDob').datepicker({format: 'mm/dd/yyyy'});
				
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
