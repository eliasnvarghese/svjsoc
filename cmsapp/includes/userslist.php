											<table id="example3" class="table table-bordered table-striped">
													<thead>
														<tr>
															<th>UserId</th>
															<th>Name</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													<?php
													$userServiceObj = new AdminUserService();													
													$RESULTDATACOUNT=$userServiceObj->getAllUsers("DATACOUNT");
													if($RESULTDATACOUNT>0){
														$results=$userServiceObj->getAllUsers("datalist");
														while($row=mysqli_fetch_array($results)){
															$img=trim($row["photopath"]);
															if($img=="")
																$img="img/avatar2.png";
														?>
															<tr>
																<td><img src="<?php echo $img; ?>" width="50px;"></td>																																
																<td class="user-list" id="user<?php echo $row["userid"]; ?>"><?php echo $row["firstname"]; ?><br><?php echo $row["userid"]; ?></td>																
																<td><span id="<?php echo $row["userid"]; ?>" class="edit-user">
																<a href="edituser.php?uid=<?php echo $row["uid"]; ?>">Edit</a></span>
																&nbsp;&nbsp;&nbsp;
																<?php if($row["activated"]=='2'){?>
																<span id="<?php echo $row["userid"]; ?>" style="color:Maroon;" class="delete-user">Deleted</span>
																<?php }else{?>
																<a href="deleteuser.php?uid=<?php echo $row["uid"]; ?>"><span id="<?php echo $row["userid"]; ?>" style="color:red;" class="delete-user">Delete</span></a>																
																<?php }?>
																&nbsp;&nbsp;&nbsp;
																<a href="resetpassword.php?uid=<?php echo $row["uid"]; ?>"><span id="<?php echo $row["userid"]; ?>" class="delete-user">ResetPaswd</span></a>
															</tr>
													<?php 	
														}
													}
													?>														
													</tbody>
													<tfoot>
														<tr>
															<th colspan=3>Search Users</th>
														</tr>
													</tfoot>
												</table>