<!DOCTYPE html>
<html lang="en">
    <head>
<title><?php $accesLevel="admin"; $title ="Add Block"; echo $accesLevel.' | '.$title;?> </title>
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


			
	<div class="col-md-8 col-md-offset-1">
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
				<?php if(isset($_GET['farmID']))
				{
					$farmID = $_GET['farmID'];
					$sql = "SELECT * FROM farms where farmID ='$farmID'
					";	
					$result = $db->query($sql);	
					if ($result->num_rows >=0)
					{
					$row = $result->fetch_assoc(); 
						
					$farmName=$row["farmName"];

					}
					?>
						<div class="row">
							<div class="col-md-6 col-md-offset-0">
								<div class="form-group">
									<label>farm Name</label>
									<input  type="text" class="form-control" placeholder="farm Name" value="<?php echo $farmName; ?>" readonly>
								</div>
							</div>
							<div class="col-md-6 col-md-offset-0">
								<div class="form-group">
									<label>farm ID</label>
									<input  type="text" class="form-control" placeholder="farm ID." name="farmID" value="<?php echo $farmID; ?>"  readonly>
								</div>
							</div>
						</div>
					 
		<?php   }else{   ?>
						<div class="row">
							<div class="col-md-12 col-md-offset-0">
								<div class="form-group">
									<label>Farm Name</label>
									<select name="farmID" class="form-control">
									  <option value=""> Select Farm</option>
										<?php
										$sql= "select * from farms";
										$result = mysqli_query($db,$sql);
										$num_rows = mysqli_num_rows($result);
										if ($num_rows > 0)
										{
											while($row = $result->fetch_assoc()) 
												{
												$farmID =$row["farmID"];
												$farmName = strtoupper($row["farmName"]);
												
													echo"<option value='$farmID'>".$farmID.".".$farmName."</option>";
												}
										}

										?>
									</select>
								</div>
							</div>
							
						</div>
				
				<?php }?>
				
				
				
				
				
						<div class="row">
							
							<div class="col-md-6 col-md-offset-0">
								<div class="form-group">
									<label>block Number/Name</label>
									<input type="text" class="form-control" placeholder="block No/Name" name="blockNo"  autofocus>
								</div>
							</div>
							
							<div class="col-md-6 col-md-offset-0">
								<div class="form-group">
									<label>block Size</label><small> (in Acres)</small>
									<input type="number" class="form-control" name="size" placeholder="block size in Acres">
								</div>
							</div>
							
						</div>
						
						
						
						<div class="row">
							
							<div class="col-md-6 col-md-offset-0">
								<div class="form-group">
									<label>Rent per Acre</label><small> (in Tshs)</small>
										<input type="number" class="form-control" name="rent" placeholder="Rent per Acre in Tshs" >
								</div>
							</div>
							
							<div class="col-md-6 col-md-offset-0">
								<div class="form-group">
									<label>Category</label>
									<select name="category" class="form-control">
									  <option value=""> Select category</option>
									<?php
									$sql= "select DISTINCT category from farms where farmID='$farmID' ";
									$result = mysqli_query($db,$sql);
									$num_rows = mysqli_num_rows($result);
									if ($num_rows > 0)
									{
										while($row = $result->fetch_assoc()) 
											{
											$category =$row["category"];
											
												echo"<option value='$category'>".$category."</option>";
											}
									}

									?>
									</select>

								</div>
							</div>
							
							
						</div>
						
						<div class="row">
							<div class="col-md-12 col-md-offset-0">
								<div class="form-group">
									<label>block Picture</label>
									<input type="file" class="form-control" name="doc">
								</div>
							</div>
							
							
						</div>
						
						<div class="row">
							<div class="col-md-12 col-md-offset-0">
									<div class="form-group">
										<label>Descriptions</label>
										<textarea rows="3" class="form-control" placeholder="Block Descriptions..." name="description"></textarea>
									</div>
							</div>
						</div>
						
						
						<div class="row">
							<div class="col-md-3 col-md-offset-9">
								<div class="form-group">
						<input type="hidden" class="form-control"  name="added_by" value="<?php echo $userID; ?>" >
						
						<button type="submit" name="add_block" class="btn btn-primary btn-lg btn-block">ADD BLOCK</button>
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