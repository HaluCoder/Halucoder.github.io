<!DOCTYPE html>
<html lang="en">
    <head>

<title><?php $accesLevel="landlord"; $title ="View Invoices"; echo $accesLevel.' |'.$title;?> </title>
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

	if($userRole == 'landlord')
	{	
		$sql = "SELECT * FROM invoice_items where ownerID='$userID' AND farmID='$farmID' AND blockID='$blockID'";	
	}

}
else{
	
		if($userRole == 'landlord')
		{
			$sql = "SELECT * FROM invoice_items where ownerID='$userID' ";	
		}

}

$result = $db->query($sql);

if ($result->num_rows>0)
	{

		echo "
		
		
<table class='table table-striped table-bordered table-hover' id='dataTables-example' width='100%'>
                                        
										   <thead>
                                                <tr>
                                                    <th>S/N</th>
													<th>TENANT DETAILS</th>
													<th>INVOICED</th>
													<th>PAID </th>
													<th>REMAINED</th>
													<th>STATUS</th>
													<th>PER BOOKING </th>
													<th>PER TENANT</th>
													<th>PAYMENTS</th>
													
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

$rent= $row["rent"];
$accres= $row["accres"];
$tax_rate= $row["tax_rate"];
$total_rent_before_tax= $row["total_rent_before_tax"];
$totalRent= $row["totalRent"];
$status= $row["status"];
$paid= $row["paid"];
$WHT = $tax_rate * $total_rent_before_tax;

$remainder= $totalRent - $paid;



$FarmRents = new FarmRents();

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
<td>" .$count." </td>
 
<td>" . $tenantNames." <br>

" . $tenantPhone."
</td>

<td>" . number_format($totalRent)." </td>

<td>" . number_format($paid)." </td>

<td>" . number_format($remainder)." </td>


<td>";

if ($status ==='paid') {
     echo "<span class='label label-success' title='Paid full amount'>paid</span>" ;
}
else if($status ==='paid some'){
     echo "<span class='label label-warning' title='paid some'>paid some</span>";  
}

else if($status ==='not paid'){
     echo "<span class='label label-danger' title='not paid'>not paid</span>";  
}

else{
     echo "<font color='red'>error!!</font>";  
}

echo"</td>



<td > 


" . "<a href=\"preview_invoice.php?u=".$userID."&i=".$invoiceID."&b=".$bookingID."&r=".$blockID."&h=".$farmID." \">

 <button type='button' class='btn btn-success btn-xs' title='preview  this invoice'>
  <i class='fa fa-fw fa-eye' aria-hidden='true'  title='preview this invoice'></i>Preview Invoice
 </button> 
  
</a>"."

" . "<a href=\"print_invoice.php?u=".$userID."&i=".$invoiceID."&b=".$bookingID."&r=".$blockID."&h=".$farmID." \">

 <button type='button' class='btn btn-danger btn-xs' title='preview  this invoice'>
  <i class='fa fa-fw fa-download' aria-hidden='true'  title='Print this invoice'></i>Print Invoice
 </button> 
  
</a>"."

</td>



<td > 

" . "<a href=\"preview_individual_invoices.php?u=".$userID."&i=".$invoiceID."&b=".$bookingID."&r=".$blockID."&h=".$farmID." \">

 <button type='button' class='btn btn-success btn-xs' title='preview  Individual invoices'>
  <i class='fa fa-fw fa-eye' aria-hidden='true'  title='preview Individual invoices'></i>Preview Invoices
 </button> 
  
</a>"."

" . "<a href=\"print_individual_invoices.php?u=".$userID."&i=".$invoiceID."&b=".$bookingID."&r=".$blockID."&h=".$farmID." \">

 <button type='button' class='btn btn-danger btn-xs' title='preview  Individual invoices'>
  <i class='fa fa-fw fa-download' aria-hidden='true'  title='Print Individual invoices'></i>Print Invoices
 </button> 
  
</a>"."

</td>

<td > 


" . "<a href=\"view_payments.php?i=".$invoiceID."\">

 <button type='button' class='btn btn-primary btn-xs' title='Add payment'>
  <i class='fa fa-fw fa-eye' aria-hidden='true'  title='Add payment'></i>Payments
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