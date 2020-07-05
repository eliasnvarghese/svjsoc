<?php ob_start(); ?>
<?php session_start() ?>
<?php 
include("includes/usercredentials.php");
$imageBasePath="cmsapp/uploads/";
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>The Great Lent Schedule - St. Stephen's Jacobite Syriac Orthodox Church, San Jose, CA, USA</title>
<meta name="description" content="St.Stephen's Syriac Orthodox Church located in San Jose Bay Area, California USA - The Great Lent Schedule. " />
<meta name="keywords" content="Great Lent, Good Friday, Hosana, Easter, Pesaha, Palm Sunday,Lenten Retreat, Confession, Malayalam, Indian Church, Holy Qurbana" />
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
<style>
.member-detail {
 position: relative;
	}
.logo img{
	width:auto;
}
.title:before {
    content: "\f005";
}
.image > img {
    width: initial;
}
.sermon p {
    margin-top: 5px;
   font-size:14px;
}

.sermon h3 a {
    color: #0dafa9;
}
 .sermon h4 {
	 color: #b96969;
}
.category-block > span {
    text-transform: none;
}
</style>
</head>
<body>
<div class="theme-layout">
<?php include "includes/pageheader.php";?>
<div class="page-top">
	<div class="parallax" style="background:url(images/parallax8.jpg);"></div>	
	<div class="container"> 
		<h1><span>The Great Lent Schedule</span></h1>
		<ul>
			<li><a href="index.php" title="">Home</a></li>
		</ul>
	</div>
</div><!--- PAGE TOP -->
<section>
	<div class="block">
		<div class="container">
			<div class="row">
				<div class="title2">
					<span></span>
					<!--- 
					<h4><span>Lent Daily evening Prayer @ 8:30 pm.</br>Online: <a href="https://us04web.zoom.us/j/208438173">Zoom Video Conference</a> </br>Phone: <a href="tel:+14086380968">+14086380968</a> Meeting Id: 208 438 173</span></h4>
					-->
				</div>
				<div class="col-md-12 column">
					<div class="events-gridview remove-ext">  
						<div class="row">
						<?php 
						$eventServiceObj=new SpecialEventService();
						$results=$eventServiceObj->getUpComingEvents(50);
						while($row=mysqli_fetch_array($results)){
							$imageUrl=$imageBasePath."/splevents/".$row['eventid'].".jpg";
							if(!file_exists($imageUrl)){
								$imageUrl="cmsapp/images/splevents/holymass.jpg";
							}
							?>
							<div class="col-md-4">
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
										//echo getFirstSentense($row['eventdetails'],150);
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
						</div>
					</div><!-- EVENTS GRID VIEW -->
				</div>
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