<!DOCTYPE html>
<html lang="en">
    <head>


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

<title><?php $accesLevel="admin"; $title ="Add Comments Status"; echo $accesLevel.' |'.$title;?> </title>
<?php   include($accesLevel.'_head.php');    ?>

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
$customerEmail 	= e($_GET['e']);
$commentID 	= e($_GET['c']);
$customerNames= e($_GET['n']);



 ?>

			
                <div class="col-md-6 col-md-offset-2">
                    <div class=" panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"> <?php echo $title;?> </h3>
                        </div>
                        <div class="panel-body">
                         
								<form method="post"  action="" enctype="multipart/form-data"  >
						
									<h6>
									<?php echo display_error(); ?>
									<?php echo comments_sent_report(); ?>
									</h6>
									 
									
									<div class="row">
										<div class="col-md-6 col-md-offset-0">
												<div class="form-group">
													<label>Customer Name</label>
														<input type="text" class="form-control"   value="<?php echo $customerNames; ?>" readonly>
												</div>
										</div>
										<div class="col-md-6 col-md-offset-0">
												<div class="form-group">
													<label>Comment Email</label>
														<input type="text" class="form-control"   value="<?php echo $customerEmail; ?>" readonly>
												</div>
										</div>
										
									</div>
									
									<div class="row">
										<div class="col-md-12 col-md-offset-0">
											<div class="form-group">
												<label>Reply Content</label>
													<textarea class="form-control" name="replyContent" ></textarea>
											</div>
											
										</div>
										
									</div>
									<div class="row">
										<div class="col-md-12 col-md-offset-0">
											<div class="form-group">
												<label>Attachment</label>
													<input  type="file" class="form-control"  name="doc">
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-12 col-md-offset-0">
											<div class="form-group">
												<input type="hidden" class="form-control"  name="commentID" value="<?php echo $commentID; ?>" >
												
												
												<input type="hidden" class="form-control"  name="usernames" value="<?php echo $customerNames; ?>" >
												<button type="submit" name="add_comment_status" class="btn btn-primary btn-lg btn-block">ADD PAYMENT STATUS</button>
											</div>
										</div>
									</div>
									
							</form>
							
                        </div>
                    </div>
                </div>

<?php       include('foot.php');   ?>