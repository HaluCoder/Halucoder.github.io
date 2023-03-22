<?php
include '../control.php';
$invoice = new HouseRents();


$houseID 	= e($_GET['h']);
$roomID 	= e($_GET['r']);
$bookingID 	= e($_GET['b']);
$userID =e($_GET['u']);
$invoiceID 	= e($_GET['i']);
	
	$invoiceValues = $invoice->getInvoiceData($invoiceID);		
	$bookingValues = $invoice->getBookingDetails($bookingID);
	$userDetails = $invoice->getTenantDetails($userID);
	
	$invoiceDetails = $invoice->getInvoiceDetails($invoiceID);

$taxRate =  $invoiceDetails['tax_rate'];
$percentage_tax = $taxRate * 100;

$total_rent_before_tax = $invoiceDetails['total_rent_before_tax'];
$totalRent = $invoiceDetails['totalRent'];

$WHT = $taxRate * $total_rent_before_tax;


$roomValues = $invoice->getRoomDetails($roomID);
$roomNo =  $roomValues['roomNo'];
$roomDescriptions =  $roomValues['description'];
$roomSize =  $roomValues['size'];
$roomCategory =  $roomValues['category'];



$invoiceDate = date("d-M-Y, H:i:s", strtotime($invoiceDetails['date_added']));
$output = '';
$output .= '


<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
		<td colspan="3" align="center" style="font-size:18px"><b>DAR ES SALAAM INSTITUTE OF TECHNOLOGY (DIT)</b></td>
	</tr>
	<tr>
		<td colspan="3" align="center" style="font-size:18px"><b>DIT RENTALS SOLUTION (DRS)</b></td>
	</tr>
	
	<tr> 
		<td width="45%" align="left" style="font-size:18px"><b>Contacts</b><br>
			Phone: +255 987 654 321 <br>
			E-mail: drs@dit.ac.tz <br>
			Phone: www.drs.co.tz
		</td>
		<td width="10%" align="center">
		<img src="../images/ditlogo.jpg" style=" border-radius: 50%;  position: center; min-width: 50px; box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2); z-index: 2; " alt="image"  width="120px" height="120px">
		</td>
		<td width="45%"  align="right" style="font-size:18px"><b>Address</b><br>
			DIT Main Campus <br>
			Bibi Titi/Morogoro Road <br>
			Dar es Salaam
		
		</td>
	</tr>
</table>

<br>






<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
		<td colspan="2" align="center" style="font-size:18px"><b>Invoice</b></td>
	</tr>
	<tr>
		<td colspan="2">
				<table width="100%" cellpadding="2">
					<tr>
						<td width="65%">
							<b>BILL TO:</b><br />
							Name : '.$userDetails['fname'].' '.$userDetails['lname'].'<br /> 
							Email Address : '.$userDetails['email'].'<br />
							Phone Number: '.$userDetails['phone'].'<br />
						</td>
						<td width="35%">         
							Invoice No. :<small> '.$invoiceDetails['invoiceID'].' </small><br />
							Invoice Date : <small> '.$invoiceDate.'<br /> </small>
						</td>
					</tr>
				</table>
				<br><br><br><br>
				<table width="100%" border="1" cellpadding="5" cellspacing="0">
					<tr> <th colspan="6"> Invoice Details</th></tr>
					<tr>
						<th align="left">Sr No.</th>
						<th align="left">Particulars</th> 
						<th align="left">Rent per month</th>
						<th align="left">Months</th>
						<th align="left">Rooms rent</th>
						<th align="left">Total.</th> 
					</tr>';
				$count = 0;   
				foreach($invoiceValues as $invoiceItem){
					$count++;
					$output .= '
					<tr>
						<td align="left">'.$count.'</td>
						
						<td align="left">
						Room NO. '.$roomNo.', 
						'.$roomDescriptions.' of size 
						'.$roomSize.' sqm for 
						'.$roomCategory.'
						</td>
						<td align="left">'.number_format($invoiceItem["rent"]).'</td>
						<td align="left">'.$invoiceItem["months"].'</td>
						<td align="left">'.$invoiceItem["rooms_rent"].'</td>
						<td align="left">'.number_format($invoiceItem["total_rent_before_tax"]).'</td>   
					</tr>';
				}
				$output .= '
					<tr>
						<td align="right" colspan="5"><b>Sub Total</b></td>
						<td align="left"><b>'.number_format($invoiceDetails['total_rent_before_tax']).'</b></td>
					</tr>
					<tr>
						<td align="right" colspan="5"><b>Tax Rate :</b></td>
						<td align="left">'.number_format($percentage_tax).'%</td>
					</tr>
					<tr>
						<td align="right" colspan="5">Tax Amount: </td>
						<td align="left">'.number_format($WHT).'</td>
					</tr>
					<tr>
						<td align="right" colspan="5"> <b> TOTAL: </b></td>
						<td align="left"><b>'.number_format($invoiceDetails['totalRent']).' </b></td>
					</tr>
					<tr>
						<td align="right" colspan="5">Amount Paid:</td>
						<td align="left">'.$invoiceDetails['paid'].'</td>
					</tr>
					<tr>
						<td align="right" colspan="5"><b>Amount Due:</b></td>
						<td align="left">'.$invoiceDetails['remainder'].'</td>
					</tr>';
				$output .= '
					</table>
			</td>
		</tr>
</table>

<br><br><br><br>


<table width="100%" border="1" cellpadding="5" cellspacing="0">
		
	<tr> 
		<td width="40%" align="center" style="font-size:18px"><b>LandLord Authorization</b> </td>
		<td width="20%" align="center" style="font-size:18px"><b>Official Seal</b> </td>
		
		<td width="40%"  align="center" style="font-size:18px"><b>Tenant Sign</b></td>
	</tr>
		<tr> 
		<td width="40%" align="center" style="font-size:18px">
			<br><br><br><br>_____________<br>LandLord
		</td>
		<td width="20%" align="center">
		<img src="../images/ditlogo.jpg" style=" border-radius: 50%;  position: center;  min-width: 50px; box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2); z-index: 2; " alt="image"  width="120px" height="120px">
		</td>
		<td width="40%"  align="center" style="font-size:18px">
			<br><br><br><br>_____________<br>Tenant 		
		</td>
	</tr>
</table>






';
	
//echo $output ; 

// create pdf of invoice

	
$invoiceFileName = 'Invoice-'.$userDetails['fname'].'-'.$userDetails['lname'].'-'.$invoiceDetails['invoiceID'].'.pdf';
require_once '../dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('A4', 'potrait');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));



?>   
   