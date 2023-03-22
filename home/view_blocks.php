
<!DOCTYPE html>
<html lang="en">
    <head>


<!-- TITLE -->

<title><?php $accesLevel="home"; $title ="View Blocks"; echo $accesLevel.' | '.$title;?> </title>
<?php   include($accesLevel.'_head.php'); ?>

<div class="wrapper">
<!-- BODY -->


<?php

$FarmRents = new FarmRents();

if(isset($_GET['t'])&& isset($_GET['f'])){
$farmID = $_GET['f'];
$farmToken  =$_GET['t'];

$farmValues = $FarmRents-> getFarmDetails($farmID);
$farmName = $farmValues['farmName'];
$farmNo = $farmValues['farmNo'];

}
else{
	
$farmID =NULL;

$farmValues = $FarmRents-> getFarmData();
foreach($farmValues as $FarmValue){
$farmName = $FarmValue['farmName'];


}


}


?>



<div class="container">
	<div class="row">
		<div class="col-lg-12 col-lg-offset-0">
			<div class=" panel panel-primary">
						<div class="panel-heading">
							Blocks at Farm <b><?php echo $farmName ; ?></b>
						</div>
						<div class="panel-body">
								<?php
	//Retreiving data from blocks table
	$blockValues = $FarmRents-> getBlockFarmData($farmID);
	if (!empty($blockValues)) 
	{ 
			$count=0;
						foreach($blockValues as $blockValue)
						{
		
							
								$blockPicture = $blockValue['blockPicture'];
								$blockID = $blockValue['blockID'];
								$blockName = $blockValue['blockNo'];
								$blockStatus = $blockValue['blockStatus'];
								$blockToken = $blockValue['blockToken'];
								$blockDescription = $blockValue['description'];
								$blockRent = $blockValue['rent'];
								$blockSize = $blockValue['size'];
									
								if(file_exists("../BlockPictures/".$blockValue['blockPicture']."")){
									
									$blockPicture = $blockValue['blockPicture'];
									
								}else
								{
									$blockPicture = "ifmlogo.jpg";
								}
								
								$query = "SELECT * FROM bookings WHERE blockID='$blockID'";
								$bookings = $FarmRents-> numRows($query);		

								$count++;
								
							if($blockStatus <>'taken')
							{
								?>
								
							
								<div class="col-md-4 col-md-offset-0">
										<div class=" panel panel-default product">
														<div class="panel-heading col-md-3 col-md-offset-0 price" align="left">
															<h5 class="price"><b>NO: <?php echo $count; ?></b></h5>

														</div>
														<div class="panel-heading col-md-9 col-md-offset-0" align="right">
															<h5 class="product-header"><b><?php echo $blockName; ?></b></h5>
														</div>
												
											
											<div class="panel-body">
														<table class="table-striped table-hover" id="dataTables-example" max-width="400">
																	<tr>
																		
																			<td colspan="2">
																			<img class="product-image" src="<?php echo "../blockPictures/".$blockPicture;?>" width="300px" height="200px">
																			</td>
																	</tr>
																	
																	
																	<tr>
																			
																	</tr>
																	<tr>
																		<td>
																				<div >Rent: Tshs.<span class="price"> <b><?php echo number_format($blockRent); ?></b></span> </div>
																		</td>
																		<td>
																				<div>Size: <b><i><?php echo $blockSize; ?> Accres</i></b></div>
																		</td>
																				
																	
																	</tr>
																	<tr>
																		<td>
																			<div>Status: 
																			<?php
																																										
																						if ($bookings <1 && $blockStatus ==='vacant') {
																							 echo "<span class='label label-success' title='block is vacant'>vacant</span>" ;
																						}

																						else if($bookings <1 && $blockStatus ==='booked'){
																						   echo "<span class='label label-success' title='block is vacant'>vacant</span>" ;  
																						}

																						else if($bookings <1 && $blockStatus ==='taken'){
																						   echo "<span class='label label-success' title='block is vacant'>vacant</span>" ;  
																						}


																						else if($bookings >0 && $blockStatus ==='booked'){
																							 echo "<span class='label label-warning' title='block is booked by $bookings peoples now'>booked</span>";  
																						}

																						else if($bookings >0 && $blockStatus ==='taken'){
																							 echo "<span class='label label-danger' title='block is taken'>taken</span>";  
																						}

																						else{
																							 echo "<span class='label label-danger' title='block is taken'>NIL</span>";  
																						}


																				?>
																			</div>
																		
																		</td>
																		<td>
																			<div >bookings: 
																			<?php	
																						if ($bookings ==1) {
																							 echo "<span class='label label-warning' title='There is no competition'>".$bookings." bookings </span>" ;
																						}
																						else if (($bookings >1) && ($bookings <=2)) {
																							 echo "<span class='label label-danger' title='competition is Normal'>".$bookings." bookings</span>";  
																						}

																						else if ($bookings >2) {
																							 echo "<span class='label label-danger' title='Competition is High'>".$bookings." bookings</span>";  
																						}
																						else{
																							echo "<span class='label label-danger' title='There is NO booking yet'>".$bookings." bookings</span>";
																							
																						}
																			?>
																			</div>
																		</td>
																	</tr>
																	<tr>
																		<td colspan="2" align="center">
																				<a class="btn btn-primary btn-lg btn-block" href="book_block.php?_f=<?php echo $farmToken; ?>&_b=<?php echo $blockToken; ?> " >
																				  BOOK NOW
																				</a>
																		</td>
																	</tr>
														</table>
														
												<div class="clearfix">
												</div>			
											</div>
										</div>
								</div>
				
									<?php
							}
						}
	}
	else{  
								
								echo "<center>	
											<div class='alert alert-danger alert-dismissible col-lg-12 col-lg-offset-0'>
											  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
											 Sorry!. There is no block available now for rent. Please visit here again after some minutes.
											   </div>
									</center>";
							
		}
								?>
			
						</div>	
			</div>	
		</div>
	</div>
</div>









<!-- FOOTER -->
<?php include('home_footer.php'); ?>