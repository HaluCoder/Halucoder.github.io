<!DOCTYPE html>
<html lang="en">
    <head>
<title>Admin | <?php $title ="Add User"; echo $title;?> </title>


		<style>
		
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
		
		</style>
		

<?php   include('admin_head.php');    ?>

			<?php
if (isset($_SESSION['user']))
{
$name= $_SESSION['user']['fname'].' '.$_SESSION['user']['lname'];

$role= $_SESSION['user']['role'];

$email= $_SESSION['user']['email'];

$userID= $_SESSION['user']['userID'];

}


?>
                <div class="col-md-12 col-md-offset-0">
                    <div class=" panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo $title;?></h3>
                        </div>
                        <div class="panel-body">
                         
							<form method="post"  action="" enctype="multipart/form-data">
															
									<h6>
									<?php echo display_error(); ?>
									<?php echo comments_sent_report(); ?>
									</h6>
									 
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
												<input type="tel" class="form-control" placeholder="255...." title="Phone number must start with country code"  name="phone"  size="12">
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
												<label>password</label><small>123456</small>
												<input type="password" class="form-control" placeholder="Password" name="password" value="123456" readonly >
											</div>
										</div>
										
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>confirm password</label>
												<input type="password" class="form-control" placeholder="confirm Password" name="repassword" value="123456" readonly >
											</div>
										</div>
										
									</div>
									
									
									<div class="row">
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>Region</label><span class="mark">*</span><br>
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
												<label>District</label><span class="mark">*</span><br>
													<div id="txtHint">
													<select  class="form-control" name="district" >
														 <option value=""> Select district</option>
													
													</select>
													</div>
												
											</div>
										</div>
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
											<label>Council</label><span class="mark">*</span><br>
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
												<input type="text" class="form-control" placeholder="Ward name" name="ward" >
											</div>
										</div>
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>Village</label>
												<input type="text" class="form-control" placeholder="village name" name="village">
											</div>
										</div>
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>Street </label>		
												<input type="text" class="form-control"  placeholder="street name" name="street">
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
										<div class="col-md-4 col-md-offset-4">
											<div class="form-group">
									<input type="hidden" class="form-control"  name="added_by" value="<?php echo $userID ; ?>" >
									
									<button type="submit" name="register" class="btn btn-primary btn-lg btn-block">Create Account</button>
											</div>
										</div>
									</div>
									
									
									
									
									
									
							</form>
							
                        </div>
                    </div>
                </div>
          

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

<?php       include('foot.php');   ?>