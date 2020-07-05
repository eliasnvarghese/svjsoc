<?php ob_start(); ?>
<?php session_start() ?>
<?php 
include("includes/usercredentials.php");
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Videos of St. Stephen's Jacobite Syriac Orthodox Church, San Jose, California</title>
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
</style>
</head>
<body>
<div class="theme-layout">
<?php include("includes/pageheader.php");?>


<section>
	<div class="block remove-gap">
		<div class="container">
			<div class="row">
				<div class="title2">
					<span></span>
					<h2>OUR <span>VIDEO GALLERY</span></h2>
				</div>
				<div class="col-md-12 column">
					<div class="remove-ext">
						<div class="row">
							<div class="mas-gallery">
								<?php	
								$MAXPAGENOS = 3;
								$NOOFLINES = 9;					
								include('report/pagination.php');
								$rowNo=$pageno*$NOOFLINES-($NOOFLINES);
								$searchString ="";
								$postingServiceObj=new PostingService();
								$RESULTDATACOUNT=$postingServiceObj->getAllPostings('DATACOUNT',"Video");
								if($RESULTDATACOUNT>0){
									$i=0;
									$results=$postingServiceObj->getAllPostings('DATALIST',"Video",$rowNo,$NOOFLINES);
									while($row=mysqli_fetch_array($results)){
										$videoname=getVideoNameFromYouTubeURL($row["videourl"]);
										$videoRefId=$videoname;
										?>						
										<div class="col-md-4">
											<div class="gallery">
												<div class="embed-responsive embed-responsive-1by1">
													<iframe  style="height: 30vh;"  class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $videoRefId; ?>?rel=0&feature=player_detailpage&wmode=transparent" frameborder="0" allowfullscreen>
													</iframe>
												</div>	
												<h4 style="font-size: 15px;margin-bottom: 15px;margin-top: 15px;overflow: hidden;padding: 0 10px;text-overflow: ellipsis;white-space: nowrap;line-height: 24px;">
												<?php echo $row["title"];?></h4>												
											</div><!-- GALLERY ITEM -->
										</div>
										<?php 	
									}
								}
								include('report/pagelink_generator.php');
								?>     					
								
							</div>
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