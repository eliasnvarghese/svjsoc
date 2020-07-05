<?php ob_start(); ?>
<?php session_start() ?>
<?php 
include("includes/usercredentials.php")
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Member Directory of St. Stephen's Jacobite Syriac Orthodox Church, San Jose, California</title>
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
</style>
</head>
<body>
<div class="theme-layout">
<?php include("includes/pageheader.php");?>
<div class="page-top">
	<div class="parallax" style="background:url(images/parallax3.jpg);"></div>	
	<div class="container"> 
		<h1><span> Members Directory</span></h1>
		<ul>
			<li><a href="index.php" title="">Home</a></li>
		</ul>
	</div>
</div><!--- PAGE TOP -->
<section>
	<div class="block">
		<div class="container">
			<div class="row">
				<div class="col-md-8 column">
					<div class="latest-sermons remove-ext">
						<?php
						$regUesrServiceObj=new RegUserService();
						$searchStr="";
						$MAXPAGENOS=3;
						$NOOFLINES=5;
						include("report/pagination.php");
						$rowNo=$pageno*$NOOFLINES-($NOOFLINES);
						$RESULTDATACOUNT=$regUesrServiceObj->getAllRegUsers('DATACOUNT',$searchStr);
						if($RESULTDATACOUNT>0){
							$results=$regUesrServiceObj->getAllRegUsers('DATALIST',$searchStr,$rowNo,$NOOFLINES);
							while($row=mysqli_fetch_array($results)){
								$image="cmsapp/uploads/user/".$row["uid"].".jpg";
								if(!file_exists($image))
									$image="cmsapp/images/user/".strtolower($row["gender"]).".jpg";
							?>
							<div class="sermon">
								<div class="row">
									<div class="col-md-3">
										<div class="imagex">
											<img src="<?php echo $image;?>" alt="" />
											
										</div>
									</div>
									<div class="col-md-9">
										<h3><a href="member.php?page=<?php echo $pageno;?>&uid=<?php echo $row["uid"];?>" title=""><?php echo $row["name"];?></a></h3>
										<ul class="team-listx">
										<?php $address=makeAddress(array($row["fulladdress"],$row["city"],$row["state"]));?>
										<li><i class="fa fa-home"></i> <?php echo $row["familyname"];?></li>
										<li><i class="fa fa-map-marker"></i> <?php echo $address;?></li>
										<li><i class="fa fa-mobile"></i> <?php echo $row["mobilenumber"];?>  &nbsp;&nbsp; &nbsp;&nbsp;<i class="fa fa-phone"></i> <?php echo $row["phonenumber"];?></li>
										<li><i class="fa fa-envelope"></i> <?php echo $row["email"];?></li>
									</ul>
									
									</div>
									<div class="hover-in">
									
									<h3><a href="#" title="">About <?php echo $row["name"];?></a></h3>
									<li><i class="fa fa-venus-mars custom"></i> <?php echo $row["gender"];?>  &nbsp;&nbsp; &nbsp;&nbsp;<i class="fa fa-birthday-cake"></i> <?php echo dateDisplayFormat($row["dob"],"F d");?></li>
	
									<p><?php echo $row["aboutme"];?></p>
									</div>
								</div>
							</div><!-- SERMON -->    
			          							
							<?php 	}
							}
							$report_filename="directory.php";
							include("report/pagelink_generator.php");
							?>
					</div><!-- LATEST SERMONS -->
				</div>
				<aside class="col-md-4 sidebar column">
					<div class="widget">
						<div class="widget-title"><h4>COMING EVENT</h4></div>
						<?php 
						$eventServiceObj=new EventService();
						$results=$eventServiceObj->getUpComingEvents(1);
						while($row=mysqli_fetch_array($results)){
							$imageUrl=$imageBasePath."/events/".$row['eventid'].".jpg";
							if(!file_exists($imageUrl)){
								$imageUrl="images/resource/events/holymass.jpg";
							}
							?>
							<div class="col-md-12">
								<div class="category-box">
									<div class="category-block">
										<div class="category-img">
											<div class="animal-img"><img src="<?php echo $imageUrl;?>" alt="" /><span><strong><?php echo dateDisplayFormat($row['fromdate'],"d");?></strong><?php echo dateDisplayFormat($row['fromdate'],"M Y");?></span></div>
											<ul>
												<li class="date"><a href="#" title=""><i class="fa fa-calendar-o"></i> <?php echo dateDisplayFormat($row['fromdate'],"d");?>,<?php echo dateDisplayFormat($row['fromdate'],"M Y");?></a></li>
												<li class="time"><a href="#" title=""><i class="fa fa-clock-o"></i> 8:00 AM</a></li>
											</ul>
										</div>
										<h3><a href="#" title=""><?php echo $row['eventname'];?></a></h3>
										<span>
										<?php 
										foreach(preg_split("/((\r?\n)|(\r\n?))/", $row['eventdetails']) as $line){
											echo "<li>".$line."</li>";
										} 
										?>
										</span>									
									</div>						
								</div><!-- EVENTS -->
							</div>
						<?php
						}
						?>
					</div><!-- GALLERY -->
				
									
									
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