<?php
include $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';
require $_SERVER["DOCUMENT_ROOT"] .  '/fpdf/fpdf.php';

// CLASES PDF
require $_SERVER["DOCUMENT_ROOT"] .  '/modulos/app/clases/pdf/pdf_ingreso.php';


$pdf = new PDF("L", "mm", array(74, 58));
$pdf->AliasNbPages();

$pdf->AddPage('', '', '', array(20, 250, '', 45));
$pdf->SetMargins(7,0,0);
$pdf->SetAutoPageBreak(true,1);


setlocale(LC_TIME,"spanish");

$fecha_diaria = date('d-m-Y');


$fecha_revision = strftime("%d de %B del %Y",strtotime($fecha_diaria."+ 1 year"));

$pdf->Ln(-5);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(60, 4, "CDA AUTOMOTOS S.A.S", 0, 0, 'C');
$pdf->Ln(5);
$pdf->Cell(60, 4, "CRA 85 # 7D - 30", 0, 0, 'C');
$pdf->Ln(5);
$pdf->Cell(60, 4, "316 222 3400 - 424 4609", 0, 0, 'C');


$pdf->Ln(2);
$pdf->Cell(60, 4, "_____________________________", 0, 0, 'C');

$pdf->Ln(8);
$pdf->Cell(60, 4, "PROXIMA REVISIÓN TÉCNICO", 0, 0, 'C');
$pdf->Ln(5);
$pdf->Cell(60, 4, "MECÁNICA Y EC", 0, 0, 'C');

$pdf->Ln(6);
$pdf->Cell(60, 4, strtoupper($fecha_revision), 0, 0, 'C');

$pdf->Ln(2);
$pdf->Cell(60, 4, "_____________________________", 0, 0, 'C');

$pdf->Ln(5);
$pdf->Cell(60, 4, "¡GRACIAS POR PREFERIRNOS!", 0, 0, 'C');
$pdf->Ln(4);
$pdf->Cell(60, 4, "WWW.CDAAUTOMOTOS.COM", 0, 0, 'C');


$pdf->Output('I','automotos_stiker_liviano_'.$fecha_diaria.'.pdf');

?>