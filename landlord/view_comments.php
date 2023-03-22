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
		
<title><?php $accesLevel="landlord"; $title ="View Comments"; echo $accesLevel.' |'.$title;?> </title>
<?php   include($accesLevel.'_head.php');    ?>

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

$sql = "SELECT * FROM customer_comments WHERE userID='$userID'";

}
else{
$sql = "SELECT * FROM customer_comments";
}
	
$result = $db->query($sql);

if ($result->num_rows>0)
	{

		echo "
		
		
<table class='table table-striped table-bordered table-hover' id='dataTables-example' width='100%'>
                                        
										   <thead>
                                                <tr>
                                                    <th>S/N</th>
													<th>CUSTOMER DETAILS</th>
													<th>ADDRESS</th>
													<th width='30%'>MESSAGE</th>
													<th>PICTURE</th>
													<th>STATUS</th>
													<th width='25%'>ACTIONS</th>
													
                                                </tr>
                                            </thead>
                                            <tbody>	
		
		";
		// output data of each row
		while($row = $result->fetch_assoc()) 
		{

$commentID=$row["commentID"];
$fname=$row["fname"];
$lname= $row["lname"];
$email= $row["email"];
$phone= $row["phone"];
$gender= $row["gender"];
$address= $row["address"];
$message= $row["message"];
$status= $row["status"];
$doc= $row["doc"];


$customerNames = strtoupper($fname.' '.$lname);
			echo "
			
<tr class='even gradeA'>
<td>" .$commentID." </td>
 
<td>" . $customerNames." <br>

".$phone."  <br>

".$email."  <br>

" .$gender."<br>

<td> ".$address." </td>
<td> ".$message." </td>


<td>
" . 
"<a href=\"../CustomerComments/".$doc."\">

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



<td > 

" . "<a href=\"add_status_comment.php?c=".$commentID."&e=".$email."&n=".$customerNames." \">

 <button type='button' class='btn btn-primary btn-xs' title='Add payment'>
  <i class='fa fa-fw fa-plus' aria-hidden='true'  title='Add payment'></i>Add Status
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