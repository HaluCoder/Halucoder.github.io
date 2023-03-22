<!DOCTYPE html>
<html lang="en">
    <head>
<title>Tenant | <?php $title ="Update Profile"; echo $title;?> </title>

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



<?php   include('admin_head.php');  ?>


                <div class="col-md-8 col-md-offset-1">
                    <div class=" panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"> <?php echo $title;?> </h3>
                        </div>
                        <div class="panel-body">
                         
							<form method="post"  action="" enctype="multipart/form-data" >
						

									<h6>
									<?php echo display_error(); ?>
									<?php echo comments_sent_report(); ?>
									</h6>
									 
									<div class="row">
										<div class="col-md-12 col-md-offset-0">
											<div class="form-group">
												<label>Profile Picture</label>
													<input  type="file" class="form-control"  name="photo">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-md-offset-0">
											<div class="form-group">
												<input type="hidden" class="form-control"  name="userID" value="<?php echo $userID; ?>" >
												<input type="hidden" class="form-control"  name="usernames" value="<?php echo $userNames; ?>" >
																		
												
												<button type="submit" name="update_profile" class="btn btn-primary btn-lg btn-block">UPDATE PHOTO</button>
											</div>
										</div>
									</div>
									
									
							</form>
							
                        </div>
                    </div>
                </div>
          


<?php       include('foot.php');   ?>