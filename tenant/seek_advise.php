<!DOCTYPE html>
<html lang="en">
    <head>
	
	
<title><?php $accesLevel="tenant"; $title ="Seek Advise from Consultant"; echo $accesLevel.' |'.$title;?> </title>
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

<?php
$receiverID =e($_GET['i']);
$receiverNames =e($_GET['n']);
$receiverEmail =e($_GET['e']);
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
												<label>Consultant Names</label>
													<input type="text" class="form-control"   name="receiverNames" value="<?php echo $receiverNames; ?>" readonly>
											</div>
										</div>
										<div class="col-md-6 col-md-offset-0">
											<div class="form-group">
												<label>Consultant E mail</label>
													<input  type="text" class="form-control"  name="receiverEmail" value="<?php echo $receiverEmail; ?>" readonly>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-12 col-md-offset-0">
											<div class="form-group">
												<label>SUBJECT</label>
													<input type="text" class="form-control"   name="subject" placeholder="YAH: ......." >
											</div>
										</div>
										
									</div>
									<div class="row">
										<div class="col-md-12 col-md-offset-0">
											<div class="form-group">
												<label>MESSAGE</label>
													<textarea rows="3" class="form-control" placeholder="Your message here..." name="message"></textarea>
													
											</div>
										</div>
										
									</div>
									
									<div class="row">
										
										<div class="col-md-12 col-md-offset-0">
											<div class="form-group">
												<label>Attachment if any</label>
													<input  type="file" class="form-control"  name="doc">
											</div>
										</div>
									</div>
									
									
																		
									<div class="row">
										<div class="col-md-6 col-md-offset-3">
											<div class="form-group">
												
												<input type="hidden" class="form-control"  name="receiverID" value="<?php echo $receiverID; ?>" >
												<input type="hidden" class="form-control"  name="senderID" value="<?php echo $userID; ?>" >
												<input type="hidden" class="form-control"  name="senderNames" value="<?php echo $userNames; ?>" >
												<input type="hidden" class="form-control"  name="senderEmail" value="<?php echo $userEmail; ?>" >
												
												<button type="submit" name="seek_advise" class="btn btn-primary btn-lg btn-block">SEND</button>
											</div>
										</div>
									</div>
									
							</form>
							
                        </div>
                    </div>
                </div>

<?php       include('foot.php');   ?>