<?php ob_start(); ?>
<?php session_start() ?>
<?php 
include("includes/usercredentials.php");
$regUserService=new RegUserService();
$action=isset($_REQUEST["act"])?$_REQUEST["act"]:"add";
$UserId=$Name=$FamilyName=$Gender=$Dob=$MaritalStatus=$SpouseName=$Address=$City=$State=$Mobile=$Phone=$About=$AboutFamily="";
$userAccount=$regUserService->getUserAccountByUId($uId);
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
	header("Location:myaccount.php");
	exit();
}		
$Dob=dateDisplayFormat($Dob,"m/d/Y");
$memberId=isset($_REQUEST["membid"])?$_REQUEST["membid"]:0;
$memberName=$memberReln=$memberGender=$memberDob="";
if($memberId>0){
	$othMemberObj=$regUserService->getMember($uId,$memberId);
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
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Account of St. Stephen's Jacobite Syriac Orthodox Church, San Jose, California</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=Noto+Serif:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<!-- Styles -->
<link href="font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/owl-carousel.css" type="text/css" />
<link rel="stylesheet" href="css/mediaelementplayer.min.css" />
<link href="css/revolution.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/settings.css" media="screen" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link href="css/responsive.css" rel="stylesheet" type="text/css" />
<link rel="alternate stylesheet" type="text/css" href="css/colors/red.css" title="color1" />
<link rel="alternate stylesheet" type="text/css" href="css/colors/wedgewood.css" title="color2" />
<link rel="stylesheet" type="text/css" href="css/colors/blue.css" title="color3" />
<link rel="alternate stylesheet" type="text/css" href="css/colors/green.css" title="color4" />
<link rel="alternate stylesheet" type="text/css" href="css/colors/darkgreen.css" title="color5" />

		<link href="cmsapp/css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
		
<style>
.member-detail {
 position: relative;
	}
.logo img{
	width:auto;
}
.theme-form textarea {
    height: auto;
    max-width: 100%;
    min-height: 60px;
}
.page-top {
    padding-bottom: 1px; 
    padding-top: 30px;
}
</style>
</head>
<body>
<div class="theme-layout">
<?php include("includes/pageheader.php");?>
<div class="page-top">
	<div class="parallax" style="background:url(images/parallax8.jpg);"></div>	
	<div class="container"> 
		<h1><span> Add / Edit - My Members</span></h1>
		<ul>
			<li><a href="myaccount.php" title="">Back</a></li>
		</ul>
	</div>
</div><!--- PAGE TOP -->
<section>
	<div class="block" style="padding: 40px 0;">
		<div class="container">
			<div class="row">
				<!-- left column -->
				<div class="col-md-6 column">
					<div class="team-single">
						<div class="member-img" style="width:30%">
							<?php
							$imageUrl="cmsapp/uploads/user/".$uId.".jpg";
							if(!file_exists($imageUrl)){
								$imageUrl="cmsapp/images/user/dummy.jpg";
							}
							?>
							<img src="<?php echo $imageUrl;?>" alt="" />
						</div>
						<div class="team-detail"  style="width:70%">
							<h3 style="text-transform: uppercase;"><?php echo $userAccount->getName();?></h3>
							<ul class="team-list">
								<?php $address=makeAddress(array($userAccount->getFullAddress(),$userAccount->getCity(),$userAccount->getState()));?>
								<li><i class="fa fa-home" style="font-size:24px"></i> <?php echo $userAccount->getFamilyName();?></li>
							</ul>
						</div>
					</div><!-- TEAM SINGLE -->
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
									$membersArray=$regUserService-> getMembers($uId); 
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
										<a href="addmymember.php?membid=<?php echo $memberObj->getMemberId(); ?>&act=update"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i></a>
										&nbsp;&nbsp;<a href="addmymember.php?membid=<?php echo $memberObj->getMemberId(); ?>&act=del"><i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i></a>
										</td>
									</tr>
								<?php 	
									}
								?>
								</tbody>
							</table>
						</div><!-- /.box-body -->
					</div>	
				</div><!--/.col (left) -->
				<!-- right column -->
				<aside class="col-md-6 sidebar column">
					<!-- Top right start-->	
					 <form onsubmit="return validateform();" action="content_action.php" role="form" id="MemberForm" name="MemberForm" method="POST" enctype="multipart/form-data" >   
						<!-- Top right start-->	
						<div class="box box-info">
							<div class="box-header">
								<h3 class="box-title">Add / Edit Member</h3>
								<div class="pull-right box-tools">                                        
								</div>
							</div><!-- /.box-header -->
							<!-- form start -->
							<div class="box-body">
									<input type="hidden" hidden id="form" name="form" value="member" >
									<input type="hidden" hidden id="formaction" name="formaction" value="<?php echo $action; ?>" >
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
								<a href="addmymember.php"><button type="button" class="btn btn-primary">Cancel</button></a>
							</div>
						</div>								
					   <!-- /.box -->
					</form>  						
				   <!-- /.box -->
				</aside>
			</div>
		</div>
	</div>
