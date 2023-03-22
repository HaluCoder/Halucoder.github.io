
<!DOCTYPE html>
<html lang="en">
    <head>
 <!-- DataTables CSS -->
        <link href="../css/dataTables/dataTables.bootstrap.css" rel="stylesheet">



<!-- TITLE -->

<title>FMS | <?php $title ="Login"; echo $title;?> </title>



<!-- HEADER -->
<?php  include('home_head.php');    ?>
<div class="wrapper">


<?php

	if(isLoggedIn()) {
		array_push($login_messages, "You are now logged In");
	}
	else if (isLoggedOut()) {
		array_push($logout_messages, "You are now logged Out");
		unset($_SESSION['logout']); 
	}
	else{
		array_push($logout_messages, "You are now logged Out");
	}



if(isset($_GET['u']) && (isset($_GET['p']))){
$username1 = $_GET['u'];
$password1 = $_GET['p'];
}
else{
$username1 =NULL;
$password1 =NULL;
	
}
?>



<!-- BODY -->
<div class="container">
	<div class="row">						
		<div class="col-lg-6  col-lg-offset-3  col-md-6 col-md-offset-3">
			<div class=" panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Login Here</h3>
				</div>
				<div class="panel-body">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs">
                                        <li class="active">  <a href="#login" data-toggle="tab"><b>LOGIN</b></a> </li>
										
                                        <li>  <a href="#signup" data-toggle="tab"> <b>REGISTER </b> </a>
                                        </li>
                                        
                                        
                                        <li> <a href="#reset" data-toggle="tab"><b>RESET PASSWORD </b> </a> </li>
										
										
                                    </ul>

                                    <!-- Tab panes -->
					<div class="tab-content">
						<div class="tab-pane fade in active" id="login">
								<div class="panel-body">
										<form method="post"  action="">
											
											<div class="alert alert-info alert-dismissible ">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
												<h6>
												<?php echo display_error(); ?> 
												<?php echo display_log_messages() ?>
												<?php echo comments_sent_report(); ?>
												</h6>									
										   </div>			
											
												<div class="form-group">
													<input class="form-control" placeholder="E-mail" name="username" type="email" value="<?php echo $username1 ;?>" autofocus>
											  
											   </div>
											   
												<div class="form-group">
													<input class="form-control" placeholder="Password" name="password"  type="password" value="<?php echo $password1; ?>" >
										
												</div>
												
											<button type="submit" name="login" class="btn btn-primary btn-lg btn-block">LOGIN</button>
										   
										</form>
								</div>
						</div>
			
			
			
<!--SIGNUP PANEL STARTS HERE -->
			
				<div class="tab-pane fade" id="signup">
		                <div class="panel-body">
							<form method="post"  action="" enctype="multipart/form-data">
									<div class="row">
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>First Name</label>
												<input  type="text" class="form-control" placeholder="First Name" name="fname" autofocus >
											</div>
										</div>
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>Middle Name</label>
												<input  type="text" class="form-control" placeholder="Middle Name" name="mname" >
											</div>
										</div>
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>Last Name</label>
												<input  type="text" class="form-control" placeholder="Last Name" name="lname" >
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>E-mail</label>
												<input type="email" class="form-control" placeholder="E-mail" name="email" >
											</div>
										</div>
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>Phone Number</label>
												<input type="number" class="form-control" placeholder="255...." value="255" title="Phone number must start with country code" name="phone" value="255" size="12">
											</div>
										</div>
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>Gender</label>
													<select class="form-control" name="gender">
															<option value="" selected>select gender</option>
															<option value="male" >Male</option>
															<option value="female">Female</option>
															<option value="other">Other</option>
													</select>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>Date of Birth</label>
												<input type="date" class="form-control" name="dob">
											</div>
										</div>
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>password</label>
												<input type="password" class="form-control" placeholder="Password" name="password"   >
											</div>
										</div>
										
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>confirm password</label>
												<input type="password" class="form-control" placeholder="confirm Password" name="repassword"   >
											</div>
										</div>
										
									</div>
									
									
									<div class="row">
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>Region</label>
												<select name="region" class="form-control" onchange="showDistricts(this.value)">
												  <option value=""> Select region</option>
												<?php
												$sql= "select * from regions ";
												$result = mysqli_query($db,$sql);
												$num_rows = mysqli_num_rows($result);
												if ($num_rows > 0)
												{
													while($row = $result->fetch_assoc()) 
														{
														$id =$row["reg_id"];
														$region =$row["region"];
														
															echo"<option value='$id'>".$id.".".$region."</option>";
														}
												}

												?>
												</select>

											</div>
										</div>
										
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>District</label>
													<div id="txtHint">
													<select  class="form-control" name="district" >
														 <option value=""> Select district</option>
													
													</select>
													</div>
												
											</div>
										</div>
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
											<label>Council</label>
													<div id="txtHint2">
														<select  class="form-control" name="council" >
															 <option value=""> Select council</option>
														
														</select>
													</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>Ward</label>
												<input type="text" class="form-control" placeholder="Ward name" name="ward"  >
											</div>
										</div>
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>Village</label>
												<input type="text" class="form-control" placeholder="village name" name="village" >
											</div>
										</div>
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>Street </label>		
												<input type="text" class="form-control"  placeholder="street name" name="street" >
											</div>
										</div>
									</div>
									
									
									
									<div class="row">
										
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>Role</label>
													<select class="form-control" name="role">
														 <option value="">Select role</option>
														 <option value="tenant" selected>Tenant</option>
														 <option value="landlord">Landlord</option>
														 <option value="admin">Admin</option>
													</select>
											</div>
										</div>
										<div class="col-md-8 col-md-offset-0">
											<div class="form-group">
												<label>Passport size Photo</label>
												<input type="file" class="form-control" name="photo">
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-12 col-md-offset-0">
											<div class="form-group">
									<input type="hidden" class="form-control"  name="added_by" value =NULL >
									
									<button type="submit" name="register" class="btn btn-primary btn-lg btn-block">Create Account</button>
											</div>
										</div>
									</div>
									
							</form>
                        </div>
				</div>
						
						
						
			<!--PASSWORD RESET PANEL STARTS HERE -->			
								<div class="tab-pane fade" id="reset">
													<div class="panel-body">
											<form method="post"  action="" >
												
												
												<div class="row">
														<div class="col-md-12 col-md-offset-0">
															<div class="form-group">
																<label>Please input the correct username inorder to reset your pasword</label>
																<input class="form-control"  type="email"  placeholder="your email" name="email">
															</div>
														</div>
												</div>
												<div class="row">
														<div class="col-md-12 col-md-offset-0">
															<div class="form-group">
																<button type="submit" name="enterEmail" class="btn btn-primary btn-lg btn-block">SUBMIT</button>
															</div>
														</div>
												</div>
											</form>
											</div>
								</div>
											   
					</div>
				</div>
											<!-- /.panel-body -->
						
			</div>
		</div>		
	</div>
</div>
	<!-- END OF BODY -->

<script>
function showDistricts(str) {
  var xhttp;  
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "get_districts.php?p="+str, true);
  xhttp.send();
}
</script>
<script>
function showCouncils(str) {
  var xhttp;  
  if (str == "") {
    document.getElementById("txtHint2").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint2").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "get_councils.php?q="+str, true);
  xhttp.send();
}
</script>

<!-- FOOTER -->
<?php include('home_footer.php'); ?>