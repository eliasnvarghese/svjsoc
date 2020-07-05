<?php ob_start(); ?>
<?php session_start() ?>
<?php 
include("includes/usercredentials.php");

$contentService=new ContentService();
$gospel="Again I say to you that if two of you agree on earth concerning anything that they ask, it will be done for them by My Father in heaven. For where two or more are gathered together in My Name, I am there in the midst of them.";
$gospelwordsof="Matthew 18: 19-20";
$results=$contentService->getGospel();
while($row=mysqli_fetch_array($results)){
	$gospel=$row["gospel"];
	$gospelwordsof=$row["bookof"];
}
$imageBasePath="cmsapp/uploads/";
$eventServiceObj=new EventService();
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>St. Stephen's Syriac Orthodox Church, San Jose (San Francisco -  Bay Area), California, USA</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Welcome to St.Stephen's Syriac Orthodox Church located in San Jose (San Francisco -  Bay Area), California USA. The Holy Qurbono is on every Sunday in English,Malayalam,Syriac languages." />
<meta name="keywords" content="St.Stephens Syriac Orthodox ,Jacobite Syriac Orthodox ,Syriac Orthodox ,San Jose ,Great Lent, Good Friday, Hosana, Easter, Pesaha, Palm Sunday,Lenten Retreat, Confession, Malayalam ,Holy Qurbono ,Qurbono ,Qurbana ,Church ,San Francisco ,St.Peter, St.Mary, St.Thomas, St.John, St.George, Greogorious, St.Ignatius , Malankara ,Orthodox ,Full Qurbana ,Full Qurbono ,Holy Qurbana ,English Qurbana ,Mass ,HE Mor Titus Yeldho ,HE ,Mor ,Titus ,Yeldho ,California ,Jacobite ,Kerala ,Tirumeni ,Bishop ,St.Stephen ,Saint ,svsoc ,Malayalam Qurbono ,Malayalam Qurbana ,Christian ,Christ ,St.Stepehen Church ,Bay Area ,Sunnyvale ,cupertino ,silicon valley ,Bay Area ,San Jose ,Cupertino ,Fremont " />
<meta name="abstract" content="St. Stephen's Jacobite Syriac Orthodox Church, San Jose (San Francisco -  Bay Area), California"/>
<meta name="key-phrases" content="Syriac Orthodox Church,"/>
<meta name="Classification" content="Church"/>
<meta name="subject" content="Syriac Orthodox Church"/>
<meta name="language" content="english"/>
<meta name="distribution" content="global"/>
<meta name="audience" content="All"/>
<meta name="page-topic" content="St. Stephen's Syriac Orthodox Church,San Jose (San Francisco -  Bay Area) Official Website"/>
<meta name="googlebot" content="index, follow" />
<meta name="robots" content="INDEX, FOLLOW">
<meta name="rating" content="general" />
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-127404294-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-127404294-1');
</script>
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
.category-block > span {
    text-transform: none;
}
</style>
</head>
<body>
<div class="theme-layout">
<?php include "includes/pageheader.php";?>
<div class="slider">
	<div class="rev_slider_wrapper">
		<div id="slider1" class="rev_slider"  data-version="5.0">
			<ul>	
				<li data-transition="fade" data-slotamount="10" data-masterspeed="3000" >
					<img src="images/resource/slider/slider1.jpg"  alt="slidebg1" class="rev-slidebg" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-no-retina />
					<div class="tp-caption slide-title1 tp-resizeme rs-parallaxlevel-2" data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" data-y="['150','150','150','150']" data-voffset="['0','0','0','0']" data-fontsize="['49','49','29','19']" data-lineheight="['49','49','29','19']" data-width="['none','none','none','400']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-transform_idle="o:1;" data-transform_in="z:0;rX:90;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:2000;e:Back.easeInOut;" data-transform_out="x:left(R);s:2000;e:Back.easeIn;s:1000;e:Back.easeIn;" data-start="1700" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="; white-space: nowrap;">Pray For Yourself <span>Be Peacefull</span></div>
					<div class="tp-caption slide-subtitle1 tp-resizeme rs-parallaxlevel-2" data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" data-y="['220','220','220','220']" data-voffset="['0','0','0','0']" data-fontsize="['18','18','15','15']" data-lineheight="['18','18','15','15']" data-width="['none','none','none','400']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:45;rZ:30;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:2000;e:Back.easeInOut;" data-transform_out="x:right(R);s:2000;e:Back.easeIn;s:1000;e:Back.easeIn;" data-start="1900" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="white-space: nowrap;">Under The Guidelines Of Our Patriarch</div>
