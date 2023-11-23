<?php
include $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';
require $_SERVER["DOCUMENT_ROOT"] .  '/fpdf/fpdf.php';

require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_database.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/php/call_resources.php';




// CLASES PDF
require $_SERVER["DOCUMENT_ROOT"] .  '/modulos/app/clases/pdf/pdf_terminos.php';




$ID = 0;

if (!isset($_GET['id']) || strlen($_GET['id']) <= 0) {

    $php_status_pdf = 1;

} else {
    $php_status_pdf = 2;
    $ID = encrypt($_GET['id'], 2);
    

}



$database = new databaseConnection();

if ($php_status_pdf == 1) {

    $pdf = new PDF("P", "mm", array(215.9, 330.2));
    $pdf->AliasNbPages();

    $pdf->AddPage();
    $pdf->Ln(30);
    $pdf->SetFont('Arial', 'B', 100);
    $pdf->Cell(195, 20, "FALTA", 0, 1, 'C');

    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 100);
    $pdf->Cell(195, 20, "ID", 0, 1, 'C');
} else if ($php_status_pdf == 2) {


$pdf = new PDF("P", "mm", array(215.9, 330.2));
$pdf->AliasNbPages();

include_once '../../pdfs/consulta/consulta.php'; 



    include_once  '../../pdfs/condiciones_servicio/terminos_condiciones.php';

}



$pdf->Output('I','automotos_pdf_terminos_condiciones_'.$fecha.'_'.$placa.'.pdf');

?>









