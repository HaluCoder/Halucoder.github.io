<?php
include('../control.php');


	if(!isLoggedIn()) {
		array_push($login_messages, "<script>alert('You must log in first!!!');</script>");
		header("location: ../home/login.php");
	}
	
if(!isAdmin()) {
	
	array_push($login_messages, "<script>alert('You dont have permission to acces this page!!!');</script>");
	
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
	$folder = "../ProfilePictures";
	$profilePicture = $folder.'/'.$photo;
	
	
	if(file_exists($profilePicture)){
		
	$folder = "../ProfilePictures";
	$photo= $_SESSION['user']['photo'];
	$profilePicture = $folder.'/'.$photo;
	
	}
	else{
	$folder = "../ProfilePictures/";
	$photo = "user.jpg";
	$profilePicture = $folder.$photo;
		
	}
	
}



?>

<?php echo display_log_messages() ?>
   
  
  

<!-- ADMIN HEADER STARTS HERE--------> 



        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
		
          <!-- Bootstrap Core CSS -->
        <link href="../assets//css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- MetisMenu CSS -->
        <link href="../assets/css/metisMenu.min.css" rel="stylesheet">

        <!-- DataTables CSS -->
        <link href="../assets/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../assets/css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<style>

.img{
  border-radius: 50%;
}
</style>
</head>
<body>

	<div id="wrapper">
            <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="img" href="adminHome.php"><img  src="../images/ifmlogo.jpg" alt="logo" width="auto" height="50px"></a>
                </div>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <ul class="nav navbar-nav navbar-left navbar-top-links">
                    <li><a target='' href="#"><i class="fa fa-home fa-fw"></i> WEBSITE</a></li>
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
									<li>
											<?php echo"<a href=\"update_profile.php?userID=".$userID."\"><i class='fa fa-gear fa-fw'> </i> update Photo</a>"; ?>
									</li>
									<li>
												<?php
												 echo" <a href=\"user_reset_password.php?email=".$userEmail."\"><i class='fa fa-gear fa-fw' title='Reset Password'></i>Change Password</a>";
																	  
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
                                <a href="adminHome.php" class="active"><i class="fa fa-dashboard fa-fw"></i> DASHBOARD</a>
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
					
									
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
								
							 <li>
                                <a href="#"><i class="fa fa-users"></i> FARMS <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="add_farm.php"><i class="fa fa-plus"></i> Add Farms</a>
                                    </li>
                                    <li>
                                        <a href="view_farms.php"><i class="fa fa-eye"></i> View Farms</a> 
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
							
							<li>
                                <a href="#"><i class="fa fa-users"></i> BLOCKS <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="add_block.php"><i class="fa fa-plus"></i> Add Block</a>
                                    </li>
									
                                    <li>
                                        <a href="view_blocks.php"><i class="fa fa-eye"></i> View Blocks</a> 
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
							
						                          
                        </ul>
                    </div>
                </div>
		</nav>
	
		<div class="page-wrapper" id="page-wrapper">
		
		<h3 class="page-header"><?php echo $title; ?></h3>
		
				<div class="container-fluid" id="container-fluid">
					<!-- ADMIN HEADER ENDS HERE-------->