<!DOCTYPE html>
<html lang="en">
    <head>

<title><?php $accesLevel="tenant"; $title ="View Outbox Messages"; echo $accesLevel.' |'.$title;?> </title>
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

$sql = "SELECT * FROM advises WHERE senderID='$userID'";

}
else{
$sql = "SELECT * FROM advises WHERE senderID='$userID'";
}
	
$result = $db->query($sql);

if ($result->num_rows>0)
	{

		echo "
		
		
<table class='table table-striped table-bordered table-hover' id='dataTables-example' width='100%'>
                                        
										   <thead>
                                                <tr>
                                                    <th>S/N</th>
													<th>CONSULTANT DETAILS</th>
													<th width='20%'>SUBJECT</th>
													<th width='30%'>MESSAGE</th>
													<th>PICTURE</th>
													<th>STATUS</th>
													
                                                </tr>
                                            </thead>
                                            <tbody>	
		
		";
		// output data of each row
		while($row = $result->fetch_assoc()) 
		{
$adviseID=$row["adviseID"];
$receiverID=$row["receiverID"];
$senderID=$row["senderID"];

$subject= $row["subject"];
$message= $row["message"];
$status= $row["status"];
$doc= $row["doc"];

$advise = new FarmRents();

$senderValue = $advise-> getUserData($senderID);
	$senderPhone = $senderValue['phone'];
	$senderEmail = $senderValue['email'];
	$senderFname = $senderValue['fname'];
	$senderLname = $senderValue['lname'];
	$senderNames = ucwords($senderFname.' '.$senderLname);

$receiverValue = $advise-> getUserData($receiverID);
	$receiverPhone = $receiverValue['phone'];
	$receiverEmail = $receiverValue['email'];
	$receiverFname = $receiverValue['fname'];
	$receiverLname = $receiverValue['lname'];
	$receiverNames = ucwords($receiverFname.' '.$receiverLname);
			echo "
			
<tr class='even gradeA'>
<td>" .$adviseID." </td>
 
<td>" . $receiverNames." <br>

".$receiverPhone."  <br>

".$receiverEmail."  <br>

<td> ".$subject." </td>
<td> ".$message." </td>


<td>
" . 
"<a href=\"../ConsultantDocs/".$doc."\">

<button type='button' class='btn btn-primary btn-xs' title='Preview Attachment'>
  <i class='fa fa-fw fa-eye' aria-hidden='true'  title='Preview Attachment'></i>preview
 </button>

</a>"
."

</td>





<td>";

if ($status ==='new') {
     echo "<span class='label label-danger' title='New Comment'>New</span>" ;
}
else if($status ==='read'){
     echo "<span class='label label-green' title='Payment already read'>read</span>";  
}

else{
     echo "<span class='label label-danger' >error</span>" ;
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