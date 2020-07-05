<?php 
ob_start();
session_start(); 
$sessionid=session_id();
/* if(!isset($_SESSION['StStephenChurch_RegUserData'])){
	header("Location:login.php");
	exit();
} */
function __autoload($className){
	$className=strtolower($className);
	require_once "./cmsapp/classes/{$className}_class.php";
}
require_once("./cmsapp/includes/utility.php"); 
$regUserData=null;
$imageBasePath="cmsapp/images/";
$log=new Logging();
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login of St. Stephen's Jacobite Syriac Orthodox Church, San Jose, California</title>
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
.widget form input[type="email"], .widget form input[type="text"] {
    color: #000;
   
}
</style>
</head>
<body>
<div class="theme-layout">
<?php include("includes/pageheader.php");?>

<div class="page-top">
	<div class="parallax" style="background:url(images/parallax8.jpg);"></div>	
	<div class="container"> 
		<h1><span> Login</span></h1>
		<ul>
			<li><a href="index.php" title="">Home</a></li>
		</ul>
	</div>
</div><!--- PAGE TOP -->
        <section>
            <div class="block ">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                         
                            <div class="row">
                                <div class="col-md-6 column">
									<div class="widget">
										<div class="widget-title"><h4>Existing User</h4></div>					
										<div class="coloured-donation">
											<h2>LOGIN</h2>
											 <div class="space"></div>
											<form class="theme-form" method="post" action="login_action.php" name="loginform" id="loginform">
												<input  class="half-field form-control" style="background: white;" required placeholder="Enter your email id" type="text" name="userId" id="login_username"/>
												<input  class="half-field form-control" style="background: white;" required  placeholder="Enter your Password" type="password" name="password" id="login_password" />
												<a href="javascript: document.loginform.submit();" title="">Login</a>
											</form><!--- FORM -->
										</div>
									</div><!-- DONATE NOW -->
                                </div><!--- CONTACT INFORMATION -->
                 
                            </div>
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