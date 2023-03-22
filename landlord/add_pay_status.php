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

<title><?php $accesLevel="landlord"; $title ="Add Payment Status"; echo $accesLevel.' |'.$title;?> </title>
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
$farmID 	= e($_GET['h']);
$blockID 	= e($_GET['r']);
$bookingID 	= e($_GET['b']);
$tenantUserID =e($_GET['u']);
$invoiceID 	= e($_GET['i']);
$payID 	= e($_GET['p']);


$FarmRents = new FarmRents();
$paymentValues = $FarmRents-> getPaymentDetails($payID);
$paid = $paymentValues['paid'];
$receipt = $paymentValues['receipt'];
$pay_status = $paymentValues['pay_status'];

$invoiceValues = $FarmRents-> getInvoiceDetails($invoiceID);
$accres = $invoiceValues['accres'];
$total_rent_before_tax = $invoiceValues['total_rent_before_tax'];
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
										<div class="col-md-6 col-md-offset-0">
											<div class="form-group">
												<label>Rent Required to pay</label>
													<input type="text" class="form-control"   value="<?php echo "Tshs.".number_format($totalRent); ?>" readonly>
											</div>
										</div>
										
										<div class="col-md-6 col-md-offset-0">
											<div class="form-group">
												<label>Rent Paid</label>
													<input type="text" class="form-control"   value="<?php echo "Tshs.".number_format($paid); ?>" readonly>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-6 col-md-offset-0">
											<div class="form-group">
												<label>Invoice Status</label>
													<select class="form-control"  name="invoice_status">
														<option value="" selected>select </option>
														<option value="paid"> Fully Paid</option>
														<option value="paid some"> Paid Some</option>
														<option value="not paid">Not Paid</option>
													</select>
											</div>
											
										</div>
										<div class="col-md-6 col-md-offset-0">
											<div class="form-group">
												<label>Payment Status</label>
													<select class="form-control"  name="payment_status">
														<option value="" selected>select </option>
														<option value="received">Payment Received</option>
														<option value="pending"> Paid pending</option>
														<option value="denied">Payment denied</option>
													</select>
											</div>
											
										</div>
										
									</div>
									<div class="row">
										<div class="col-md-12 col-md-offset-0">
											<div class="form-group">
												<label>Payment Receipt</label>
													<input  type="file" class="form-control"  name="receipt">
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-6 col-md-offset-3">
											<div class="form-group">
												<input type="hidden" class="form-control"  name="paid" value="<?php echo $paid; ?>" >
												<input type="hidden" class="form-control"  name="purpose" value="<?php echo $purpose; ?>" >
												
												<input type="hidden" class="form-control"  name="blockID" value="<?php echo $blockID; ?>" >
												<input type="hidden" class="form-control"  name="bookingID" value="<?php echo $bookingID; ?>" >
												<input type="hidden" class="form-control"  name="userID" value="<?php echo $tenantUserID; ?>" >
												<input type="hidden" class="form-control"  name="invoiceID" value="<?php echo $invoiceID; ?>" >
												<input type="hidden" class="form-control"  name="farmID" value="<?php echo $farmID; ?>" >
												<input type="hidden" class="form-control"  name="payID" value="<?php echo $payID; ?>" >
												<input type="hidden" class="form-control"  name="usernames" value="<?php echo $userNames; ?>" >
												<button type="submit" name="add_payment_status" class="btn btn-primary btn-lg btn-block">ADD PAYMENT STATUS</button>
											</div>
										</div>
									</div>
									
							</form>
							
                        </div>
                    </div>
                </div>

<?php       include('foot.php');   ?>