<header class="header2">

	<nav class="style2">

		<div class="container">
			<div class="logo">
				<a href="index.php" title="Home"><img src="images/logo/logo.png" alt="" /></a>
			</div><!--- LOGO -->
			<ul>
				<li><a href="index.php" title=""><i class="fa fa-home fa-fw" aria-hidden="true"></i>Home</a>
				</li>
				<li class="menu-item-has-children"><a href="#" title="">About</a>
				<ul>
					<li><a href="orthodoxchurch.php" title="">Holy Syriac Orthodox Church</a></li>
					<li><a href="aboutourchurch.php" title="">Our Church</a></li>
					<li><a href="patrons.php" title="">Spiritual Fathers</a></li>
					<li><a href="ministries.php" title="">Organizations</a></li>
				</ul>
				</li>	
				<li class="menu-item-has-children"><a href="#" title="">Calendar</a>
					<ul>
						<li><a href="calendar.php" title="">Church Events</a></li>
						<li><a href="lents.php" title="">Lents - Easter Events</a></li>
						<li><a href="lectionary.php" title="">Lectionary</a></li>
					</ul>
				</li>
				
				<li><a href="contactus.php" title="">Contact</a></li>
				<?php if($regUserData==null){?>
				<li><a href="login.php" title="">Login</a> </li>
				<?php } else{?> 
				 <li class="menu-item-has-children"><a href="#" title=""><i class="fa fa-user"></i><?php echo  ucwords(strtolower(trim($userName))); ?></a> 
					<ul>
						<li><a href="logout.php" title=""><i class="fa fa-power-off"></i>Logout</a></li>
						<li><a href="myaccount.php" title=""><i class="fa fa-cog"></i>My Account</a></li>
					
						<li><a href="photogallery.php" title="">Photos</a></li>
						<li><a href="videogallery.php" title="">Videos</a></li>
							<li><a href="directory.php" title="">Members Directory</a></li>
					</ul>
				</li> 
				<?php }?>
			</ul>
		</div>
	</nav>
</header><!--- HEADER -->
<!-- Responsive Header -->
<div class="responsive-header">

	<div class="responisve-bar">
		<div class="responsive-logo"><a href="#" title=""><img style="max-width:100%" src="images/logo/logo.png" alt="" /></a></div>
		<span class="responsive-btn"><i class="fa fa-list"></i></span>
	</div>
</div><!-- Responsive Header -->
<div class="responsive-menu">
	<ul>
		<li><a href="index.php" title="">Home</a>
		</li>
		<li class="menu-item-has-children"><a href="#" title="">About</a>
		<ul>
			<li><a href="orthodoxchurch.php" title="">Holy Syriac Orthodox Church</a></li>
			<li><a href="aboutourchurch.php" title="">Our Church</a></li>
			<li><a href="patrons.php" title="">Patrons</a></li>
			<li><a href="ministries.php" title="">Organizations</a></li>
		</ul>
		</li>
	
		<li class="menu-item-has-children"><a href="#" title="">Calendar</a>
		<ul>
			<li><a href="calendar.php" title="">Church Events</a></li>
			<li><a href="lents.php" title="">Lents - Easter Events</a></li>
			<li><a href="lectionary.php" title="">Lectionary</a></li>
		</ul>
		</li>

		<li><a href="contactus.php" title="">Contact</a></li>
			<?php if($regUserData==null){?>
		<li><a href="login.php">Login</a></li>
			<?php } else{?> 
			 <li class="menu-item-has-children"><a href="#" title=""><i class="fa fa-user"></i><?php echo  ucwords(strtolower(trim($userName))); ?></a> 
					<ul>
						<li><a href="logout.php" title=""><i class="fa fa-power-off"></i>Logout</a></li>
						<li><a href="myaccount.php" title=""><i class="fa fa-cog"></i>My Account</a></li>
						
						<li><a href="photogallery.php" title="">Photos</a></li>
						<li><a href="videogallery.php" title="">Videos</a></li>
						<li><a href="directory.php" title="">Members Directory</a></li>
					</ul>
				</li> 
			<?php } ?> 
			
	</ul>
</div><!-- Responsive Menu -->