<!-- 					<a href="#" title="" class="tp-caption slide-button colored-box tp-resizeme rs-parallaxlevel-2" data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" data-y="['280','280','280','280']" data-voffset="['0','0','0','0']" data-fontsize="['13','13','13','13']" data-lineheight="['15','15','13','13']" data-width="['none','none','none','400']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:2000;e:Back.easeInOut;" data-transform_out="y:bottom(R);s:2000;e:Back.easeIn;s:1000;e:Back.easeIn;" data-start="2100" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="white-space: nowrap;">Read More</a>					
 -->					<!-- <div class="tp-caption tp-resizeme rs-parallaxlevel-2" data-x="['right','right','right','right']" data-hoffset="['0','0','0','0']" data-y="['bottom','bottom','bottom','bottom']" data-voffset="['0','0','0','0']" data-transform_idle="o:1;" data-transform_in="y:bottom(R);z:0;rX:90;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:2000;e:Elastic.easeInOut;" data-transform_out="x:right(R);s:2000;e:Back.easeIn;s:1000;e:Back.easeIn;" data-start="2300" data-splitin="none" data-splitout="none" data-responsive_offset="on" data-no-retina><img src="images/resource/slide9-man.png" alt="" data-ww="['332px','332px','200px','170px']" data-hh="['412px','412px','251px','213px']" itemprop="image" data-no-retina /></div> -->
				</li>				
				<li data-transition="fade" data-slotamount="10" data-masterspeed="3000" >
					<img src="images/resource/slider/slider2.jpg"  alt="slidebg1" class="rev-slidebg" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-no-retina />
					<div class="tp-caption slide-title1 tp-resizeme rs-parallaxlevel-2" data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" data-y="['150','150','150','150']" data-voffset="['0','0','0','0']" data-fontsize="['49','49','29','19']" data-lineheight="['49','49','29','19']" data-width="['none','none','none','400']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-transform_idle="o:1;" data-transform_in="z:0;rX:90;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:2000;e:Back.easeInOut;" data-transform_out="x:left(R);s:2000;e:Back.easeIn;s:1000;e:Back.easeIn;" data-start="1700" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="; white-space: nowrap;">Pray For Yourself <span>Be Peacefull</span></div>
					<div class="tp-caption slide-subtitle1 tp-resizeme rs-parallaxlevel-2" data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" data-y="['220','220','220','220']" data-voffset="['0','0','0','0']" data-fontsize="['18','18','15','15']" data-lineheight="['18','18','15','15']" data-width="['none','none','none','400']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:45;rZ:30;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:2000;e:Back.easeInOut;" data-transform_out="x:right(R);s:2000;e:Back.easeIn;s:1000;e:Back.easeIn;" data-start="1900" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="white-space: nowrap;">Under The Guidelines Of Our Patriarch</div>
