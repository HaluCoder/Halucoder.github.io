<!DOCTYPE html>
<html lang="en">
    <head>
<title><?php $accesLevel="tenant"; $title ="Book Block"; echo $accesLevel.' | '.$title;?> </title>
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
if (isset($_SESSION['user']))
{
	$userNames= $_SESSION['user']['fname'].' '.$_SESSION['user']['lname'];

	$userRole= $_SESSION['user']['role'];

	$userEmail= $_SESSION['user']['email'];

	$userID= $_SESSION['user']['userID'];
	
	$userPhone= $_SESSION['user']['phone'];
	
	$userGender= $_SESSION['user']['gender'];
	
	$userNames = ucwords(strtolower($userNames));
	
}
?>


<?php
$farmID 	= $_GET['farmID'];
$blockID 	= $_GET['blockID'];

$farmRents = new farmRents();
$blockValues = $farmRents-> getblockDetails($blockID);
$farmID = $blockValues['farmID'];
$blockID = $blockValues['blockID'];
$blockNo = $blockValues['blockNo'];
$rent = $blockValues['rent'];
$rent = round($rent,0);

$farmValues = $farmRents-> getfarmDetails($farmID);
$farmName = $farmValues['farmName'];
$farmNo = $farmValues['farmNo'];
 ?>

			
                <div class="col-md-8 col-md-offset-1">
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
												<label>farm Name</label>
												<input  type="text" class="form-control" placeholder="farm Name"   value="<?php echo $farmName; ?>" readonly>
											</div>
										</div>
										<div class="col-md-6 col-md-offset-0">
											<div class="form-group">
												<label>farm ID</label>
												<input  type="number" class="form-control" placeholder="farm ID." name="farmID" value="<?php echo $farmID; ?>"  readonly>
											</div>
										</div>
										
									</div>
									
									<div class="row">
										<div class="col-md-6 col-md-offset-0">
											<div class="form-group">
												<label>block ID</label>
												<input  type="number" class="form-control" placeholder="block ID." name="blockID" value="<?php echo $blockID; ?>"  readonly>
											</div>
										</div>
										<div class="col-md-6 col-md-offset-0">
											<div class="form-group">
												<label>block No</label>
												<input  type="text" class="form-control" placeholder="block No."  value="<?php echo $blockNo; ?>"  readonly>
											</div>
										</div>
									</div>
									
									<div class="row">
										
										<div class="col-md-6 col-md-offset-0">
											<div class="form-group">
												<label>Applicant Name</label>
												<input type="text" class="form-control" placeholder="block No/Name"   value="<?php echo $userNames; ?>" readonly>
											</div>
										</div>
										
										<div class="col-md-6 col-md-offset-0">
											<div class="form-group">
												<label>Phone Number</label>
												<input type="tel" class="form-control" placeholder="255...." title="Phone number must start with country code"  value="<?php echo $userPhone; ?>" size="12" readonly>
											</div>
										</div>
										
									</div>
									
									<div class="row">
										<div class="col-md-6 col-md-offset-0">
											<div class="form-group">
												<label>Start Date</label>
													<input type="date" class="form-control" title="select start date"  name="startDate" >
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
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>Rent per Accre</label>
													<input type="number" class="form-control"  id= "rent" name="rent" value="<?php echo $rent; ?>" readonly>
											</div>
										</div>
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>Accres</label>
												<input type="number" class="form-control" id= "accres" name="accres" value="1">
											</div>
										</div>
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>Total Rent</label>
												<input type="number" class="form-control" name="totalRent" id="totalRent"  value="<?php echo $rent; ?>" placeholder="Total rent" readonly>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-6 col-md-offset-3">
											<div class="form-group">
												<input type="hidden" class="form-control"  name="userID" value="<?php echo $userID; ?>" >
												
												<button type="submit" name="book_block" class="btn btn-primary btn-lg btn-block">BOOK block</button>
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