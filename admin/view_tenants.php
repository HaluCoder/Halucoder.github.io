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
		

<title><?php $accesLevel="admin"; $title ="View Tenants"; echo $accesLevel.' |'.$title;?> </title>
<?php   include($accesLevel.'_head.php');    ?>



                <div class="col-lg-12 col-lg-offset-0">
                    <div class=" panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo $title;?></h3>
                        </div>
                        <div class="panel-body">
 
 <div class="table-responsive">
<?php

$sql = "SELECT *
FROM tenants
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
													<th '>User Names</th>
													<th>User Details</th>
													<th>Role</th>
													<th>Status</th>
													<th width='30%'>Actions</th>
													
												
                                                   
													
                                                </tr>
                                            </thead>
                                            <tbody>	
		
		";
		// output data of each row
		while($row = $result->fetch_assoc()) 
		{
	
$status=$row["status"];		
$fname =$row["fname"];
$lname =$row["lname"];	

$fname =ucwords(strtolower($fname));
$lname =ucwords(strtolower($lname));		
$username = $fname.' '.$lname;

$email=$row["email"];
$gender=$row["gender"];


$token=$row["token"];
$userID= $row["userID"];
$userphoto= $row["photo"];

if(file_exists("../ProfilePictures/".$userphoto."")){
									
									$userphoto= $row["photo"];
									
								}else
								{
									$userphoto = "user.jpg";
								}

			echo "
			
<tr class='even gradeA'>
<td>

" . $userID."

</td>
   
	
<td>
<img class='img'  src=\"../ProfilePictures/".$userphoto."\" width='auto' height='50px'>
</td>

<td> " .$username." <br>


 
</td>


<td>

" . $row["email"]."<br>


"."<a target='_blank' href=\"https://wa.me/".$row["phone"]."\" title='Chat on WhatsApp'>
" . $row["phone"]."
</a>"
."

<br>
 " .$gender."

</td>

<td> " . $row["role"]."</td>	

<td>";

if ($status ==='active') {
     echo "<span class='label label-success' title='Account is Activated'>Active</span>" ;
}
else if($status ==='dormant'){
     echo "<span class='label label-warning' title='Account is dormant'>
    <a href=\"activate.php?email=".$email."&token=".$token."\"  title='activate account'>
     Dormant</a>
     </span>";  
}
else{
     echo "<font color='red'>error!!</font>";  
}

echo"</td>

<td > " . 
"<a href=\"reset_pass.php?userID=".$userID."\">

 <button type='button' class='btn btn-primary btn-xs' title='Reset default Password'>
  <i class='fa fa-fw fa-repeat' aria-hidden='true'  title='Reset default Password'></i>Reset
 </button> 
  
</a>"
."



" . 
"<a href=\"edit_user.php?userID=".$userID."\">

<button type='button' class='btn btn-warning btn-xs' title='edit user'>
  <i class='fa fa-fw fa-edit' aria-hidden='true'  title='edit user'></i>Edit
 </button>

</a>"
."



" . 
"<a href=\"delete_user.php?userId=".$userID."\">

<button type='button' class='btn btn-danger btn-xs' title='Delete user'>
  <i class='fa fa-fw fa-trash' aria-hidden='true'  title='Delete user'></i>Delete
 </button>

</a>"
."



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
		
<div class='alert alert-info alert-dismissible col-lg-10 col-lg-offset-0'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  Sorry!, there is no user to display.
   </div>
      	</center>";
        }
	
	

?>									


                                   
                                    </div>
             	

                        </div>
                    </div>
                </div>
          

<?php       include('foot.php');   ?>