<!-- 					<a href="#" title="" class="tp-caption slide-button colored-box tp-resizeme rs-parallaxlevel-2" data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" data-y="['280','280','280','280']" data-voffset="['0','0','0','0']" data-fontsize="['13','13','13','13']" data-lineheight="['15','15','13','13']" data-width="['none','none','none','400']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:2000;e:Back.easeInOut;" data-transform_out="y:bottom(R);s:2000;e:Back.easeIn;s:1000;e:Back.easeIn;" data-start="2100" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="white-space: nowrap;">Read More</a>					
 -->					<!-- <div class="tp-caption tp-resizeme rs-parallaxlevel-2" data-x="['right','right','right','right']" data-hoffset="['0','0','0','0']" data-y="['bottom','bottom','bottom','bottom']" data-voffset="['0','0','0','0']" data-transform_idle="o:1;" data-transform_in="y:bottom(R);z:0;rX:90;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:2000;e:Elastic.easeInOut;" data-transform_out="x:right(R);s:2000;e:Back.easeIn;s:1000;e:Back.easeIn;" data-start="2300" data-splitin="none" data-splitout="none" data-responsive_offset="on" data-no-retina><img src="images/resource/slide9-man.png" alt="" data-ww="['332px','332px','200px','170px']" data-hh="['412px','412px','251px','213px']" itemprop="image" data-no-retina /></div> -->
				</li>				
				<li data-transition="fade" data-slotamount="10" data-masterspeed="3000" >
					<img src="images/resource/slider/slide10.jpg"  alt="slidebg1" class="rev-slidebg" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-no-retina />
					<div class="tp-caption slide-title1 tp-resizeme rs-parallaxlevel-2" data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" data-y="['150','150','150','150']" data-voffset="['0','0','0','0']" data-fontsize="['49','49','29','19']" data-lineheight="['49','49','29','19']" data-width="['none','none','none','400']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-transform_idle="o:1;" data-transform_in="z:0;rX:90;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:2000;e:Back.easeInOut;" data-transform_out="x:left(R);s:2000;e:Back.easeIn;s:1000;e:Back.easeIn;" data-start="1700" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="; white-space: nowrap;">Pray For Yourself <span>Be Peacefull</span></div>
					<div class="tp-caption slide-subtitle1 tp-resizeme rs-parallaxlevel-2" data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" data-y="['220','220','220','220']" data-voffset="['0','0','0','0']" data-fontsize="['18','18','15','15']" data-lineheight="['18','18','15','15']" data-width="['none','none','none','400']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:45;rZ:30;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:2000;e:Back.easeInOut;" data-transform_out="x:right(R);s:2000;e:Back.easeIn;s:1000;e:Back.easeIn;" data-start="1900" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="white-space: nowrap;">Under The Guidelines Of Our Patriarch</div>
<!-- 					<a href="#" title="" class="tp-caption slide-button colored-box tp-resizeme rs-parallaxlevel-2" data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" data-y="['280','280','280','280']" data-voffset="['0','0','0','0']" data-fontsize="['13','13','13','13']" data-lineheight="['15','15','13','13']" data-width="['none','none','none','400']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:2000;e:Back.easeInOut;" data-transform_out="y:bottom(R);s:2000;e:Back.easeIn;s:1000;e:Back.easeIn;" data-start="2100" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="white-space: nowrap;">Read More</a>					
 -->					<!-- <div class="tp-caption tp-resizeme rs-parallaxlevel-2" data-x="['right','right','right','right']" data-hoffset="['0','0','0','0']" data-y="['bottom','bottom','bottom','bottom']" data-voffset="['0','0','0','0']" data-transform_idle="o:1;" data-transform_in="y:bottom(R);z:0;rX:90;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:2000;e:Elastic.easeInOut;" data-transform_out="x:right(R);s:2000;e:Back.easeIn;s:1000;e:Back.easeIn;" data-start="2300" data-splitin="none" data-splitout="none" data-responsive_offset="on" data-no-retina><img src="images/resource/slide9-man.png" alt="" data-ww="['332px','332px','200px','170px']" data-hh="['412px','412px','251px','213px']" itemprop="image" data-no-retina /></div> -->
				</li>
				<li data-transition="fade" data-slotamount="10" data-masterspeed="3000" >
					<img src="images/resource/slider/slide14.jpg"  alt="slidebg2" class="rev-slidebg" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-no-retina />
					<div class="tp-caption slide-title2 tp-resizeme rs-parallaxlevel-2" data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" data-y="['260','260','260','260']" data-voffset="['0','0','0','0']" data-fontsize="['37','37','27','27']" data-lineheight="['37','37','27','27']" data-width="['none','none','none','400']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:1.5;sY:0.9;skX:0.9;skY:0;opacity:0;s:2000;e:Back.easeInOut;" data-transform_out="x:left(R);s:2000;e:Back.easeIn;s:1000;e:Back.easeIn;" data-start="1700" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="; white-space: nowrap;">Spiritual <span> Growth & Prayer</span></div>
					<div class="tp-caption colored-box slide-subtitle2 tp-resizeme rs-parallaxlevel-2" data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" data-y="['320','320','320','320']" data-voffset="['0','0','0','0']" data-fontsize="['18','18','15','15']" data-lineheight="['25','25','20','20']" data-width="['none','none','none','400']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:2000;e:Back.easeInOut;" data-transform_out="x:left(R);s:2000;e:Back.easeIn;s:1000;e:Back.easeIn;" data-start="1900" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="white-space: nowrap; color: #ffffff;">Grow spiritually throughout our life.</div>
					<div class="tp-caption white-bg slide-subtitle2 tp-resizeme rs-parallaxlevel-2" data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" data-y="['370','370','370','370']" data-voffset="['0','0','0','0']" data-fontsize="['18','18','15','15']" data-lineheight="['25','25','20','20']" data-width="['none','none','none','400']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:2000;e:Back.easeInOut;" data-transform_out="x:left(R);s:2000;e:Back.easeIn;s:1000;e:Back.easeIn;" data-start="2100" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="white-space: nowrap;">Every human being is made in the image of God.</div>
