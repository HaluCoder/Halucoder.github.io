
<!DOCTYPE html>
<html lang="en">
    <head>
 <!-- DataTables CSS -->
        <link href="../css/dataTables/dataTables.bootstrap.css" rel="stylesheet">



<!-- TITLE -->

<title>Home | <?php $title ="Contacts"; echo $title;?> </title>



<!-- HEADER -->
<?php  include('home_head.php');    ?>
<div class="wrapper">






<!-- BODY -->
	<div class="container">
		<div class="row">	
							<div class="col-lg-12 col-lg-offset-0">
								<div class=" panel panel-primary">
									<div class="panel-heading">
												<h3 class="panel-title"><?php echo $title;?></h3>
									</div>
									<div class="panel-body">
												
												<div class="col-lg-6  col-lg-offset-0  col-md-6 col-md-offset-0">
													<div class="row">
														<div class="col-lg-12  col-lg-offset-0  col-md-12 col-md-offset-0">
															<div class=" panel panel-warning">
																<div class="panel-heading">
																	<h3 class="panel-title">Our Contacts</h3>
																</div>
																		<div class="panel-body">
																		
																		Phone: <b> +255 255 255 255 </b> <br>
																		Email: <b> info@fms.co.tz </b><br>
																		fax: <b> +255 255 255 256 </b><br>
																		website: <b> www.fms.co.tz </b> 

																	</div>
															</div>
														</div>
													</div>
													<div class="row">
															<div class="col-lg-12  col-lg-offset-0  col-md-12 col-md-offset-0">
																<div class=" panel panel-success">
																	<div class="panel-heading">
																		<h3 class="panel-title">Physical Location</h3>
																	</div>
																	<div class="panel-body">
																		
																		<img src="../images/ifmlogo.jpg" alt="map" width="400px" length="400px">
																		

																	</div>
																</div>
															</div>
													</div>
												</div>
												
												
												<div class="col-lg-6  col-lg-offset-0  col-md-6 col-md-offset-0">
														<div class=" panel panel-primary">
															<div class="panel-heading">
																<h3 class="panel-title">Write to us</h3>
															</div>
															<div class="panel-body">
																<form method="post"  action="" enctype="multipart/form-data">
																				
																				
																		<h6>
																		<b>
																		<?php echo display_error(); ?>
																		<?php echo comments_sent_report(); ?>
																		</b>
																		</h6>
																		 
																		<div class="row">
																			<div class="col-md-6 col-md-offset-0">
																				<div class="form-group">
																					<label>First Name</label>
																					<input  type="text" class="form-control" placeholder="First Name" name="fname" autofocus >
																				</div>
																			</div>
																			<div class="col-md-6 col-md-offset-0">
																				<div class="form-group">
																					<label>Last Name</label>
																					<input  type="text" class="form-control" placeholder="Last Name" name="lname" >
																				</div>
																			</div>
																		</div>

																		<div class="row">
																			<div class="col-md-6 col-md-offset-0">
																				<div class="form-group">
																					<label>E-mail</label>
																					<input type="email" class="form-control" placeholder="E-mail" name="email" value="<?php echo $username ?>">
																				</div>
																			</div>
																			<div class="col-md-6 col-md-offset-0">
																				<div class="form-group">
																					<label>Phone Number</label>
																					<input type="tel" class="form-control" placeholder="255...." title="Phone number must start with country code" pattern="[255]{3}[2-9]{1}[0-9]{8}" name="phone" size="12">
																				</div>
																			</div>
																			
																		</div>
																		
																		<div class="row">
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
																			<div class="col-md-8 col-md-offset-0">
																				<div class="form-group">
																					<label>Your Address </label>		
																					<textarea  class="form-control"  placeholder="Your address, include region,district,ward, village, street" name="address" ></textarea>
																				</div>
																			</div>
																			
																		</div>
																		<div class="row">
																			<div class="col-md-12 col-md-offset-0">
																				<div class="form-group">
																					<label>Your Message </label>		
																					<textarea  class="form-control"  rows="5" placeholder="Your messages here....." name="message" ></textarea>
																				</div>
																			</div>
																		</div>
																		
																		<div class="row">
																			<div class="col-md-12 col-md-offset-0">
																				<div class="form-group">
																					<label>Any attachment</label>
																					<input type="file" class="form-control" name="doc">
																				</div>
																			</div>
																		</div>
																		
																		<div class="row">
																			<div class="col-md-12 col-md-offset-0">
																				<div class="form-group">
																					<button type="submit" name="send_comment" class="btn btn-primary btn-lg btn-block">SEND COMMENT</button>
																				</div>
																			</div>
																		</div>
																</form>
															</div>
														</div>
												</div>
									</div>
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