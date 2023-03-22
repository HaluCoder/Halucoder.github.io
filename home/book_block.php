<!DOCTYPE html>
<html lang="en">
    <head>
	
<title><?php $accesLevel="home"; $title ="Book Block"; echo $accesLevel.' | '.$title;?> </title>
<?php   include($accesLevel.'_head.php'); ?>

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


<?php
	
$farmToken 	= $_GET['_f'];
$blockToken 	= $_GET['_b'];

$FarmRents = new FarmRents();
$blockValues = $FarmRents-> getBlocks($blockToken);
$farmID = $blockValues['farmID'];
$blockID = $blockValues['blockID'];
$blockNo = $blockValues['blockNo'];
$rent = $blockValues['rent'];
$rent = round($rent,0);

$farmValues = $FarmRents-> getFarms($farmToken);
$farmName = $farmValues['farmName'];
$ownerID = $farmValues['ownerID'];
$farmNo = $farmValues['farmNo'];

$ownerValue = $FarmRents-> getUserData($ownerID);
	$ownerPhone = $ownerValue['phone'];
	$ownerEmail = $ownerValue['email'];
	$ownerFname = $ownerValue['fname'];
	$ownerLname = $ownerValue['lname'];
	$ownerNames = ucwords($ownerFname.' '.$ownerLname);
	



 ?>

			
                <div class="col-md-8 col-md-offset-2">
                    <div class=" panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"> <?php echo $title;?> </h3>
                        </div>
                        <div class="panel-body">
                         
							<form method="post"  action="" enctype="multipart/form-data" oninput="totalRent.value = parseInt(rent.value) * parseInt(accres.value)"  >
						

									<h6>
									<?php echo display_error(); ?>
									<?php echo comments_sent_report(); ?>
									</h6>
									 
																		
																		
																		<div class="row">
																																						
																			<div class="col-md-6 col-md-offset-0">
																				<div class="form-group">
																					<label>Start Date</label>
																						<input type="date" class="form-control" title="select start date"  name="startDate" autofocus>
																				</div>
																			</div>
																			<div class="col-md-6 col-md-offset-0">
																				<div class="form-group">
																					<label>End Date</label>
																					<input type="date" class="form-control" title="select due date"  name="endDate"   >
																				</div>
																			</div>
																		</div>
																		
																		<div class="row">
																			<div class="col-md-6 col-md-offset-0">
																				<div class="form-group">
																					<label>Accres</label>
																					<input type="number" class="form-control" id= "accres" name="accres" value="1">
																				</div>
																			</div>
																			<div class="col-md-6 col-md-offset-0">
																				<div class="form-group">
																					<label>Total Rent</label>
																					<input type="number" class="form-control" name="totalRent" id="totalRent"  value="<?php echo $rent; ?>" placeholder="Total rent" readonly>
																				</div>
																			</div>
																		</div>
									
																			<!--USER REG -->
									
																		<div class="row">
																			<div class="col-md-4 col-md-offset-0">
																				<div class="form-group">
																					<label>First Name</label>
																					<input  type="text" class="form-control" placeholder="First Name" name="fname"  >
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
																					<input type="number" class="form-control" placeholder="255...." title="Phone number must start with country code"  name="phone">
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
																					<input type="password" class="form-control" placeholder="Password" name="password"  >
																				</div>
																			</div>
																			
																			<div class="col-md-4 col-md-offset-0">
																				<div class="form-group">
																					<label>confirm password</label>
																					<input type="password" class="form-control" placeholder="confirm Password" name="repassword"  >
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
																			<div class="col-md-12 col-md-offset-0">
																				<div class="form-group">
																					<label>Passport size Photo</label><small> (2MB maximum Size)</small>
																					<input type="file" class="form-control" name="photo">
																				</div>
																			</div>
																		</div>
																		<div class="row">
																				<div class="col-md-6 col-md-offset-3">
																					<div class="form-group">
																						<input type="hidden" class="form-control"  name="userID" value=NULL >
																						<input type="hidden" class="form-control"  name="role" value="tenant" >
																						<input type="hidden" class="form-control"  name="added_by" value=NULL>
																						
																					<input  type="hidden" class="form-control" placeholder="farm ID." name="farmID" value="<?php echo $farmID; ?>"  readonly>
																				
																					<input  type="hidden" class="form-control" placeholder="block ID." name="blockID" value="<?php echo $blockID; ?>"  readonly>
																					<input type="hidden" class="form-control"  id= "rent" name="rent" value="<?php echo $rent; ?>" readonly>
																					
																					
																						<button type="submit" name="user_booking" class="btn btn-primary btn-lg btn-block">SUBMIT</button>
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

<?php       include('home_footer.php');   ?>