<!-- 					<a href="#" title="" class="tp-caption slide-button colored-box tp-resizeme rs-parallaxlevel-2" data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" data-y="['420','420','420','420']" data-voffset="['0','0','0','0']" data-fontsize="['13','13','13','13']" data-lineheight="['15','15','13','13']" data-width="['none','none','none','400']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:2000;e:Back.easeInOut;" data-transform_out="y:bottom(R);s:2000;e:Back.easeIn;s:1000;e:Back.easeIn;" data-start="2100" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="white-space: nowrap;">Read More</a>					
 -->				</li>
				<li data-transition="fade" data-slotamount="10" data-masterspeed="3000" >
					<img src="images/resource/slider/slide15.jpg"  alt="slidebg3" class="rev-slidebg" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-no-retina />
					<div class="tp-caption slide-title3 tp-resizeme rs-parallaxlevel-2" data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" data-y="['370','370','370','370']" data-voffset="['0','0','0','0']" data-fontsize="['36','36','26','26']" data-lineheight="['36','36','26','26']" data-width="['none','none','none','400']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-transform_idle="o:1;" data-transform_in="x:[105%];z:0;rX:45deg;rY:0deg;rZ:90deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power4.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-mask_in="x:0px;y:0px;" data-mask_out="x:inherit;y:inherit;" data-start="1700" data-splitin="chars" data-splitout="none" data-responsive_offset="on" data-elementdelay="0.05" style="; white-space: nowrap;">Get Everyone Forgiveness Today</div>
					<div class="tp-caption light-bg slide-subtitle3 tp-resizeme rs-parallaxlevel-2" data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" data-y="['420','420','420','420']" data-voffset="['0','0','0','0']" data-fontsize="['26','26','20','20']" data-lineheight="['26','26','20','20']" data-width="['none','none','none','400']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:2000;e:Back.easeInOut;" data-transform_out="x:right(R);s:2000;e:Back.easeIn;s:1000;e:Back.easeIn;" data-start="1900" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="white-space: nowrap;">Forgiveness is unselfish love. </div>
