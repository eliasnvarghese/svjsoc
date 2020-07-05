<section class="sidebar">
	<!-- Sidebar user panel -->
	<div class="user-panel">
		<div class="pull-left image">
			<img src="<?php echo $profilePhoto;?>" class="img-circle" alt="User Image" />
		</div>
		<div class="pull-left info">
			<p>Hello, <?php echo $userName; ?></p>

			<a href="#"><i class="fa fa-circle text-success"></i>Online</a>
		</div>
	</div>
	<!-- search form -->
	<form action="#" method="get" class="sidebar-form">
		<div class="input-group">
			<input type="text" name="q" class="form-control" placeholder="Search..."/>
			<span class="input-group-btn">
				<button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
			</span>
		</div>
	</form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="<?php echo makeActive(array('dashboard.php')); ?>">
                            <a href="dashboard.php">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
						<li class="treeview <?php echo makeActive(array('addgospel.php')); ?>" >
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span>Gospel</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo makeActive(array('addgospel.php')); ?>"><a href="addgospel.php"><i class="fa fa-angle-double-right"></i>Add Gospel</a></li>
                            </ul>
                        </li>						
						<li class="treeview <?php echo makeActive(array('addphotogallery.php','addvideogallery.php')); ?>" >
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span>Gallery</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo makeActive(array('addphotogallery.php')); ?>"><a href="addphotogallery.php"><i class="fa fa-angle-double-right"></i>Add Photos</a></li>
                                <li class="<?php echo makeActive(array('addvideogallery.php')); ?>"><a href="addvideogallery.php"><i class="fa fa-angle-double-right"></i>Add Videos</a></li>
                            </ul>
                        </li>						
						<li class="treeview <?php echo makeActive(array('addevent.php','listofevents.php')); ?>" >
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span>Events</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo makeActive(array('addevent.php')); ?>"><a href="addevent.php"><i class="fa fa-angle-double-right"></i>Add Event</a></li>
                                <li class="<?php echo makeActive(array('listofevents.php')); ?>"><a href="listofevents.php"><i class="fa fa-angle-double-right"></i>List of Events</a></li>
                            </ul>
                        </li>						
						<li class="treeview <?php echo makeActive(array('addsplevent.php','listofsplevents.php')); ?>" >
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span>Lents</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo makeActive(array('addsplevent.php')); ?>"><a href="addsplevent.php"><i class="fa fa-angle-double-right"></i>Add Lents</a></li>
                                <li class="<?php echo makeActive(array('listofsplevents.php')); ?>"><a href="listofsplevents.php"><i class="fa fa-angle-double-right"></i>List of Lents</a></li>
                            </ul>
                        </li>
		
						<li class="treeview <?php echo makeActive(array('addreguser.php','listofregusers.php','reguserview.php','editreguser.php','addmember.php','resetreguserpasswd.php')); ?>" >
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span>User</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo makeActive(array('addreguser.php')); ?>"><a href="addreguser.php"><i class="fa fa-angle-double-right"></i>Add User</a></li>
                                <li class="<?php echo makeActive(array('listofregusers.php')); ?>"><a href="listofregusers.php"><i class="fa fa-angle-double-right"></i>List of Users</a></li>
                            </ul>
                        </li>		
						
						<li class="treeview <?php echo makeActive(array('addreceipt.php','addincome.php','collectionstatement.php','memberledger.php','addrectcategory.php','addexpensehead.php','delete_expensehead.php','addexpense.php','editexpense.php','delete_expense.php','expensebook.php')); ?>" >
                            <a href="#">
                                <i class="fa fa-money"></i>
                                <span>Accounting</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo makeActive(array('addincome.php')); ?>"><a href="addincome.php"><i class="fa fa-angle-double-right"></i>Add Income</a></li>
                                <li class="<?php echo makeActive(array('collectionstatement.php')); ?>"><a href="collectionstatement.php"><i class="fa fa-angle-double-right"></i>Income Statement</a></li>
                                <li class="<?php echo makeActive(array('memberledger.php')); ?>"><a href="memberledger.php"><i class="fa fa-angle-double-right"></i>Member Ledger</a></li>
                                <li class="<?php echo makeActive(array('addrectcategory.php')); ?>"><a href="addrectcategory.php"><i class="fa fa-angle-double-right"></i>Add Income Category</a></li>
                                <li class="<?php echo makeActive(array('addexpense.php')); ?>"><a href="addexpense.php"><i class="fa fa-angle-double-right"></i>Add Expense</a></li>
                                <li class="<?php echo makeActive(array('expensebook.php')); ?>"><a href="expensebook.php"><i class="fa fa-angle-double-right"></i>Expense Book</a></li>
                                <li class="<?php echo makeActive(array('addexpensehead.php')); ?>"><a href="addexpensehead.php"><i class="fa fa-angle-double-right"></i>Add Expense Head</a></li>
                           </ul>
                        </li>						

						<li class="treeview <?php echo makeActive(array('addadminuser.php','listofuser.php','changepassword.php','useractivities.php','loginactivities.php')); ?>" >
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span>Admin</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo makeActive(array('addadminuser.php')); ?>"><a href="addadminuser.php"><i class="fa fa-angle-double-right"></i>Add Admin User</a></li>
                                <li class="<?php echo makeActive(array('changepassword.php')); ?>"><a href="changepassword.php"><i class="fa fa-angle-double-right"></i>Change Password</a></li>
                                <li class="<?php echo makeActive(array('useractivities.php')); ?>"><a href="useractivities.php"><i class="fa fa-angle-double-right"></i>User Activities</a></li>
                                <li class="<?php echo makeActive(array('loginactivities.php')); ?>"><a href="loginactivities.php"><i class="fa fa-angle-double-right"></i>Login Activities</a></li>
                            </ul>
                        </li>	
                    </ul>
                </section>