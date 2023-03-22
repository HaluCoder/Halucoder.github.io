<?php
include('../control.php');
	

	if(!isLoggedIn()) {
		array_push($login_messages, "<script>alert('You must log in first!!!');</script>");
		header("location: ../home/login.php");
	}
	
if(!isAdmin()) {
	
	array_push($login_messages, "<script>alert('You dont have permission to acces this page!!!');</script>");
	
	session_destroy();
	unset($_SESSION['user']);
	array_push($login_messages, "<script language='javascript'>window.location.href = '../home/login.php'</script>");
	}




if (isset($_SESSION['user']))
{
	$userNames= $_SESSION['user']['fname'].' '.$_SESSION['user']['lname'];

	$userRole= $_SESSION['user']['role'];

	$userEmail= $_SESSION['user']['email'];

	$userID= $_SESSION['user']['userID'];

	$userNames = ucwords(strtolower($userNames));
	
	$photo= $_SESSION['user']['photo'];
	
	if(empty($photo)){
		
	$folder = "ProfilePictures/";
	
	$profilePicture = $folder.$photo;
	
	}
	else{
	$folder = "ProfilePictures/";
	$photo = "user.jpg";
	$profilePicture = $folder.$photo;
		
	}
}



?>

<?php echo display_log_messages() ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
		
  <title>DRS |<?php echo $title ="Dashboard"; ?></title>
  
  
        <!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../css/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">


<style>

.img {
  border-radius: 50%;
}