<!-- 					<div class="tp-caption light-bg slide-subtitle3 tp-resizeme rs-parallaxlevel-2" data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" data-y="['370','370','370','370']" data-voffset="['0','0','0','0']" data-fontsize="['26','26','20','20']" data-lineheight="['26','26','20','20']" data-width="['none','none','none','400']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:2000;e:Back.easeInOut;" data-transform_out="x:right(R);s:2000;e:Back.easeIn;s:1000;e:Back.easeIn;" data-start="2100" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="white-space:">Forgiveness is the most churchelly</div>
					<a href="#" title="" class="tp-caption slide-button colored-box tp-resizeme rs-parallaxlevel-2" data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" data-y="['420','420','420','420']" data-voffset="['0','0','0','0']" data-fontsize="['13','13','13','13']" data-lineheight="['15','15','13','13']" data-width="['none','none','none','400']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:2000;e:Back.easeInOut;" data-transform_out="y:bottom(R);s:2000;e:Back.easeIn;s:1000;e:Back.easeIn;" data-start="2100" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="white-space: nowrap;">Read More</a>					
 --> 				</li> 			
					<li data-transition="fade" data-slotamount="10" data-masterspeed="3000" >
					<img src="images/resource/slider/slide16.jpg"  alt="slidebg3" class="rev-slidebg" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-no-retina />
					<div class="tp-caption slide-title3 tp-resizeme rs-parallaxlevel-2" data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" data-y="['370','370','370','370']" data-voffset="['0','0','0','0']" data-fontsize="['36','36','26','26']" data-lineheight="['36','36','26','26']" data-width="['none','none','none','400']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-transform_idle="o:1;" data-transform_in="x:[105%];z:0;rX:45deg;rY:0deg;rZ:90deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power4.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-mask_in="x:0px;y:0px;" data-mask_out="x:inherit;y:inherit;" data-start="1700" data-splitin="chars" data-splitout="none" data-responsive_offset="on" data-elementdelay="0.05" style="; white-space: nowrap;">Get Everyone Forgiveness Today</div>
					<div class="tp-caption light-bg slide-subtitle3 tp-resizeme rs-parallaxlevel-2" data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" data-y="['420','420','420','420']" data-voffset="['0','0','0','0']" data-fontsize="['26','26','20','20']" data-lineheight="['26','26','20','20']" data-width="['none','none','none','400']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:2000;e:Back.easeInOut;" data-transform_out="x:right(R);s:2000;e:Back.easeIn;s:1000;e:Back.easeIn;" data-start="1900" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="white-space: nowrap;">Forgiveness is unselfish love. </div>
<!-- 					<div class="tp-caption light-bg slide-subtitle3 tp-resizeme rs-parallaxlevel-2" data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" data-y="['370','370','370','370']" data-voffset="['0','0','0','0']" data-fontsize="['26','26','20','20']" data-lineheight="['26','26','20','20']" data-width="['none','none','none','400']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:2000;e:Back.easeInOut;" data-transform_out="x:right(R);s:2000;e:Back.easeIn;s:1000;e:Back.easeIn;" data-start="2100" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="white-space:">Forgiveness is the most churchelly</div>
					<a href="#" title="" class="tp-caption slide-button colored-box tp-resizeme rs-parallaxlevel-2" data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" data-y="['420','420','420','420']" data-voffset="['0','0','0','0']" data-fontsize="['13','13','13','13']" data-lineheight="['15','15','13','13']" data-width="['none','none','none','400']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:2000;e:Back.easeInOut;" data-transform_out="y:bottom(R);s:2000;e:Back.easeIn;s:1000;e:Back.easeIn;" data-start="2100" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="white-space: nowrap;">Read More</a>					
 --> 				</li> 
				<li data-transition="fade" data-slotamount="10" data-masterspeed="3000" >
					<img src="images/resource/slider/slide13.jpg"  alt="slidebg3" class="rev-slidebg" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-no-retina />
					<div class="tp-caption slide-title3 tp-resizeme rs-parallaxlevel-2" data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" data-y="['370','370','370','370']" data-voffset="['0','0','0','0']" data-fontsize="['36','36','26','26']" data-lineheight="['36','36','26','26']" data-width="['none','none','none','400']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-transform_idle="o:1;" data-transform_in="x:[105%];z:0;rX:45deg;rY:0deg;rZ:90deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power4.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-mask_in="x:0px;y:0px;" data-mask_out="x:inherit;y:inherit;" data-start="1700" data-splitin="chars" data-splitout="none" data-responsive_offset="on" data-elementdelay="0.05" style="; white-space: nowrap;">Get Everyone Forgiveness Today</div>
					<div class="tp-caption light-bg slide-subtitle3 tp-resizeme rs-parallaxlevel-2" data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" data-y="['420','420','420','420']" data-voffset="['0','0','0','0']" data-fontsize="['26','26','20','20']" data-lineheight="['26','26','20','20']" data-width="['none','none','none','400']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:2000;e:Back.easeInOut;" data-transform_out="x:right(R);s:2000;e:Back.easeIn;s:1000;e:Back.easeIn;" data-start="1900" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="white-space: nowrap;">Forgiveness is unselfish love. </div>
