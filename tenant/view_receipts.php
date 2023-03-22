<!DOCTYPE html>
<html lang="en">
    <head>

<title><?php $accesLevel="tenant"; $title ="View Receipts"; echo $accesLevel.' |'.$title;?> </title>
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
		


                <div class="col-lg-12 col-lg-offset-0">
                    <div class=" panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo $title;?></h3>
                        </div>
                        <div class="panel-body">
 
 <div class="table-responsive">
<?php
if(isset($_GET['farmID']) && isset($_GET['blockID'])){
$farmID 	= $_GET['farmID'];
$blockID 	= $_GET['blockID'];

	if($userRole == 'admin')
	{
	$sql = "SELECT * FROM receipts WHERE  farmID='$farmID' AND blockID='$blockID'";
	}
	else if($userRole == 'landlord')
	{
		$sql = "SELECT * FROM farms WHERE ownerID='$userID' AND farmID='$farmID' ";
		$result = $db->query($sql);
		while($row = $result->fetch_assoc()) 
		{
		$farmID 	= $row['farmID'];		
		}
		
		$sql = "SELECT * FROM receipts 
		WHERE  farmID='$farmID' AND blockID='$blockID'";
	}
	else if($userRole == 'tenant')
	{
		$sql = "SELECT * FROM receipts 
		WHERE  farmID='$farmID' AND blockID='$blockID'";
	}

}
else{
		if($userRole == 'admin')
		{
			$sql = "SELECT * FROM receipts";
		}
		else if($userRole == 'landlord')
		{
			$sql = "SELECT * FROM farms WHERE ownerID='$userID' ";
			$result = $db->query($sql);
			while($row = $result->fetch_assoc()) 
			{
			$farmID 	= $row['farmID'];		
			}
			
			$sql = "SELECT * FROM receipts 
			WHERE  farmID='$farmID'";	
		}
		else if($userRole == 'tenant')
		{
			$sql = "SELECT * FROM receipts 
			WHERE userID='$userID' ";
		}
}



$result = $db->query($sql);

if ($result->num_rows>0)
	{

		echo "
		
		
<table class='table table-striped table-bordered table-hover' id='dataTables-example' width='100%'>
                                        
										   <thead>
                                                <tr>
                                                    <th>ID</th>
													<th>DETAILS</th>
													<th>PAID AMOUNT </th>
													<th>ATTACHMENTS</th>
													<th>STATUS</th>
													<th>ACTIONS</th>
                                                </tr>
                                            </thead>
                                            <tbody>	
		
		";
$count = 0;
		// output data of each row
		while($row = $result->fetch_assoc()) 
		{
$count++;


$farmID= e($row["farmID"]);
$blockID= e($row["blockID"]);
$userID= e($row["userID"]);
$bookingID= e($row["bookingID"]);
$invoiceID= e($row["invoiceID"]);
$payID= e($row["payID"]);
$receiptID = e($row["receiptID"]);
$paidAmount = e($row["paid"]);

$receiptDoc = e($row["receipt"]);



$FarmRents = new FarmRents();

$paymentValues = $FarmRents-> getPaymentDetails($payID);
$amountPaid =	$paymentValues['paid'];
$paymentDoc =	$paymentValues['receipt'];
$pay_status =	$paymentValues['pay_status'];


//Retreiving data from Bookings table
$bookingValues = $FarmRents-> getBookingDetails($bookingID);
$startDate =	$bookingValues['startDate'];
$endDate =	$bookingValues['endDate'];
$startDate = date("d-M-Y", strtotime($startDate));
$endDate = date("d-M-Y", strtotime($endDate));


//Retreiving data from users table where role is tenant
$TenantValues = $FarmRents-> getTenantDetails($userID);
$tenantNames = ucwords($TenantValues['fname'].' '.$TenantValues['lname']);
$tenantPhone =	$TenantValues['phone'];
$tenantEmail =	$TenantValues['email'];

//Retreiving data from farms table
$farmValues = $FarmRents-> getFarmDetails($farmID);
$farmName = $farmValues['farmName'];
$farmNo = $farmValues['farmNo'];
$ownerID = $farmValues['ownerID'];

$ownerValue = $FarmRents-> getUserData($ownerID);
	$ownerPhone = $ownerValue['phone'];
	$ownerEmail = $ownerValue['email'];
	$ownerFname = $ownerValue['fname'];
	$ownerLname = $ownerValue['lname'];
	$ownerNames = ucwords($ownerFname.' '.$ownerLname);

//Retreiving data from blocks table
$blockValues = $FarmRents-> getBlockDetails($blockID);
$blockNo = $blockValues['blockNo'];
$blockPicture = $blockValues['blockPicture'];


			echo "
			
<tr class='even gradeA'>
<td>" .$receiptID." </td>
 
<td>
" . $tenantNames.",
" . $tenantPhone." , 
" . $tenantEmail." <br>
" . $farmName." ,
" . $blockNo."

</td>

<td>Tshs. " . number_format($paidAmount)." </td>

<td>
" . 
"<a href=\"../Receipts/".$paymentDoc."\">

<button type='button' class='btn btn-primary btn-xs' title='Preview payment attachment'>
  <i class='fa fa-fw fa-eye' aria-hidden='true'  title='Preview payment attachment'></i>Payment attachment
 </button>

</a>"
."


" . 
"<a href=\"../Receipts/".$receiptDoc."\">

<button type='button' class='btn btn-success btn-xs' title='Preview Receipt attachment'>
  <i class='fa fa-fw fa-eye' aria-hidden='true'  title='Preview Receipt attachment'></i>Receipt attachment
 </button>

</a>"
."

</td>
<td>";

if ($pay_status ==='received') {
     echo "<span class='label label-success' title='Payment received'>received</span>" ;
}
else if($pay_status ==='pending'){
     echo "<span class='label label-warning' title='Payment not received'>pending..</span>";  
}

else if($pay_status ==='denied'){
     echo "<span class='label label-danger' title='Payment is denied, please contact Accountant'>denied</span>";  
}

else{
     echo "<font color='red'>error!!</font>";  
}

echo"</td>



<td > 


" . "<a href=\"preview_receipt.php?u=".$userID."&i=".$invoiceID."&b=".$bookingID."&r=".$blockID."&h=".$farmID."&p=".$payID." \">

 <button type='button' class='btn btn-success btn-xs' title='preview  this Receipt'>
  <i class='fa fa-fw fa-eye' aria-hidden='true'  title='preview this Receipt'></i>Preview Receipt
 </button> 
  
</a>"."


" . "<a href=\"print_receipt.php?u=".$userID."&i=".$invoiceID."&b=".$bookingID."&r=".$blockID."&h=".$farmID."&p=".$payID." \">

 <button type='button' class='btn btn-danger btn-xs' title='Print  receipt for this Payment'>
  <i class='fa fa-fw fa-download' aria-hidden='true'  title='Print  receipt for this Payment'></i>Print Receipt
 </button> 
  
</a>"."


</td>

</tr>

	 ";
	 }
	 echo "	</tbody>
         </table>";
	 
		} 
	  else
		{
		echo "<center>	
		
<div class='alert alert-info alert-dismissible col-lg-12 col-lg-offset-0'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
 Sorry!. There is no Data to display.
   </div>
      	</center>";
        }
	
	

?>									


                                   
                                    </div>
             	

                        </div>
                    </div>
                </div>   

<?php       include('foot.php');   ?>