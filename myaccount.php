<?php ob_start(); ?>
<?php session_start() ?>
<?php 
include("includes/usercredentials.php");
$regUserService=new RegUserService();
$userAccountObj=$regUserService->getUserAccountByUId($uId) ;
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.member-detail {
 position: relative;
	}
.logo img{
	width:auto;
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
		<h1><span> My Account</span></h1>
		<ul>
			<li><a href="index.php" title="">Home</a></li>
		</ul>
	</div>
</div><!--- PAGE TOP -->
<section>
	<div class="block" style="padding: 40px 0;">
		<div class="container">
			<div class="row">
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
							<h3 style="text-transform: uppercase;"><?php echo $userAccountObj->getName();?></h3>
							<ul class="team-list">
								<?php $address=makeAddress(array($userAccountObj->getFullAddress(),$userAccountObj->getCity(),$userAccountObj->getState()));?>
								<li><i class="fa fa-home" style="font-size:24px"></i> <?php echo $userAccountObj->getFamilyName();?></li>
								<li><i class="fa fa-map-marker" style="font-size:24px"></i> <?php echo $address;?></li>
								<li><i class="fa fa-mobile-phone " style="font-size:24px"></i> <?php echo $userAccountObj->getMobileNumber();?> </li>
								<li><i class="fa fa-phone" style="font-size:24px"></i> <?php echo $userAccountObj->getPhoneNumber();?></li>
								<li><i class="fa fa-envelope" style="font-size:24px"></i> <?php echo $userAccountObj->getEmail();?></li>
					

							</ul>
						</div>
				
						<a style="float:right;" class="button" href="editmyaccount.php" title="">EDIT</a>
					</div><!-- TEAM SINGLE -->
				</div>
				<aside class="col-md-6 sidebar column">
					<div class="box box-info">
						<div class="box-header">
							<h3 class="box-title">Family Members </h3>
							<div style="float:right;">	
							<a href="addmymember.php">Add New Member <i class="fa fa-user-plus" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i></a>
							</div>
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
						</div>
					</div>
					
					<div class="box box-primary">
						<!-- /.box-header -->
						<!-- /.box-body -->
						<div class="box-header" style="padding-bottom:0px;">
							<h3 class="box-title" style="padding-bottom:0px;">My Donations & Offerings </h3><div class="pull-right box-tools"> 
							</div>
						</div><!-- /.box-header -->
						<div class="box-body">
							<div class="row" id="allowanceTable">
							<div class="box-body table-responsive">
								<table id="table-expense" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>RectNo</th>
											<th>Rect Date</th>
											<th>Category</th>
											<th>Narration</th>
											<th>Amount</th>
											<th>&nbsp;</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$paymentServiceObj = new PaymentService();													
										$results=$paymentServiceObj->getLedger($uId);
										while($row=mysqli_fetch_array($results)){
										?>
											<tr>																	
												<td><?php echo $row["rectno"]; ?></td>																
												<td><?php echo dateDisplayFormat($row["rectdate"],"m-d-Y"); ?></td>																
												<td><?php echo $row["category"]; ?></td>																
												<td><?php echo $row["rectdetls"]; ?></td>																
												<td><?php echo $row["rectamount"]; ?></td>
												<td>
												<a target="_blank" href="receipt_pdf.php?uid=<?php echo $row["uid"]; ?>&rectid=<?php echo $row["rectno"]; ?>"><i class="fa fa-print" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print"></i></a>
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
					<!--right bottom -->
					<!--/.col (right) -->
					</div> 
				</aside><!-- SIDEBAR -->
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
	<script>
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