<!-- 					<div class="tp-caption light-bg slide-subtitle3 tp-resizeme rs-parallaxlevel-2" data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" data-y="['370','370','370','370']" data-voffset="['0','0','0','0']" data-fontsize="['26','26','20','20']" data-lineheight="['26','26','20','20']" data-width="['none','none','none','400']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:2000;e:Back.easeInOut;" data-transform_out="x:right(R);s:2000;e:Back.easeIn;s:1000;e:Back.easeIn;" data-start="2100" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="white-space:">Forgiveness is the most churchelly</div>
					<a href="#" title="" class="tp-caption slide-button colored-box tp-resizeme rs-parallaxlevel-2" data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" data-y="['420','420','420','420']" data-voffset="['0','0','0','0']" data-fontsize="['13','13','13','13']" data-lineheight="['15','15','13','13']" data-width="['none','none','none','400']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:2000;e:Back.easeInOut;" data-transform_out="y:bottom(R);s:2000;e:Back.easeIn;s:1000;e:Back.easeIn;" data-start="2100" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="white-space: nowrap;">Read More</a>					
 --> 				</li> 
			</ul>
		</div>	
	</div><!-- REVOLUTION SLIDER -->	
</div>

<section>
	<div class="block">
		<div class="container">
			<div class="row">
				<div class="title2">
					<span></span>
					<h2><span>ABOUT THE CHURCH</span></h2>
				</div>
				<div class="about">
					<div class="col-md-8 column">
						<p style="font-size:14px">
Welcome to St. Stephen’s Syriac Orthodox Church, San Jose (San Francisco -  Bay Area), California, USA. We have submitted ourselves in the hands of God Almighty to use us as He wills, for the glorification of His name. We approach these plans with openness, humility and hope. Come with us to share the joy of being used by God.
</p></br><p  style="font-size:14px">
The Holy Qurbono is conducted every Sunday at <a target="_blank" href="https://www.google.com/maps/place/St.+Stephen's+Syriac+Orthodox+Church/@37.3658464,-121.8610199,15z/data=!4m12!1m6!3m5!1s0x0:0xe6225a05bc2ec1f8!2sSt.+Stephen's+Syriac+Orthodox+Church!8m2!3d37.3658464!4d-121.8610199!3m4!1s0x0:0xe6225a05bc2ec1f8!8m2!3d37.3658464!4d-121.8610199" >1921 Las Plumas Ave, San Jose, CA 95133, San Jose (San Francisco -  Bay Area), California</a> at 8:15 am
</p></br>
<p  style="font-size:14px">
Contact :
</p>
<ul style="list-style-type:disc;margin-left: 40px;">
  <li>Vicar & Priest 1 : Rev. Fr. Paul Thotakat - <i class="fa fa-phone"></i>917-291-7877</li>
 <li>Priest 2 :  Rev Fr. Dr. K. K. Kuriakose - <i class="fa fa-phone"></i>408-475-2149</li>
 <li>Coordinators - <i class="fa fa-phone"></i>408-475-2149</li>
 </li>
 </ul>	

					</div>
					<div class="col-md-4 column">
						<div class="tab-content" id="myTabContent">
							<div id="image1" class="tab-pane fade in active">
								<img src="images/resource/holymass.jpg" alt="" />
							</div>
						</div>		
						</br>
						<div class="tab-content" id="myTabContent">
							<div id="image1" class="tab-pane fade in active">
								<a href="calendar.php"><img src="images/calendar.png" alt="" /></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section>
	<div class="block remove-gap coloured">
	<div class="parallax" style="background:url(images/parallax3.jpg);"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="latest-tweets">
						<img src="images/resource/holyspirit.jpg">
						<div class="tweets-slides" style="margin-top: 3px;">
							<div class="tweet">
								<p id="gospal">"<?php echo $gospel;?>" </p>
								<span>-- <?php echo $gospelwordsof;?></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Events -->
