<!DOCTYPE html>
<html lang="en">
    <head>
<title>Tenant | <?php $title ="Add Payment"; echo $title;?> </title>

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
$houseID 	= e($_GET['h']);
$roomID 	= e($_GET['r']);
$bookingID 	= e($_GET['b']);
$tenanUserID =e($_GET['u']);
$invoiceID 	= e($_GET['i']);



$HouseRents = new HouseRents();
$RoomValues = $HouseRents-> getRoomDetails($roomID);
$roomNo = $RoomValues['roomNo'];
$rent = $RoomValues['rent'];
$rent = round($rent,0);

$invoiceValues = $HouseRents-> getInvoiceDetails($invoiceID);
$months = $invoiceValues['months'];
$totalRent = $invoiceValues['totalRent'];


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
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>Rent per month</label>
													<input type="text" class="form-control"   value="<?php echo "Tshs.".number_format($rent); ?>" readonly>
											</div>
										</div>
										
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>Months</label> 
												<input type="text" class="form-control" value="<?php echo $months." Months"; ?>" readonly>
											</div>
										</div>
										
										<div class="col-md-4 col-md-offset-0">
											<div class="form-group">
												<label>Total Rent Required</label>
													<input type="text" class="form-control"   value="<?php echo "Tshs.".number_format($totalRent); ?>" readonly>
											</div>
										</div>
										
									</div>
									
									<div class="row">
										<div class="col-md-6 col-md-offset-0">
											<div class="form-group">
												<label>Amount Paid</label>
													<input type="number" class="form-control"   name="paid" value="<?php echo round($totalRent,0); ?>" >
											</div>
										</div>
										<div class="col-md-6 col-md-offset-0">
											<div class="form-group">
												<label>Payment Confirmation</label>
													<input  type="file" class="form-control"  name="receipt">
											</div>
										</div>
									</div>
																		
									<div class="row">
										<div class="col-md-6 col-md-offset-3">
											<div class="form-group">
												<input type="hidden" class="form-control"  name="roomID" value="<?php echo $roomID; ?>" >
												<input type="hidden" class="form-control"  name="bookingID" value="<?php echo $bookingID; ?>" >
												<input type="hidden" class="form-control"  name="UserID" value="<?php echo $tenanUserID; ?>" >
												<input type="hidden" class="form-control"  name="invoiceID" value="<?php echo $invoiceID; ?>" >
												<input type="hidden" class="form-control"  name="houseID" value="<?php echo $houseID; ?>" >
												<input type="hidden" class="form-control"  name="usernames" value="<?php echo $userNames; ?>" >
												<button type="submit" name="add_payment" class="btn btn-primary btn-lg btn-block">ADD PAYMENT</button>
											</div>
										</div>
									</div>
									
							</form>
							
                        </div>
                    </div>
                </div>

<?php       include('foot.php');   ?>