</section>	
<?php include("includes/pagefooter.php");?>
</div>
	<!-- SCRIPTS-->
	<script type="text/javascript" src="js/modernizr.custom.17475.js"></script>
	<script src="js/jquery.1.10.2.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.poptrox.min.js" type="text/javascript"></script>
	<script src="js/enscroll-0.5.2.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
	<script src="js/mediaelement-and-player.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/styleswitcher.js"></script>
	<script src="js/jquery.isotope.min.js"></script>
	<script src="js/jquery.minimalect.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.downCount.js"></script> 
	
		<script src="cmsapp/js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="cmsapp/js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="cmsapp/js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
       
        <!-- bootstrap date picker -->
		<script src="cmsapp/js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>

	<script>
	  $(function() {
				/* >>>>>>>>>>>>>>>>>>>>>>>>>on form submit<<<<<<<<<<<<<<<<<<<<<<<<<< */
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
				//$('input').on('ifChanged');
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
	$(window).load(function(){
		$(function(){
			var $portfolio = $('.mas-gallery');
			$portfolio.isotope({
			masonry: {
			  columnWidth: 1
			}
			});
		});
	});
	</script>
	<script>
    $(document).ready(function() {
		$("#select1").minimalect({ theme: "bubble", placeholder: "Select Gender" });
		$("#select2").minimalect({ theme: "bubble", placeholder: "Select Age" });
		$("#select3").minimalect({ theme: "bubble", placeholder: "Select Your Area" });
		$(".tweets-slides").owlCarousel({
			autoPlay: 5000,
			slideSpeed:1000,
			singleItem : true,
			transitionStyle : "fadeUp",		
			navigation : false
		}); /*** TWEETS CAROUSEL ***/
		$(".team-carousel").owlCarousel({
			autoPlay: 8000,
			rewindSpeed : 3000,
			slideSpeed:2000,
			items : 4,
			itemsDesktop : [1199,3],
			itemsDesktopSmall : [979,2],
			itemsTablet : [768,2],
			itemsMobile : [479,1],
			navigation : false,
		}); /*** TEAM CAROUSEL ***/
	});	
	$('audio,video').mediaelementplayer();
	</script>
	<!-- SLIDER REVOLUTION -->
    <script type="text/javascript" src="js/revolution/jquery.themepunch.tools.min.js"></script>   
    <script type="text/javascript" src="js/revolution/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="js/revolution/extensions/revolution.extension.slideanims.min.js"></script>
	<script type="text/javascript" src="js/revolution/extensions/revolution.extension.layeranimation.min.js"></script>
	<script type="text/javascript" src="js/revolution/extensions/revolution.extension.navigation.min.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function() { 
		   jQuery("#slider1").revolution({
		      sliderType:"standard",
		      sliderLayout:"fullwidth",
		      delay:9000,
		      navigation: {
		          arrows:{enable:true} 
		      }, 
		      gridwidth:1100,
		      gridheight:500
		    }); 
		}); 
	</script>
</body>