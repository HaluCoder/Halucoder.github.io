<?php
include '../control.php';
$invoice = new FarmRents();

$payID 	= e($_GET['p']);
$farmID 	= e($_GET['h']);
$blockID 	= e($_GET['r']);
$bookingID 	= e($_GET['b']);
$userID =e($_GET['u']);
$invoiceID 	= e($_GET['i']);


$paymentDetails = $invoice->getPayments($payID);
if($paymentDetails){
	$AmountPaid =  $paymentDetails['paid'];
	$paymentReceipt =  $paymentDetails['receipt'];
	$pay_status =  $paymentDetails['pay_status'];
	$approved_by =  $paymentDetails['approved_by'];
	$payDate =  $paymentDetails['date_added'];

	if($pay_status <>'received')
	{
	$paymentValues = $invoice->getPaymentData($payID);
	}else{
		$paymentValues = $invoice->getPaymentInvoiceData($invoiceID);
	}
}

$farmValues = $invoice->getFarmDetails($farmID);
$farmName =  $farmValues['farmName'];
$ownerID =  $farmValues['ownerID'];

$ownerValue = $invoice-> getUserData($ownerID);
	$ownerPhone = $ownerValue['phone'];
	$ownerEmail = $ownerValue['email'];
	$ownerFname = $ownerValue['fname'];
	$ownerLname = $ownerValue['lname'];
	$ownerNames = ucwords($ownerFname.' '.$ownerLname);


$tenantValues = $invoice->getTenantDetails($userID);
$tenantFname =  strtoupper($tenantValues['fname']);
$tenantLname =  strtoupper($tenantValues['lname']);
$tenantNames = $tenantFname.' '.$tenantLname;

$tenantPhone =  $tenantValues['phone'];
$tenantEmail =  $tenantValues['email'];

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



<br><br><br>
<table width="100%" border="1" cellpadding="5" cellspacing="0" id="customers">
	<tr>
		<th colspan="2" align="center" style="font-size:18px"><b>RECEIPT</b></th>
	</tr>
	<tr>
		<td colspan="2" style="font-size:14px">
			<table width="100%" cellpadding="5" style="font-size:14px" id="customers">
				<tr>
					<td width="65%">
						<b>RECEIPT FOR:</b><br />
						Names : '.$tenantNames.'<br> 
						E-mail: '.$tenantEmail.'<br>
						Phone: '.$tenantPhone.'
					</td>
					<td width="35%">         
						Receipt No:'.$payID.'<br>
						Receipt Date:'.$payDate.' <br>
						
						Approval Status:'; if($pay_status<>'received'){ $output .= ' <font color="red">'.$pay_status.'</font>';}else{$output .= ' <font color="green">'.$pay_status.'</font>';}
					$output .= '
					</td>
				</tr>
			</table>
			
			
			<br><br> <br><br>
			<table width="100%" border="1" cellpadding="5" cellspacing="0" id="customers">
				<tr>
					<th width="5%" align="center">S/N</th>
					<th width="80%" align="left">Payment Descriptions</th>
					<th width="15%" align="right">Total (Tshs.)</th> 
				</tr>';
					$count = 0;   
					foreach($paymentValues as $paymentValue){
			
						$paid = $paymentValue["paid"];
						$TotalPaid[$count]= $paid;
						$sumPaid = array_sum($TotalPaid);
						$pay_status = $paymentValue["pay_status"];

						$blockID = 	$paymentValue["blockID"];
						$blockValues = $invoice->getBlockDetails($blockID);
						$blockNo =  $blockValues['blockNo'];
						$blockDescriptions =  $blockValues['description'];
						$blockSize =  $blockValues['size'];
						$blockCategory =  $blockValues['category'];

						$invoiceID = 	$paymentValue["invoiceID"];
						$invoiceDetails = $invoice->getInvoiceDetails($invoiceID);
						$taxRate =  $invoiceDetails['tax_rate'];
						$percentage_tax = $taxRate * 100;
						$total_rent_before_tax = $invoiceDetails['total_rent_before_tax'];
						$totalRent = $invoiceDetails['totalRent'];
						$WHT = $taxRate * $total_rent_before_tax;
						$accres = $invoiceDetails['accres'];
						$invoiceDate = date("d-M-Y, H:i:s", strtotime($invoiceDetails['date_added']));
						
						$dueAmount = $totalRent - $sumPaid;
						
						$count++;
						$output .= '
				<tr>
					<td align="center">'.$count.'</td>
					
					<td align="left">
						PayID: <b>'.$paymentValue["payID"].'</b>, Payment for Farm-Block: <b>'.$blockNo.' </b>, 
						'.$blockDescriptions.',
						size : <b>'.$blockSize.' Accres</b>.
					</td>
					
					<td align="right">'.number_format($paymentValue["paid"]).'</td>
					
				</tr>';
					}
					
					
					$output .= '
				<tr>
					<td align="right" colspan="2"> <b> Total Paid: </b></td>
					<td align="right"><font color="green">'.number_format($sumPaid).'</font></td>
				</tr>
				<tr>
					<td align="right" colspan="2"><b> Total Bill: </b></td>
					<td align="right"><b>'.number_format($totalRent).'</b></td>
				</tr>
				<tr>
					<td align="right" colspan="2"><b>Amount Due:</b></td>
					<td align="right"><font color="red">'.number_format($dueAmount).'</font></td>
				</tr>';
				
				
					$output .= '
			</table>
				
				
				
			<br><br><br><br><br><br><br><br><br><br>
			<table width="100%" border="1" cellpadding="5" cellspacing="0" id="customers">
				<tr>
					<td width="50%" align="left"> 
						<br><br>
						
						<img src="../images/signature.jpeg" style="width:120px; height:40px; position: left;">
						<br>
						<b> '.$ownerNames.'</b>  <br>
						<i> LandLord.</i> <br>
						<i>'.date("d-m-Y").'</i> 
						
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
';

?>