<section>
	<div class="block">
		<div class="container">
			<div class="row">
				<div class="title2">
					<span></span>
					<h2><span>UPCOMING EVENTS</span></h2>
				</div>
				<div class="col-md-12 column">
					<div class="events-gridview remove-ext">  
						<div class="row">
						<?php 
						$eventServiceObj=new EventService();
						$results=$eventServiceObj->getUpComingEvents(3);
						while($row=mysqli_fetch_array($results)){
							$imageUrl=$imageBasePath."/events/".$row['eventid'].".jpg";
							if(!file_exists($imageUrl)){
								$imageUrl="images/resource/events/holymass.jpg";
							}
							?>
							<div class="col-md-4">
								<div class="category-box">
									<div class="category-block">
										<div class="category-img">
											<div class="animal-img"><img src="<?php echo $imageUrl;?>" alt="" /><span><strong><?php echo dateDisplayFormat($row['fromdate'],"d");?></strong><?php echo dateDisplayFormat($row['fromdate'],"M Y");?></span></div>
											<ul>
												<li class="date"><a href="#" title=""><i class="fa fa-calendar-o"></i> <?php echo dateDisplayFormat($row['fromdate'],"d");?>,<?php echo dateDisplayFormat($row['fromdate'],"M Y");?></a></li>
												<li class="time"><a href="#" title=""><i class="fa fa-clock-o"></i> 8:15 AM</a></li>
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
<section>
	<div class="block blackish">
	<div class="parallax" style="background:url(images/parallax1.jpg);"></div>
		<div class="container">
			<div class="row">	
				<div class="col-md-12">
					<div class="parallax-title">
						<h3 class="special-text">REQUEST <span>A NEWS LETTER</span></h3>
						<p>Please provide your email address for the <br/> News Letter</p>
					</div>
		
					 <div id="message"></div>
					<form class="prayer-request" method="post" action="newsletter.php" name="contactform" id="contactform">
						<input name="email" type="text" id="email" placeholder="Email" />
						<input class="submit" type="submit"  id="submit" value="Send Me" />
					</form><!--- FORM -->
				</div>
			</div>
		</div>
	</div>
</section>
<!-- MAP -->
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
					</p><p  style="font-size:14px">
				1921 Las Plumas Ave, San Jose, CA 95133
				</p>
				</div>
				<div class="col-md-6">
					<div class="map">
<iframe src="https://maps.google.com/maps?q=St.%20Stephen's%20Syriac%20Orthodox%20Church&t=&z=13&ie=UTF8&iwloc=&output=embed" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div><!--- GOOGLE MAP -->
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
		/* timedText();
		function timedText() {
		  var x = document.getElementById('gospal');
		  var items = [
		  ["aaaaaaaaaa", "AA"],
		  ["bbbbbbbb", "BB"],
		  ["cccccc", "CC"],
		  ["dddddddddddd", "DD"]
		];
		var n=0;
	  setInterval(function () {
		 //set the inner html, parse the value from the inner html as well
		 //var rn=randomIntFromInterval(1,4);
		 console.log(" n = "+n);
		 if(n>=items.length){ n=0;}
		 x.innerHTML = items[n][0];
		  n=n+1;
	  }, 1500);
	}
	function randomIntFromInterval(min,max) // min and max included
	{
		return Math.floor(Math.random()*(max-min+1)+min);
	} */
	</script>
</body>