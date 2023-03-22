<?php
include '../control.php';
$invoice = new FarmRents();


$farmID 	= e($_GET['h']);
$blockID 	= e($_GET['r']);
$bookingID 	= e($_GET['b']);
$userID =e($_GET['u']);
$invoiceID 	= e($_GET['i']);
	
$invoiceValues = $invoice->getInvoiceData($userID);	
	
$farmValues = $invoice->getFarmDetails($farmID);
$farmName =  $farmValues['farmName'];
$ownerID =  $farmValues['ownerID'];



$tenantValues = $invoice->getTenantDetails($userID);
$tenantFname =  strtoupper($tenantValues['fname']);
$tenantLname =  strtoupper($tenantValues['lname']);
$tenantNames = $tenantFname.' '.$tenantLname;

$tenantPhone =  $tenantValues['phone'];
$tenantEmail =  $tenantValues['email'];


$invoiceDetails = $invoice->getInvoiceDetails($invoiceID);
$taxRate =  $invoiceDetails['tax_rate'];
$percentage_tax = $taxRate * 100;
$total_rent_before_tax = $invoiceDetails['total_rent_before_tax'];
$totalRent = $invoiceDetails['totalRent'];

$ownerValue = $invoice-> getUserData($ownerID);
	$ownerPhone = $ownerValue['phone'];
	$ownerEmail = $ownerValue['email'];
	$ownerFname = $ownerValue['fname'];
	$ownerLname = $ownerValue['lname'];
	$ownerNames = ucwords($ownerFname.' '.$ownerLname);

$invoiceDate = date("d-M-Y, H:i:s", strtotime($invoiceDetails['date_added']));

$output = '';
$output .= '

<style>

#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td {
  border: 1px solid #ddd;
  padding: 2px;
  
}

#customers th {
  border: 1px solid #ddd;
  padding: 2px;
}


#customers th {
  padding-top: 0px;
  padding-bottom: 0px;
  background-color: #0D7DC8;
  color: white;
}
</style>

<table width="100%" border="1" cellpadding="5" cellspacing="0" id="customers">
	<tr>
		<th colspan="3" align="center" style="font-size:18px"><b>FARM MANAGEMENT SYSTEM (FMS)</b></th>
	</tr>
	
	<tr> 
		<td width="45%" align="justify" style="font-size:14px"><b>Contacts</b><br>
			Phone: +255 123456789 <br>
			E-mail: fms@ifm.ac.tz <br>
			Website: www.fms.co.tz
		</td>
		<td width="10%" align="center">
		<img src="../images/ifmlogo.jpg" style=" border-radius: 50%;  position: center; min-width: 50px; box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2); z-index: 2; " alt="image"  width="120px" height="120px">
		</td>
		<td width="45%"  align="right" style="font-size:14px"><b>Address</b><br>
			IFM Main Campus <br>
			Magogoni Street<br>
			Dar es Salaam
		
		</td>
	</tr>
</table>

<br>






