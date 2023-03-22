<?php
include('../control.php');  	
?>

<!DOCTYPE html>
<html lang="en">

 <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Bootstrap Core CSS -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../assets/css/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../assets/css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        	  <!-- Bootstrap Core CSS -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../assets/css/metisMenu.min.css" rel="stylesheet">
	
<style>
.brandlogo {
  border-radius: 50%;
  position: center;
  background-color: #1B4F72;
  min-width: 50px;
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);
  z-index: 2;
}
	
.error {
	width: 100%; 
	margin: 0px auto; 
	padding: 10px; 
	border: 1px solid #a94442; 
	color: #a94442; 
	background: #f2dede; 
	border-radius: 5px; 
	text-align: left;
}

.success{
	width: 100%; 
	margin: 0px auto; 
	padding: 10px; 
	border: 1px solid green; 
	color: green; 
	background: #f2f2f2; 
	border-radius: 5px; 
	text-align: left;
}

.price{
	color: red;

	
}

.product{
font-family: Arial, Helvetica, sans-serif;
 border: 1px solid #ddd;
 border-radius: 2%;
 width: auto;
 box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);
 z-index: 2;
}
.product.price{
color: red;
font-family: Helvetica , Helvetica, sans-serif;
}

.product-header{
font-family: Arial, Helvetica, sans-serif;
 border-radius: 2%;
 width: auto;
 color: blue;
}

.product-image{
border: 1px solid #ddd;
border-radius: 4px;	
	
	
}
</style>


		
    </head>

<body>
<div id="wrapper">

<div class="container">	
	<div class="page-header">
			<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				
				<div class="navbar-header">
								<a href="../home/index.php"><img  src="../images/ifmlogo.jpg" alt="logo" class="brandlogo" width="auto" height="50px"></a>
				</div>
				
			
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>

						<ul class="nav navbar-nav navbar-left navbar-top-links">
							<li><a target='' href="../home/index.php"><i class="fa fa-home fa-fw"></i> HOME</a></li>
							
							<li><a target='' href="contact.php"><i class="fa fa-phone fa-fw"></i> CONTACTS</a></li>
						
							
							
						</ul>
					
						<ul class="nav navbar-nav navbar-right navbar-top-links">
							<li><a target='' href="signup.php">
								<button type='button' class='btn btn-warning btn-xs' title='Click here to signup'>
								<i class='fa fa-fw fa-edit' aria-hidden='true'  title='Click here to signup'></i>SIGNUP
								</button>
								</a>
							</li>
							<li><a target='' href="login.php">
								<button type='button' class='btn btn-primary btn-xs' title='Click here to Login'>
								<i class='fa fa-fw fa-sign-in' aria-hidden='true'  title='Click here to Login'></i>LOGIN
								</button>
								</a>
							</li>
							
						</ul>
						<ul class="nav navbar-nav navbar-left">
							<li class="dropdown navbar-inverse">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									<i class="fa fa-bell fa-fw"></i> ABOUT US <b class="caret"></b>
								</a>
									<ul class="dropdown-menu dropdown-alerts">
										<li>
											<a target='' href="about.php">
												<div>
													<i class="fa fa-users fa-fw"></i> About Us
													
												</div>
											</a>
										</li>
										<li>
											<a target='' href="vision.php">
												<div>
													<i class="fa fa-eye fa-fw"></i>Our Vission
												</div>
											</a>
										</li>
										<li>
											<a target='' href="mission.php">
												<div>
													<i class="fa fa-road fa-fw"></i>Our  Mission
												</div>
											</a>
										</li>
										<li>
											<a target='' href="objectives.php">
												<div>
													<i class="fa fa-road fa-fw"></i>Our  Objectives
												</div>
											</a>
										</li>
										<li>
											<a target='' href="values.php">
												<div>
													<i class="fa fa-road fa-fw"></i>Core Values
												</div>
											</a>
										</li>
										
										
									</ul>
							</li>
						</ul>
				
			</nav>
	</div>
</div>
	