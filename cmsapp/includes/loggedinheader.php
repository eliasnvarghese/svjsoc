<?php
$sessionId=session_id();
$userData = unserialize($_SESSION['StStephenChurch_AdminUserData']);
$userName = strtolower($userData->getName());
$uId = $userData->getUId();
$userId = $userData->getUserId();
$profilePhoto=(file_exists($userData->getPhotopath()))? $userData->getPhotopath() :"";
$profilePhoto=($profilePhoto!="") ? $userData->getPhotopath() : "img/avatar6.png";

$thisPage=basename($_SERVER['PHP_SELF']);
function makeActive(array $pageName){
	$active="";
	for($i=0;$i<sizeof($pageName);$i++){
		if(basename($_SERVER['PHP_SELF'])==$pageName[$i])
			$active="active";
	}
	return $active;
}
?>
		<header class="header">
            <a href="index.php" class="logo" style="padding-left:2px;">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <img src="img/clientlogo.png" width="20" style="margin-left:0px;"/>Admin Console
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
				<div style="float:left;text-align:left;padding:0px; margin:8px 0px 0px 20px;color:#ff00FF;font-size:18pt;">St.Stephen's Church</div>

                <div class="navbar-right">
	                    <ul class="nav navbar-nav">
						
					<!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-success">2</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 2 messages</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="img/avatar3.png" class="img-circle" alt="User Image"/>
                                                </div>
                                                <h4>
                                                    Joseph
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <p>Testing..</p>
                                            </a>
                                        </li><!-- end message -->
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="img/avatar.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Thomas
                                                    <small><i class="fa fa-clock-o"></i> 2 days</small>
                                                </h4>
                                                <p>Teestnmg</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="listofmessages.php?dir=in">See All Messages</a></li>
                            </ul>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                                <span class="label label-warning">2</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 2 notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-people info"></i> 5 new members joined today
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning danger"></i>5 enquiry
                                            </a>
                                        </li>  
										
                                    </ul>
                                </li>
                                <li class="footer"><a href="dashboard.php">View all</a></li>
                            </ul>
                        </li>
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $userName; ?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo $profilePhoto;?>" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $userName; ?>
                                        <small>Last login. 2018</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                               
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="edituser.php?uid=<?php echo $uId; ?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>