<table width="100%" border="1" cellpadding="5" cellspacing="0" id="customers">
	<tr>
		<th colspan="2" align="center" style="font-size:18px"><b>INVOICE</b></th>
	</tr>
	<tr>
		<td colspan="2" style="font-size:14px">
				
				
				<table width="100%" border="0" cellpadding="5" style="font-size:14px" id="customers">
					<tr>
						<td width="65%">
							<b>BILL TO:</b><br />
							Names : '.$tenantNames.'<br> 
							E-mail: '.$tenantEmail.'<br>
							Phone: '.$tenantPhone.'
						</td>
						<td width="35%">         
							Invoice No:'.$invoiceID.'<br>
							Invoice Date:'.$invoiceDate.'
						</td>
					</tr>
				</table>
				
				
				
				
				<br><br> 
				<table width="100%" border="1" cellpadding="5" cellspacing="0" id="customers">
					<tr>
						<th width="5%" align="left">S/N</th>
						<th width="60%" align="left">Particulars</th> 
						<th width="10%" align="center">Rent</th>
						<th width="10%" align="center">Accres</th>
						<th width="15%" align="right">Total (Tshs.)</th> 
					</tr>';
				$count = 0;   
				foreach($invoiceValues as $invoiceItem){
		$total_rent_before_tax = $invoiceItem["total_rent_before_tax"];
		$totalRent = $invoiceItem["totalRent"];
		$tax_rate = $invoiceItem["tax_rate"];
		$paid = $invoiceItem["paid"];
		
		
		$Total_rent_before_tax[$count]= $total_rent_before_tax;
		$TotalRent[$count]= $totalRent;
		$TotalPaid[$count]= $paid;
		
		$sumTotal_rent_before_tax = array_sum($Total_rent_before_tax);
		$sumTotalRent = array_sum($TotalRent);
		$sumPaid = array_sum($TotalPaid);
		
		$WHT = $tax_rate * $sumTotal_rent_before_tax;
		

$blockID = 	$invoiceItem["blockID"];


$blockValues = $invoice->getBlockDetails($blockID);
$blockNo =  $blockValues['blockNo'];
$blockDescriptions =  $blockValues['description'];
$blockSize =  $blockValues['size'];
$blockCategory =  $blockValues['category'];
		
					$count++;
					$output .= '
					<tr>
						<td align="center">'.$count.'</td>
						
						<td align="left">
						Farm-Block: <b>'.$blockNo.' </b>, 
						'.$blockDescriptions.',
						size : <b>'.$blockSize.' Accres</b>.
						</td>
						<td align="center">'.number_format($invoiceItem["rent"]).'</td>
						<td align="center">'.$invoiceItem["accres"].'</td>
						<td align="right">'.number_format($invoiceItem["total_rent_before_tax"]).'</td>   
					</tr>';
				}
				$output .= '
					<tr>
						<td align="right" colspan="4"><b>Sub Total</b></td>
						
						<td align="right"><b>'.number_format($sumTotal_rent_before_tax).'</b></td>
					</tr>
					<tr>
						<td align="right" colspan="4"><b>Tax Rate(WHT) :</b></td>
						<td align="right">'.number_format($percentage_tax).'%</td>
					</tr>
					<tr>
						<td align="right" colspan="4">+Tax Amount: </td>
						<td align="right">'.number_format($WHT).'</td>
					</tr>
					<tr>
						<td align="right" colspan="4"> <b> TOTAL: </b></td>
						<td align="right"><b>'.number_format($sumTotalRent).' </b></td>
					</tr>
					<tr>
						<td align="right" colspan="4">Amount Paid:</td>
						<td align="right"> <font color="green">'.number_format($invoiceDetails['paid']).'  </font> </td>
					</tr>
					<tr>
						<td align="right" colspan="4"><b>Amount Due:</b></td>
						<td align="right"><font color="red">  '.number_format($sumTotalRent - $sumPaid).' </font></td>
					</tr>';
				$output .= '
				</table>

<br>
<table width="100%" cellpadding="5" border="1" cellspacing="0" id="customers">
						<tr>
							<th align="center" style="font-size:14px">Pay through Bank</th> 
							<th align="center" style="font-size:14px">Pay through Phone</th> 
						</tr>
						<tr>
							<td width="50%" align="left" style="font-size:12px" >
								Account Name: '.$ownerNames.'<br> 
								Account No: 123456789 <br>
								Bank Name: CRDB
							</td>
							<td width="50%" align="left" style="font-size:12px">         
								Phone : '.$ownerPhone.'<br>
								Names : '.$ownerNames.'
							</td>
						</tr>
</table>
<br><br><br>

<table width="100%" border="1" cellpadding="5" cellspacing="0" id="customers">
		
	<tr> 
		<th width="50%" align="center" style="font-size:14px"><b>Farm Owner Sign and Date</b> </th>
		<th width="50%"  align="center" style="font-size:14px"><b>Tenant Sign and Date</b></th>
	</tr>
	<tr> 
			<td width="50%" align="center" style="font-size:12px">
				<table width="100%" border="0" cellpadding="5" cellspacing="0">
					<tr>
						<td width="50%" align="center"> <br><br>
						<u><img src="../images/signature.jpeg" style="width:120px; height:40px; position: left;"> </u>
						<br>
						<b>'.$ownerNames.'</b> <br> <i>Farm Owner</i>  </td>
						<td width="50%" align="center"> <br><br><br><br> <u>'.date("d-m-Y").'</u><br>(dd-mm-yyyy)<br> <i>Date</i> </td>
					</tr>
				</table>
			</td>
			<td width="50%"  align="center" style="font-size:12px">
				<table width="100%" border="0" cellpadding="5" cellspacing="0">
					<tr>
						<td width="50%" align="center"> <br><br><br><br>_____________<br><b> '.$tenantNames.'</b> <br> <i>Tenant</i>  </td>
						<td width="50%" align="center"> <br><br><br><br>_____________<br>(dd-mm-yyyy)<br> <i>Date</i> </td>
					</tr>
				</table>
			</td>
	</tr>
</table>


			</td>
		</tr>
</table>


';

?>