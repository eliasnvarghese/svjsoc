<?php ob_start(); ?>
<?php session_start() ?>
<?php 
include("includes/usercredentials.php");
$regUserService=new RegUserService();
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
		<h1><span> Edit - My Account</span></h1>
		<ul>
			<li><a href="myaccount.php" title="">Back</a></li>
		</ul>
	</div>
</div><!--- PAGE TOP -->
<section>
	<div class="block" style="padding: 40px 0;">
		<div class="container">
			<div class="row">
				<form class="theme-form" onsubmit="return validateform();" action="content_action.php" role="form" id="RegUserForm" name="RegUserForm" method="POST" enctype="multipart/form-data" >   
				  <!-- left column -->
					<div class="col-md-6 column">
						<!-- general form elements -->
						<div class="box box-info">
							<!-- form start -->
							<div class="box-body">
									<input type="hidden" hidden id="form" name="form" value="reguser" >
									<input type="hidden" hidden id="formaction" name="formaction" value="update" >
									<input type="hidden" hidden id="regUId" name="regUId" value="<?php echo $uId; ?>" >
									
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
									<textarea placeholder="Enter Address" required name="Address" id="Address"  class="form-control" ><?php echo $Address; ?></textarea>
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
					<aside class="col-md-6 sidebar column">
						<!-- Top right start-->	
						<div class="box box-info">
							<!-- form start -->
							<div class="box-body">
							
								<div class="form-group row ">
									<div class="col-xs-6">
									<label for="LocalAdr1">Profile Image </label>
									<input type="file" class="uniform-file" name="PhotoPath" id="PhotoPath" onchange="readImageURL(this);"/>
									</div>										
									<div class="col-xs-6">
									<?php	
									$imagePath="cmsapp/uploads/user/";
									$imageUrl= $imagePath.$uId.".jpg"; 
									if(!file_exists($imageUrl))
										$imageUrl= "cmsapp/images/user/dummy.jpg";
									?>
										<img style="border:solid 1px #c0c0c0;border-radius:10px;" id="coverimage" alt="" src="<?php echo $imageUrl;?>" width="50%;" />
									</div>
								</div>
							</div><!-- /.box-body -->
						</div>	
												
						<div class="box ">
						<!-- /.box-header -->
						<div class="box-footer" style="text-align:center;">
							<button type="submit" class="btn btn-primary">Submit</button>
							<a href="myaccount.php"><button type="button" class="btn btn-primary">Cancel</button></a>
						</div>
						</div>								
					   <!-- /.box -->
					</aside>
				 </form>  
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
				$('#RegUserForm').submit(function(){
					$('#AddOthMember').click();
					return true;	
				}); 
				$('#AddOthMember').click(function(){
					
						var name=$('#OthMemberName').val(); 
						var gender=$('#OthMemberGender').val(); 
						var reln=$('#OthMemberReln').val(); 
						if(name!=""){
							$('#OthMemberTable').append('<div class="form-group row"><div class="col-xs-5" style="padding-right:0px;"><input type="text" class="form-control"  value="'+name+'"  >	</div><div class="col-xs-3" style="padding-right:0px;"><input type="text" class="form-control" value="'+gender+'" ></div><div class="col-xs-3" style="padding-right:0px;"><input type="text" class="form-control" value="'+reln+'" ></div></div>');
							$('#RegUserForm').append('<div style="display:none;"><input type="text" class="form-control"  value="" name="OthMemberName[]" ><input type="text" class="form-control" value="'+gender+'"   name="OthMemberGender[]" ><input type="text" class="form-control" value="'+reln+'"  name="OthMemberReln[]" ></div>');
							 name=$('#OthMemberName').val(''); 
							 gender=$('#OthMemberGender').val(''); 
							 reln=$('#OthMemberReln').val('');  
						 }
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