
<?php
include('../control.php');	
?>
<?php

$houseID 	= e($_GET['h']);
$roomID 	= e($_GET['r']);
$bookingID 	= e($_GET['b']);
$tenanUserID =e($_GET['u']);
$invoiceID 	= e($_GET['i']);


$HouseRents = new HouseRents();


//Retreiving data from invoice_items table
$invoiceValues = $HouseRents-> getInvoiceDetails($invoiceID);
$rent =	$invoiceValues['rent'];
$rooms_rent =	$invoiceValues['rooms_rent'];
$months =	$invoiceValues['months'];
$totalRent =	$invoiceValues['totalRent'];
$status =	$invoiceValues['status'];



//Retreiving data from Bookings table
$bookingValues = $HouseRents-> getBookingDetails($bookingID);
$startDate =	$bookingValues['startDate'];
$endDate =	$bookingValues['endDate'];
$startDate = date("d-M-Y", strtotime($startDate));
$endDate = date("d-M-Y", strtotime($endDate));

$date_added =	$bookingValues['date_added'];
$date_added = date("d-M-Y", strtotime($date_added));


//Retreiving data from users table where role is tenant
$TenantValues = $HouseRents-> getTenantDetails($tenanUserID);
$tenantNames = ucwords($TenantValues['fname'].' '.$TenantValues['lname']);
$tenantPhone =	$TenantValues['phone'];
$tenantEmail =	$TenantValues['email'];


//Retreiving data from Houses table
$HouseValues = $HouseRents-> getHouseDetails($houseID);
$houseName = $HouseValues['houseName'];
$houseOwner = $HouseValues['houseOwner'];
$houseNo = $HouseValues['houseNo'];
$ownerPhone = $HouseValues['phone'];
$housePicture = $HouseValues['housePicture'];

//Retreiving data from Rooms table
$RoomValues = $HouseRents-> getRoomDetails($roomID);
$roomNo = $RoomValues['roomNo'];
$roomPicture = $RoomValues['roomPicture'];
$roomDescription = $RoomValues['description'];

$output = '';

