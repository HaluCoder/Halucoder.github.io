<?php
include 'individual_invoice_content.php';

// create pdf of invoice

	
$invoiceFileName = 'All Invoices for -'.$tenantNames.'-'.$farmName.'-'.$invoiceID.'  .pdf';
require_once '../dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('A4', 'potrait');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));



?>   
   