</style>
   
   </head>
    <body>

	<div id="wrapper">
            <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="adminHome.php"><img  src="images/ditlogo.jpg" alt="logo" class="img" width="auto" height="50px"></a>
                </div>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <ul class="nav navbar-nav navbar-left navbar-top-links">
                    <li><a target='' href="#https://drs.co.tz/"><i class="fa fa-home fa-fw"></i> WEBSITE</a></li>
                </ul>

                <ul class="nav navbar-right navbar-top-links">
                        <li class="dropdown navbar-inverse">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="fa fa-bell fa-fw"></i> <b class="caret"></b>
							</a>
								<ul class="dropdown-menu dropdown-alerts">
									<li>
										<a href="#">
											<div>
												<i class="fa fa-comment fa-fw"></i> New Comment
												<span class="pull-right text-muted small">4 minutes ago</span>
											</div>
										</a>
									</li>
									<li>
										<a href="#">
											<div>
												<i class="fa fa-twitter fa-fw"></i> 3 New Followers
												<span class="pull-right text-muted small">12 minutes ago</span>
											</div>
										</a>
									</li>
									<li>
										<a href="#">
											<div>
												<i class="fa fa-envelope fa-fw"></i> Message Sent
												<span class="pull-right text-muted small">4 minutes ago</span>
											</div>
										</a>
									</li>
									<li>
										<a href="#">
											<div>
												<i class="fa fa-tasks fa-fw"></i> New Task
												<span class="pull-right text-muted small">4 minutes ago</span>
											</div>
										</a>
									</li>
									<li>
										<a href="#">
											<div>
												<i class="fa fa-upload fa-fw"></i> Server Rebooted
												<span class="pull-right text-muted small">4 minutes ago</span>
											</div>
										</a>
									</li>
									<li class="divider"></li>
									<li>
										<a class="text-center" href="#">
											<strong>See All Alerts</strong>
											<i class="fa fa-angle-right"></i>
										</a>
									</li>
								</ul>
					
                        
                    </li>
					<li align="center">

							<?php

							function getUserIpAddr(){
								if(!empty($_SERVER['HTTP_CLIENT_IP'])){
									//ip from share internet
									$ip = $_SERVER['HTTP_CLIENT_IP'];
								}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
									//ip pass from proxy
									$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
								}
								elseif(empty($_SERVER['HTTP_CLIENT_IP'])){
									$ip = "127.0.0.1";
								}
								else{
									$ip = $_SERVER['REMOTE_ADDR'];
								}
								return $ip;
							}

							$ipaddress = getUserIpAddr();

								echo "<span class='label label-primary' title='Your IP Address'> <i class='fa fa-server'></i>
								
								IP: ".$ipaddress."
								
								</span>" ;
							?>
					</li>                      
                            
					<li align="center">

									<?php

								$sql = "
								SELECT * FROM users,members
								WHERE users.userId = members.userID
								AND users.userID='$userID'
								";

								$result = mysqli_query($db, $sql);
								
							if ($result)
							{
								$num_rows = mysqli_num_rows($result);
										if ($num_rows>0)
										{
											while($row = mysqli_fetch_assoc($result)){
											
											$MIN=$row['MIN'];
											
											echo "<span class='label label-success' title='Member is Registered'> <i class='fa fa-star'></i> Registered</span>" ;
											
											}
										}
										else 
											{
											 echo "<span class='label label-danger' title='Member not Registered'> <i class='fa fa-star'></i> Not Registered</span>" ;
											}
							}
							else{
								echo "<span class='label label-danger' title='There is a probelem in fetching some data from our database.'> <i class='fa fa-stop'></i> --error--</span>" ;
							}
						?>
                    </li>  
                    
					<li class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" href="#">
										  <i class="fa fa-user fa-lg"></i><?php echo ucwords(strtolower($userNames));?><b class="caret"></b>
					  
									</a>
						  
								<ul class="dropdown-menu dropdown-user">
									
									<li align="center">
											<?php	
												
												echo" <img  class='img' src=\"".$profilePicture."\" width='50%' height='50%' alt='photo'>";
												
											?>
										<!-- <img class="img" src="../images/user.jpg" width="50%" height="50%" alt="image"> -->
									</li>
									
									<li class="divider"></li>
										<font  size="4" color="#0A8CF9">
									<li align="center"><i class="fa fa-trophy"></i><?php echo ucfirst($userRole);?></li>
											</font>
									<li class="divider"></li>
									<li align="center">
										
										<?php
											$sql = "
											SELECT * FROM users,members
											WHERE users.userId = members.userID
											AND users.userID='$userID'
											";

											$result = mysqli_query($db, $sql);
								
											if ($result)
											{
												$num_rows = mysqli_num_rows($result);
														if ($num_rows>0)
														{
															while($row = mysqli_fetch_assoc($result)){
															
															$MIN=$row['MIN'];
															
																echo " <i class='fa fa-star'></i>
																<span title='Membership Identification Number'>MIN:</span>
															<span class='label label-success' title='Member is Registered'>
																 $MIN</span>" ;
															 
																}
														}
														else 
															{
															 echo "<span class='label label-danger' title='Member not Registered'> <i class='fa fa-star'></i> Not Registered</span>" ;
															}
											}
											else{
												echo "<span class='label label-danger' title='There is a probelem in fetching some data from our database.'> <i class='fa fa-stop'></i> --error--</span>" ;
											}


											?>
									</li>						 
									<li class="divider"></li>
									<li>
												<a href="update_pic.php"><i class="fa fa-gear fa-fw"> </i> update Photo</a> 
									</li>
									<li>
												<?php
												 echo" <a href=\"user_reset_password.php?email=". $userEmail." \"><i class='fa fa-gear fa-fw' title='Reset Password'></i>Change Password</a>";
																	  
												?>
									</li>	
									<li class="divider"> </li>
									<li color="red"> 
											<?php
											   echo " 
											   <a href=\"../home/index.php?logout=1&userID=$userID\">
											   <i class='fa fa-sign-out fa-fw'></i> Logout</a>
													 ";
											?>
									</li>
								</ul>
						
                    </li>
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                </span>
                                </div>
                                <!-- /input-group -->
                            </li>
                            <li>
                                <a href="home.php" class="active"><i class="fa fa-dashboard fa-fw"></i> DASHBOARD</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-users"></i> USERS <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="add_user.php"><i class="fa fa-user-plus"></i> create User</a>
                                    </li>
                                    <li>
                                        <a href="view_users.php"><i class="fa fa-eye"></i> View Users</a> 
                                    </li>
									
									<li>
                                        <a href="update_pic.php"><i class="fa fa-eye"></i> Update Photo</a> 
                                    </li>
									
									<li>
                                        <a href="../import_csv/import_users.php"><i class="fa fa-upload"></i> import Users</a> 
                                    </li>
									
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>

                        
							
							<li>
                                <a href="#"><i class="fa fa-bank fa-fw"></i> BRANCHES <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
									<li>
                                        <a href="add_branch.php"><i class="fa fa-plus"></i>Add Branch</a>
                                    </li>
									
                                    <li>
                                        <a href="view_branches.php"><i class="fa fa-eye"></i> view Branches</a>
                                    </li>
                                    
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            
                            	<li>
                                <a href="#"><i class="fa fa-book fa-fw"></i> PROJECTS<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
									<li>
                                        <a href="add_project.php"><i class="fa fa-plus"></i>Add Project</a>
                                    </li>
									
                                    <li>
                                        <a href="view_projects.php"><i class="fa fa-eye"></i> view Projects</a>
                                    </li>
                                    
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
							<li>
										<a href="#"><i class="fa fa-bank fa-fw"></i> APPLICATIONS<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
									 <a href="view_membership.php"><i class="fa fa-eye"></i>view Membership Applications</a>
									</li>   

									<li>
									 <a href="view_competition.php"><i class="fa fa-eye"></i>view Competitions Applications</a>
									</li> 

									<li>
									<a href="view_ambasadors.php"><i class="fa fa-eye"></i>view Ambasador Applications</a>
									</li> 

									<li>
									<a href="view_internship.php"><i class="fa fa-eye"></i>view internship Applications</a>
									</li> 

									<li>
									<a href="view_leadership.php"><i class="fa fa-eye"></i>view leadership Applications</a>
									</li> 

                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
							
							 
							<li>
                                <a href="#"><i class="fa fa-bank fa-fw"></i> STATUSES<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
									<li>
                                        <a href="add_vstat.php"><i class="fa fa-plus"></i>Add status Value</a>
                                    </li>
									
                                    <li>
                                        <a href="view_statuses.php"><i class="fa fa-eye"></i> view statuses</a>
                                    </li>
                                    
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
							
							
							<li>
                                <a href="#"><i class="fa fa-money fa-fw"></i>FEES<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
									<li>
                                        <a href="add_fee.php"><i class="fa fa-plus"></i>Add fees</a>
                                    </li>
									
                                    <li>
                                        <a href="view_fees.php"><i class="fa fa-eye"></i> view fees</a>
                                    </li>
                                    
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
							
							<li>
                                <a href="#"><i class="fa fa-bank fa-fw"></i> INVOICES<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
		
                                    <li>
                                        <a href="view_invoices.php"><i class="fa fa-eye"></i> view Invoices</a>
                                    </li>
                                    
                                </ul>
                           
                            </li>
							
								<li>
                                <a href="#"><i class="fa fa-bank fa-fw"></i> REPORTS<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
		
                                    <li>
                                        <a href="view_reports.php"><i class="fa fa-eye"></i> view Reports</a>
                                    </li>
                                    
                                </ul>
                           
                            </li>
							
                          
                        </ul>
                    </div>
                </div>
		</nav>
	
		<div class="page-wrapper" id="page-wrapper">
		
		<h3 class="page-header"><?php echo $title; ?></h3>
		
				<div class="container-fluid" id="container-fluid">
					<div class="row">
					
						<div class="col-lg-12">
										<div class="alert alert-success alert-dismissible col-lg-12 ">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
												<font color="green"><h5 align="center"><b>Welcome <?php echo strtoupper($userNames); ?> , <?php echo $_SESSION['success']; ?> as <?php echo strtoupper($userRole); ?> </h5></b></font>
																					
										</div>
										
						</div>
					</div>
								<!-- /.row -->
					<div class="row">
					<!-- ADMIN HEAD ENDS HERE-------->
					
					
					
					
					
					
					
					
					
					
					
					<!-- ADMIN BODY STARTS HERE-------->
						<div class="col-lg-12">
								<div class="col-lg-3 col-md-6">
										<div class="panel panel-red">
											<div class="panel-heading">
												<div class="row">
													<div class="col-xs-3">
														<i class="fa fa-tasks fa-3x"></i>
													</div>
													<div class="col-xs-9 text-right">
														<div class="huge">
																<?php      


																$sql = "SELECT *
																FROM projects,tasks
																WHERE projects.token=tasks.ptoken 
																AND tasks.tstatus ='new'
																";

																$result = $db->query($sql);	

																$num_results = $result->num_rows;
																if ($num_results>0)
																{
																   echo "$num_results"; 
																}

																else 
																{
																	echo "0";
																}		
																 ?>
														</div>
														<div>NOT DONE</div>
													</div>
												</div>
											</div>
											<a href="view_not_done.php">
												<div class="panel-footer">
													<span class="pull-left">View Details</span>
													<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

													<div class="clearfix"></div>
												</div>
											</a>
											
											<a href="csv_exp_not_done.php">
												<div class="panel-footer">
													<span class="pull-left">Export CSV</span>
													<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

													<div class="clearfix"></div>
												</div>
											</a>
										</div>
								</div>
									
								<div class="col-lg-3 col-md-6">
										<div class="panel panel-primary">
											<div class="panel-heading">
												<div class="row">
													<div class="col-xs-3">
														<i class="fa fa-tasks fa-3x"></i>
													</div>
													<div class="col-xs-9 text-right">
														<div class="huge">
																	<?php      


																	$sql = "SELECT *
																	FROM projects,tasks
																	WHERE projects.token=tasks.ptoken 
																	AND tasks.tstatus ='onprogress'
																	";


																	$result = $db->query($sql);	

																	$num_results = $result->num_rows;
																	if ($num_results>0)
																	{
																	   echo "$num_results"; 
																	}

																	else 
																	{
																		echo "0";
																	}		
																	 ?>
														</div>
													   <div>PROGRESS</div>
													</div>
												</div>
											</div>
											<a href="view_onprogress_tasks.php">
												<div class="panel-footer">
													<span class="pull-left">View Details</span>
													<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

													<div class="clearfix"></div>
												</div>
											</a>
											
											 <a href="csv_exp_onprogress.php">
												<div class="panel-footer">
													<span class="pull-left">Export CSV</span>
													<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

													<div class="clearfix"></div>
												</div>
											</a>
										</div>
								</div>
								
								<div class="col-lg-3 col-md-6">
										<div class="panel panel-primary">
											<div class="panel-heading">
												<div class="row">
													<div class="col-xs-3">
														<i class="fa fa-tasks fa-3x"></i>
													</div>
													<div class="col-xs-9 text-right">
														<div class="huge">
																	<?php      


																	$sql = "SELECT *
																	FROM projects,tasks
																	WHERE projects.token=tasks.ptoken 
																	AND tasks.tstatus ='onprogress'
																	";


																	$result = $db->query($sql);	

																	$num_results = $result->num_rows;
																	if ($num_results>0)
																	{
																	   echo "$num_results"; 
																	}

																	else 
																	{
																		echo "0";
																	}		
																	 ?>
														</div>
													   <div>PROGRESS</div>
													</div>
												</div>
											</div>
											<a href="view_onprogress_tasks.php">
												<div class="panel-footer">
													<span class="pull-left">View Details</span>
													<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

													<div class="clearfix"></div>
												</div>
											</a>
											
											 <a href="csv_exp_onprogress.php">
												<div class="panel-footer">
													<span class="pull-left">Export CSV</span>
													<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

													<div class="clearfix"></div>
												</div>
											</a>
										</div>
								</div>
									
									
						
								<div class="col-lg-3 col-md-6">
										<div class="panel panel-red">
											<div class="panel-heading">
												<div class="row">
													<div class="col-xs-3">
														<i class="fa fa-tasks fa-3x"></i>
													</div>
													<div class="col-xs-9 text-right">
														<div class="huge">
																	<?php      
																	/*
																	$sql = "

																	SELECT * FROM projects
																	LEFT OUTER JOIN tasks
																	ON tasks.pprojectID = projects.projectID

																	WHERE tasks.pprojectID IS NULL
																	ORDER BY projects.projectID DESC
																	 
																	";

																	*/

																	$today= date('Y-m-d');
																	$today = date("Y-m-d", strtotime($today));

																	/*
																	if(date('m-d') == substr($birthday,5,5) or (date('y')%4 <> 0 and substr($birthday,5,5)=='02-29' and date('m-d')=='02-28'))
																	{
																	*/


																	$sql = "SELECT *
																	FROM users  
																	WHERE DATE_FORMAT(dateAdded, '%Y-%m-%d')='$today'
																	";

																	$result = $db->query($sql);	

																	$num_results = $result->num_rows;
																	if ($num_results>0)
																	{
																	   echo "$num_results"; 
																	}

																	else 
																	{
																		echo "0";
																	}		
																	 ?>
														</div>
														<div>NEW USERS</div>
													</div>
												</div>
											</div>
											<a href="view_new_users.php">
												<div class="panel-footer">
													<span class="pull-left">View Details</span>
													<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

													<div class="clearfix"></div>
												</div>
											</a>
											 <a href="csv_exp_pending.php">
												<div class="panel-footer">
													<span class="pull-left">Export CSV</span>
													<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

													<div class="clearfix"></div>
												</div>
											</a>
										</div>
								</div>
								
								<!-- /.col-lg-12 -------------------------------------------->
						</div> 
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						<!-- /.col-lg-12 -------------------------------------------->
						
						<!-- .....................  /.row  ,......................  -->
					</div>
					<!-- /.container-fluid ------------------------------------------>
				</div>
				
							<div class="panel-footer" align="center">
											<marquee>
												
												<b>Designed and Maintained By USMAN MCHINJA &trade; | +255 655 258 012</b>
											</marquee>
							</div>
		<!-- /#page-wrapper ---------------------------------------------------->
		</div>
						
		<!-- /#wrapper ----------------------------------------------------------------------------------------->
	</div>

					<!-- jQuery -->
					<script src="../js/jquery.min.js"></script>

					<!-- Bootstrap Core JavaScript -->
					<script src="../js/bootstrap.min.js"></script>

					<!-- Metis Menu Plugin JavaScript -->
					<script src="../js/metisMenu.min.js"></script>

					<!-- Custom Theme JavaScript -->
					<script src="../js/startmin.js"></script>
					
					  <!-- DataTables JavaScript -->
					<script src="../js/dataTables/jquery.dataTables.min.js"></script>
					
					<script src="../js/dataTables/dataTables.bootstrap.min.js"></script>

					<!-- Custom Theme JavaScript -->
					<script src="../js/startmin.js"></script>

					<!-- Page-Level Demo Scripts - Tables - Use for reference -->
					<script>
						$(document).ready(function() {
							$('#dataTables-example').DataTable({
									responsive: true
							});
						});
					</script>
					
					<!-- Morris Charts JavaScript -->
					<script src="../js/raphael.min.js"></script>
					<script src="../js/morris.min.js"></script>
					<script src="../js/morris-data.js"></script>


    </body>
</html>
                     