$output .= '



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>DRS |Preview Invoice</title>

        <!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../css/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

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
		
   </head>
    <body>

    <div class="container">
                    
                <div class=" panel panel-primary">
					<div class="panel-body">
						<div class="container   col-md-12 col-md-offset-0">
								<div class="row">
									<div class="col-md-12 col-md-offset-0">
										<div class=" panel ">
												
											<div class=" panel ">
												<div class="panel-body">
														
														<div class="row">
															<h3 align="center"> DIT RENTAL SERVICES </h3>
																<table width="100%" align="center" id="customers" border="0">
																		<tr class="success" >
																				<th width="45%"  >
																						<p class="success"> Address: <br>
																							Houses Letting & Hostels Renting<br>
																							Selling Houses & Appartments <br>
																							House Rentals Guidance <br>
																							Appartment Bookings<br>
																						</p>
																				</th>
																					

																				<td width="10%" bgcolor="white">
																						
																						<img  class="success" src="../images/ditlogo.jpg" width="100px" height="100px">

																				</td>
																					
																				<th width="45%">
																				<p class="success">Contacts:<br>
																							Phone: <b>+255 678 308 &nbsp; 842</b><br>
																							E-mail: <b>ditrentals@gmail.com</b><br>
																							Web: <b>https://drs.co.tz/</b> <br>
																							Web: <b>https://drs.co.tz/</b>
																				</p>		

																				</th>
																		</tr>
																</table>

														</div>
												</div>
											</div>
											<div class=" panel ">
												<div class="panel-body">
															<div class="col-md-12 col-md-offset-0">
																	<div class="row">
																			<table width="100%">
																				<tr>
																					<td width="30%" align="left"><h5>Application ID: <b>'.$houseID.'</h5></b></td>
																					<td width="35%" align="center"><font color="red"><h4 align="center">INVOICE</h4></font></td>
																					<td width="30%" align="right"><h5>Applied on: '.$date_added.'</h5></td>
																					
																				</tr>
																			</table>
																	</div>
															</div>
												</div>
											</div>
											
											<br><br><br>
											
											<div class=" panel">
											
												<div class="panel-body">
														<div class="col-md-12 col-md-offset-0">
																<p><b>BILL TO:</b><br>
																	Name: <b>'.$tenantNames.'</b> <br>
																	E-mail: <b>'.$tenantEmail.'</b><br>
																	Phone: <b>'.$tenantPhone.'</b>
																</p>
														
															
															<br><br>
															
															<div class="row">
																<table width="100%" align="center"  border="1">

																		<tr>
																			<th align="left"  width="5%" > S/N</th>
																			<th align="left"   width="50%"> Room Details</th>
																			<th align="left"   width="10%"> Rooms</th>
																			<th align="left"   width="10%"> Rent/Month</th>
																			<th align="left"   width="10%"> Months</th>
																			<th align="center"  width="10%">Total Rent</th>
																		</tr>
																		';
																		$count = 0; 

																		$myInvoices = $HouseRents-> getMyInvoices($invoiceID,$tenanUserID,);
																			
																				foreach($myInvoices as $myInvoice)
																				{
																		$total_rent_before_tax = $myInvoice["totalRent"];
																		$tax= 0.1; //10%
																		$WHT = $tax *  $total_rent_before_tax;

																		$total = array_sum(array($total_rent_before_tax,$WHT));
																		$total = number_format($total,2);


																					$count++;
																					
																					$output .= '
																					<tr>
																						<td align="center">'.$count.'</td>
																						<td align="left">'.$RoomValues["description"].', '.number_format($RoomValues["size"]).' 
																						sqm for '.$RoomValues["category"].' purposes, Located in '.$HouseValues['location'].'</td>
																						<td align="center">'.$myInvoice["rooms_rent"].'</td>
																						<td align="center">'.number_format($myInvoice["rent"],2).'</td>
																						<td align="center">'.$myInvoice["months"].'</td>
																						<td align="center"><b>'.number_format($myInvoice["totalRent"],2).' </b></td>
																					
																					</tr>
																					<tr>
																						<td colspan="6" bgcolor="#f2f2f2">
																						
																						</td>
																					</tr>
																					';
																					
																				}
																		$output .= '
																		<tr>
																		<td align="right" colspan="5"> <b>+ WHT (10%) </b></td>
																		<td align="center"> <b> '.number_format($WHT,2).' </b></td>
																		</tr>

																		<tr>
																		<td align="right" colspan="5"> <b>TOTAL</b></td>
																		<td align="center"> <b> '.$total.' </b></td>
																		</tr>
																</table>
															</div>
														</div>
												</div>
											</div>	';
											
											$output .= ' 
											
											
											<br><br><br>
											<div class=" panel">
												<div class="panel-body">
														<table align="center" width="100%"  border="1" id="customers">
																		<tr>
																			<th align="center" colspan=""> Authorized By </th>
																			<th align="center" colspan=""> Customer signature</th>
																		</tr>
																		<tr>
																				<td>
																						<table>
																								<tr> 
																										<td bgcolor="white" width="20%" align="center">
																											<br><br>____________________<br>				
																												<b>'.strtoupper($houseOwner).'</b><br>
																											<i>House Owner</i>
																										</td>
																										
																										<td width="20%"  bgcolor="white" align="center">
																											<br><br>
																											<u><b>'.date("d-m-Y").' </b></u><br>
																											<i>DATE</i>
																										</td>
																									
																								</tr>
																						</table>
																					
																				</td>

																				<td>
																						<table>
																								<tr> 
																										<td  width="20%" bgcolor="white" align="center">
																											<br><br>____________________<br>
																											<b> '.strtoupper($tenantNames).' </b><br>
																											<i>Tenant</i>
																										</td>
																										
																										<td width="20%" bgcolor="white" align="center">
																											 <br><br>____________<br>
																											<i> DATE</i>
																										</td>
																								</tr>
																						</table>
																				</td>
																		</tr>
														</table>
												
												</div>
											</div>
										</div>
									</div>	
								</div>
						</div>
                    </div>
                </div>
      
    </div>

        <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>

    </body>
</html>

';
echo $output;

?>