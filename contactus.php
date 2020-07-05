<?php ob_start(); ?>
<?php session_start() ?>
<?php 
include("includes/usercredentials.php")
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>St. Stephen's Jacobite Syriac Orthodox Church, San Jose, Bay Area, California, USA</title>
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
</style>
</head>
<body>
<div class="theme-layout">
<?php include "includes/pageheader.php";?>
<div class="page-top">
	<div class="parallax" style="background:url(images/parallax8.jpg);"></div>	
	<div class="container"> 
		<h1><span> Contact US</span></h1>
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
					<h2><span>LOCATION MAP OF THE CHURCH</span></h2>
				</div>
				<div class="col-md-6">
				<p  style="font-size:14px">
				We are grateful to St.Thomas Syriac Orthodox Church for sharing their church facilities with us. Our Morning Prayer, Holy Qurbono and Sunday School are conducted at this church. It is located at				
				1921 Las Plumas Ave, San Jose, CA 95133
				</p>
				</div>
				<div class="col-md-6">
					<div class="map">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3171.015429962121!2d-121.86310388521218!3d37.365811779835894!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fccff38e1d741%3A0x1e96d4eea08ac342!2sSt+Thomas+Syriac+Orthodox+Church!5e0!3m2!1sen!2sus!4v1541673341039" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div><!--- GOOGLE MAP -->
				</div>
			</div>
		</div>
	</div>
</section>

        <section>
            <div class="block remove-gap">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="title2">
                                <span></span>
                                <h2>LET'S <span>GET IN TOUCH</span></h2>
                            </div>

                            <div class="row">
                                <div class="col-md-6 column">
                                    <h4>CONTACT INFORMATION</h4>
                                    <div class="space"></div>
                                    <p>St.Thomas Syriac Orthodox Church for sharing their church facilities with us.</p>
                                    <p>1921 Las Plumas Ave, San Jose, CA 95133</p>
                                    <div class="space"></div>
									<p  style="font-size:14px">
Contact :
</p>
<ul style="list-style-type:disc;margin-left: 40px;">
 <li>Vicar : Rev Fr. Paul Thotakat - <i class="fa fa-phone"></i>917-291-7877</li>
 <li>Coordinators - <i class="fa fa-phone"></i>408-475-2149</li>
 </li>
 </ul>	
									
									<ul>
									<li><span><i class="fa fa-envelope"></i>Email:</span> info@svsoc.org</li>
								</ul>
                                </div><!--- CONTACT INFORMATION -->
                                <div class="col-md-6 column">
                                    <h4>FILL IN THE FORM BELOW</h4>
                                    <div class="space"></div>
                                    <div id="message"></div>
                                    <form class="theme-form" method="post" action="contact.php" name="contactform" id="contactform">
                                        <input name="name" class="half-field form-control" type="text" id="name"  placeholder="Name" />
                                        <input name="email" class="half-field form-control" type="text" id="email" placeholder="Email" />
                                        <textarea name="comments" class="form-control" id="comments" placeholder="Description" ></textarea>
                                        <!--<div class="g-recaptcha" data-sitekey="6Lfp2yETAAAAAJpa6Hjx8XXb5lCk8zLzFlxNOlxe"></div> -->
                                        <input class="submit" type="submit"  id="submit" value="SUBMIT" />
                                    </form><!--- FORM -->
                                </div>
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