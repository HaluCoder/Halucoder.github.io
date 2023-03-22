<!DOCTYPE html>
<html lang="en">
    <head>
	
<title><?php $accesLevel="tenant"; $title ="View  Bookings"; echo $accesLevel.' | '.$title;?> </title>
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
if(isset($_GET['userID'])){
$userID 	= $_GET['userID'];

$sql = "SELECT * FROM invoice_items WHERE userID='$userID'";

}
else{

$sql = "SELECT * FROM bookings
WHERE userID='$userID'";

}
	
$result = $db->query($sql);

if ($result->num_rows>0)
	{

		echo "
		
		
<table class='table table-striped table-bordered table-hover' id='dataTables-example' width='100%'>
                                        
										   <thead>
                                                <tr>
                                                    <th>S/N</th>
													<th>BLOCK</th>
													<th>FARM</th>
													<th>OWNER </th>
													<th width='25%'>DURATION</th>
													<th>PICTURE</th>
													<th>STATUS</th>
													
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
$status= e($row["status"]);


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

<td>" .$blockNo." </td>

<td>" . $farmName." </td>

<td>

		".$ownerNames." <br>

		"."<a target='_blank' href=\"https://wa.me/".$ownerPhone."\" title='Chat on WhatsApp'>

		".$ownerPhone."

		</a>"."

</td>


<td>".$startDate." to 
 ".$endDate." 
 </td>



<td>

" . 
"<a href=\"../BlockPictures/".$blockPicture."\">

<button type='button' class='btn btn-primary btn-xs' title='Preview farm Picture'>
  <i class='fa fa-fw fa-eye' aria-hidden='true'  title='Preview farm Picture'></i>preview
 </button>

</a>"
."

</td>

<td>";

if ($status ==='approved') {
     echo "<span class='label label-success' title='approved Booking'>approved</span>" ;
}
else if($status ==='pending'){
     echo "<span class='label label-warning' title='approved Booking'>pending</span>";  
}

else if($status ==='rejected'){
     echo "<span class='label label-danger' title='rejected Booking'>reject</span>";  
}

else{
     echo "<font color='red'>error!!</font>";  
}

echo"</td>


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