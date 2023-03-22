<!DOCTYPE html>
<html lang="en">
    <head>
	
	
<title><?php $accesLevel="tenant"; $title ="view Farms"; echo $accesLevel.' | '.$title;?> </title>
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

$sql1 = "SELECT * FROM invoice_items 
WHERE userID='$userID' 
AND status = 'paid'
";
		$result1 = $db->query($sql1);
		while($row1 = $result1->fetch_assoc()) 
		{
			$farmID= $row1["farmID"];
			
		}


$sql = "SELECT * FROM farms,blocks,bookings,invoice_items
WHERE bookings.userID = invoice_items.userID
AND bookings.farmID = invoice_items.farmID
AND blocks.blockStatus = 'taken'
";


$result = $db->query($sql);

if ($result->num_rows>0)
	{

		echo "
		
		
<table class='table table-striped table-bordered table-hover' id='dataTables-example' width='100%'>
                                        
										   <thead>
                                                <tr>
                                                    <th>ID</th>
													<th >Photo</th>
													<th width='20%'>Farm details</th>
                                                    <th width='20%'>Owner Details</th>
                                                    <th width='30%'>Description</th>
													<th width='20%'>Actions</th>
													
                                                </tr>
                                            </thead>
                                            <tbody>	
		
		";
		// output data of each row
		while($row = $result->fetch_assoc()) 
		{
$farmID= $row["farmID"];			
$farmNo=$row["farmNo"];
$farmName=$row["farmName"];
$description=$row["description"];
$category= $row["category"];
$farmPicture = $row["farmPicture"];
$token= $row["farmToken"];


$farmName =strtoupper($farmName);
$farmNo =strtoupper($farmNo);
$ownerID=$row["ownerID"];


$FarmRents = new FarmRents();

$userID = $ownerID;
$owner = $FarmRents->getUserData($userID);
$Fname =  strtoupper($owner['fname']);
$Lname =  strtoupper($owner['lname']);
$farmOwner = $Fname.' '.$Lname;
$farmOwner =strtoupper($farmOwner);

$ownerPhone =  $owner['phone'];
			echo "
			
<tr class='even gradeA'>
<td>

" . $farmID."

</td>
   
	
<td>
" . 
"<a href=\"../FarmPictures/".$farmPicture."\">

<button type='button' class='btn btn-primary btn-xs' title='Preview farm Picture'>
  <i class='fa fa-fw fa-eye' aria-hidden='true'  title='Preview farm Picture'></i>preview
 </button>

</a>"
."

</td>

<td>" .$farmName."</td>

<td>
".$farmOwner." <br>
" . 
"<a target='_blank' href=\"https://wa.me/".$ownerPhone."\" title='Chat on WhatsApp'>
" . $ownerPhone."
</a>"
."</td>

<td> <b>" .$description."  for <b>" .$category."</b> purposes</td>



<td > 

" . "<a href=\"my_blocks.php?farmID=".$farmID."\">

 <button type='button' class='btn btn-success btn-xs' title='view blocks in this Farm'>
  <i class='fa fa-fw fa-eye' aria-hidden='true'  title='view blocks in this Farm'></i>view Blocks
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