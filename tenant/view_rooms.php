<!DOCTYPE html>
<html lang="en">
    <head>
<title>Tenant | <?php $title ="View Rooms"; echo $title;?> </title>


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
		

<?php   include('tenant_head.php');    ?>

                <div class="col-lg-12 col-lg-offset-0">
                    <div class=" panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo $title;?></h3>
                        </div>
                        <div class="panel-body">
 
 <div class="table-responsive">
<?php
if(isset($_GET['houseID'])){
$houseID 	= $_GET['houseID'];

$sql = "SELECT * FROM rooms WHERE houseID='$houseID'";

}
else{
$sql = "SELECT * FROM rooms";
}
	
$result = $db->query($sql);

if ($result->num_rows>0)
	{

		echo "
		
		
<table class='table table-striped table-bordered table-hover' id='dataTables-example' width='100%'>
                                        
										   <thead>
                                                <tr>
                                                    <th>ID</th>
													<th>Photo</th>
													<th >House Details</th>
                                                    <th >Owner Details</th>
                                                    <th width='30%'>Descriptions</th>
													<th>Status</th>
													<th >Actions</th>
													
                                                </tr>
                                            </thead>
                                            <tbody>	
		
		";
		// output data of each row
		while($row = $result->fetch_assoc()) 
		{
$houseID= $row["houseID"];
$roomID= $row["roomID"];	
	
$roomNo=$row["roomNo"];
$phone=$row["phone"];
$description=$row["description"];
$size=$row["size"];
$rent=$row["rent"];
$category= $row["category"];
$roomPicture = $row["roomPicture"];
$token= $row["roomToken"];

$status= $row["roomStatus"];



$HouseRents = new HouseRents();
$HouseValues = $HouseRents-> getHouseDetails($houseID);

$query = "SELECT * FROM bookings WHERE roomID='$roomID'";
$bookings = $HouseRents-> numRows($query);		


			echo "
			
<tr class='even gradeA'>
<td>" . $roomID." </td>
   

<td>
" . 
"<a href=\"../RoomPictures/".$roomPicture."\">

<button type='button' class='btn btn-primary btn-xs' title='Preview House Picture'>
  <i class='fa fa-fw fa-eye' aria-hidden='true'  title='Preview House Picture'></i>preview
 </button>

</a>"
."

</td>


<td>
Room  <b> ".$roomNo." </b> at 
<b> ".$HouseValues['houseName']."</b> <br> room size is <b> ".$size." sqm</b>

</td>


<td>

		".$HouseValues['houseOwner']." <br>

		"."<a target='_blank' href=\"https://wa.me/".$phone."\" title='Chat on WhatsApp'>

		".$phone." 

		</a>"."

</td>

<td> <b>" .$description." </b>located at <b>" . $HouseValues['location']."</b> for <b>" .$category."</b> purposes. 
Rent now ONLY at <b>Tshs. ".number_format($rent)." </b>per month.</td>

<td>";

if ($bookings <1 && $status ==='vacant') {
     echo "<span class='label label-success' title='Room is vacant'>vacant</span>" ;
}

else if($bookings <1 && $status ==='booked'){
   echo "<span class='label label-success' title='Room is vacant'>vacant</span>" ;  
}

else if($bookings <1 && $status ==='taken'){
   echo "<span class='label label-success' title='Room is vacant'>vacant</span>" ;  
}


else if($bookings >0 && $status ==='booked'){
     echo "<span class='label label-warning' title='Room is booked by $bookings now'>booked</span>";  
}

else if($bookings >0 && $status ==='taken'){
     echo "<span class='label label-danger' title='Room is taken'>taken</span>";  
}

else{
     echo "<font color='red'>error!!</font>";  
}
echo"<br>";

if ($bookings ==1) {
     echo "<span class='label label-warning' title='There is no competition'>".$bookings." booked </span><br>" ;
}
else if (($bookings >1) && ($bookings <=2)) {
     echo "<span class='label label-danger' title='competition is Normal'>".$bookings." booked</span><br>";  
}

else if ($bookings >2) {
     echo "<span class='label label-danger' title='Competition is High'>".$bookings." booked</span><br>";  
}
echo"</td>
<td > 
";

if($status <> 'taken')
{
echo"
<a href=\"book_room.php?r=".$roomID."&h=".$houseID." \">
 <button type='button' class='btn btn-primary btn-xs' title='Book this Room'>
  <i class='fa fa-fw fa-plus' aria-hidden='true'  title='Book this Room'></i>Book Room
 </button> 
 </a>";
}
else{

echo "<span class='label label-danger' title='Room is Taken'>Room is Taken</span>" ; 
	
  }
echo"
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