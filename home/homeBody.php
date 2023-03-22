
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-lg-offset-0">
			<div class=" panel panel-primary">
				<div class="panel-heading">
					Farms for Rent
				</div>
				<div class="panel-body">
					<?php
					$FarmRents = new FarmRents();
					
					$FarmValues = $FarmRents-> getFarmData();
					
					if ($FarmValues)
					{ 
							$count=0;
						foreach($FarmValues as $farmValue)
						{
								$count++;
								$farmID = $farmValue['farmID'];
								$farmName = $farmValue['farmName'];
								$ownerID = $farmValue['ownerID'];
								$farmStatus = $farmValue['status'];
								$farmToken = $farmValue['farmToken'];
								
								if(file_exists("../FarmPictures/".$farmValue['farmPicture']."")){
									
									$farmPicture = $farmValue['farmPicture'];
									
								}else
								{
									$farmPicture = "ifmlogo.jpg";
								}
								
								//Retreiving data from Rooms table
								$BlockValues = $FarmRents-> getBlockFarmDetails($farmID);
								if (!empty($BlockValues)) { 
								$blockID = $BlockValues['blockID'];
								$blockNo = $BlockValues['blockNo'];
								$blockPicture = $BlockValues['blockPicture'];
								$blockDescription = $BlockValues['description'];
								$blockRent = $BlockValues['rent'];
								$blockStatus = $BlockValues['blockStatus'];
								$blockToken = $BlockValues['blockToken'];
								}
							
								$queryBlocks = "select * from blocks where farmID='$farmID'";
								$totalBlocks = $FarmRents-> numRows($queryBlocks);
									if ($totalBlocks>0) 
									{
											$MaxRentValue = $FarmRents-> getMaxRent($farmID);
											$MaxRent = $MaxRentValue['MAX(rent)'];
											
											
											$MinRentValue = $FarmRents-> getMinRent($farmID);
											$MinRent = $MinRentValue['MIN(rent)'];
									}
									else{
										$MaxRent=NULL;
										$MinRent=NULL;
												
									}
									
								$ownerValue = $FarmRents-> getUserData($ownerID);
								$ownerPhone = $ownerValue['phone'];
								$ownerEmail = $ownerValue['email'];
								$ownerFname = $ownerValue['fname'];
								$ownerLname = $ownerValue['lname'];
								
								$ownerNames = ucwords($ownerFname.' '.$ownerLname);
								
							if($farmStatus <>'full')
							{?>
								<div class="col-md-4 col-md-offset-0">
									<div class=" panel panel-default product">
										<div class="panel-heading">
											<div class="row">
												<div class="col-xs-3 col-xs-offset-0 text-left ">
													<h5 class="price left"><b>NO: <?php echo $count; ?></b></h5>
												</div>
												<div class="col-xs-9 col-xs-offset-0 text-right ">
													<h5 class="product-header"><b><?php echo $farmName; ?></b></h5>
												</div>
											</div>
										</div>	
										<div class="panel-body">
											<table class="table-striped table-hover" id="dataTables-example" max-width="400">
												<tr>
													<td colspan="2">
														<img class="product-image" src="<?php echo "../FarmPictures/".$farmPicture;?>" width="300px" height="200px">
													</td>
												</tr>
												<tr>
													<td>
														<div >Min Rent:<span class="price"> <b><?php echo number_format($MinRent); ?></b>/=</span> </div>
													</td>
													<td>
														<div>Max Rent:<span class="price"><b><?php echo number_format($MaxRent); ?></b>/= </span></div>
													</td>
												</tr>
												<tr>
													<td>
														<div>Phone: <b><?php echo $ownerPhone; ?></b></div>
													</td>
													<td>
														<div >Rooms: <b><?php echo $totalBlocks ; ?></b>
														
															<?php
															if ($farmStatus ==='renting') {
																 echo "<span class='label label-success' title='Farm is ready to Rent'>Renting</span>" ;
															}
															else if($farmStatus ==='full'){
																 echo "<span class='label label-warning' title='Farm is Full'>Full</span>";  
															}

															else{
																 echo "<font color='red'>error!!</font>";  
															}

															?>
														</div>
													</td>
												</tr>
												<tr>
													<td colspan="2" align="center">
														<a class="btn btn-primary btn-lg btn-block" href="view_blocks.php?t=<?php echo $farmToken; ?>&f=<?php echo $farmID; ?>" >
															 Find Out More!
														</a>
													</td>
												</tr>
											</table>
											<div class="clearfix"></div>			
										</div>
									</div>
								</div>
							<?php
							}
							else{?>
					<div class="alert alert-danger alert-dismissible col-lg-12 col-lg-offset-0" align="center">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						Sorry!. There is no Farm  available for rent. Please visit here again after some minutes.
					</div>
								<?php
								} 
						}
					}
					else{?> 
					<div class="alert alert-danger alert-dismissible col-lg-12 col-lg-offset-0" align="center">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						Sorry!. There is no Farm  available for rent. Please visit here again after some minutes.
					</div>
							<?php
						}?>
				</div>	
			</div>	
		</div>
	</div>
</div>

