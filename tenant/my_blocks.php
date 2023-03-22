<!DOCTYPE html>
<html lang="en">
    <head>
<title><?php $accesLevel="tenant"; $title ="View my Blocks"; echo $accesLevel.' | '.$title;?> </title>
<?php   include($accesLevel.'_head.php'); ?>

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
			$blockID= $row1["blockID"];

		}


$sql = "SELECT * FROM blocks,bookings,invoice_items
WHERE bookings.userID = invoice_items.userID
AND bookings.blockID = invoice_items.blockID
AND invoice_items.userID = '$userID'
AND invoice_items.status = 'paid'
AND blocks.blockStatus = 'taken'
AND blocks.blockID = '$blockID'
";
$result = $db->query($sql);

if ($result->num_rows>0)
	{

		echo "
		
		
<table class='table table-striped table-bordered table-hover' id='dataTables-example' width='100%'>
                                        
										   <thead>
                                                <tr>
                                                    <th>ID</th>
													<th>Photo</th>
													<th>farm Details</th>
                                                    <th>Owner Details</th>
                                                    <th>Descriptions</th>
													
                                                </tr>
                                            </thead>
                                            <tbody>	
		
		";
		// output data of each row
		while($row = $result->fetch_assoc()) 
		{
$farmID= $row["farmID"];
$blockID= $row["blockID"];
$blockNo=$row["blockNo"];
$description=$row["description"];
$size=$row["size"];
$rent=$row["rent"];
$category= $row["category"];
$blockPicture = $row["blockPicture"];
$token= $row["blockToken"];
$status= $row["blockStatus"];



$FarmRents = new FarmRents();
$FarmValues = $FarmRents-> getFarmDetails($farmID);
$ownerID = $FarmValues['ownerID'];

$ownerValue = $FarmRents-> getUserData($ownerID);
	$ownerPhone = $ownerValue['phone'];
	$ownerEmail = $ownerValue['email'];
	$ownerFname = $ownerValue['fname'];
	$ownerLname = $ownerValue['lname'];
	$ownerNames = ucwords($ownerFname.' '.$ownerLname);
	
	
			echo "
			
<tr class='even gradeA'>
<td>" . $blockID." </td>
   

<td>
" . 
"<a href=\"../blockPictures/".$blockPicture."\">

<button type='button' class='btn btn-primary btn-xs' title='Preview farm Picture'>
  <i class='fa fa-fw fa-eye' aria-hidden='true'  title='Preview farm Picture'></i>preview
 </button>

</a>"
."

</td>


<td>
block  <b> ".$blockNo." </b> at 
<b> ".$FarmValues['farmName']."

</td>


<td>

		".$ownerNames." <br>

		"."<a target='_blank' href=\"https://wa.me/".$ownerPhone."\" title='Chat on WhatsApp'>

		".$ownerPhone."

		</a>"."

</td>

<td> <b>" .$description." </b>.<br>
Rent: <b>Tshs. ".number_format($rent)." </b>per Accre.</td>

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
 Sorry!. There are No blocks here. <a href=\"add_block.php\">CLICK HERE TO ADD BLOCK</a>
   </div>
      	</center>";
        }
	
	

?>									


                                   
                                    </div>
             	

                        </div>
                    </div>
                </div>   

<?php       include('foot.php');   ?>