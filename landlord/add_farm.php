<!DOCTYPE html>
<html lang="en">
    <head>
	
<title><?php $accesLevel="landlord"; $title ="Add Farm"; echo $accesLevel.' | '.$title;?> </title>
<?php   include($accesLevel.'_head.php');    ?>


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

                <div class="col-md-12 col-md-offset-0">
                    <div class=" panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"> <?php echo $title;?> </h3>
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
												<label>farm Name</label>
												<input  type="text" class="form-control" placeholder="farm Name" name="farmName" autofocus  >
											</div>
										</div>
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>farm Number</label>
												<input  type="text" class="form-control" placeholder="farm No." name="farmNo" >
											</div>
										</div>
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>Farm Owner</label>
												<select name="ownerID" class="form-control">
												  <option value=""> Select owner</option>
													<?php
													$sql= "select * from users where role='landlord' ";
													$result = mysqli_query($db,$sql);
													$num_rows = mysqli_num_rows($result);
													if ($num_rows > 0)
													{
														while($row = $result->fetch_assoc()) 
															{
															$ownerID =$row["userID"];
															$ownerNames = strtoupper($row["fname"].' '.$row["lname"]);
															
																echo"<option value='$ownerID'>".$ownerID.".".$ownerNames."</option>";
															}
													}

													?>
												</select>

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
												<input type="text" class="form-control" placeholder="village name" name="village">
											</div>
										</div>
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>Street </label>		
												<input type="text" class="form-control"  placeholder="street name" name="street"  >
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>Category/Soil type</label>
													<select class="form-control" name="category">
														 <option value="">Select category</option>
														 <option value="clay" selected>clay</option>
														 <option value="sand">sand</option>
														 <option value="silt">silt</option>
														 <option value="loam">loam</option>
													</select>
											</div>
										</div>
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>Descriptions</label>
												<textarea rows="3" class="form-control" placeholder="farm Descriptions..." name="description"></textarea>
											</div>
										</div>
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>farm Picture</label>
												<input type="file" class="form-control" name="doc">
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2 col-md-offset-10">
											<div class="form-group">
												<input type="hidden" class="form-control"  name="added_by" value="<?php echo $userID; ?>" >
												
												<button type="submit" name="add_farm" class="btn btn-primary btn-lg btn-block">ADD FARM</button>
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