<?php
include $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';
require $_SERVER["DOCUMENT_ROOT"] .  '/fpdf/fpdf.php';
// CLASES PDF
require $_SERVER["DOCUMENT_ROOT"] .  '/modulos/app/clases/pdf/pdf_ingreso.php';

$pdf = new PDF("L", "mm", array(120, 17));
//$pdf->AliasNbPages();

$pdf->AddPage('', '', '');

$pdf->SetMargins(0, 1, 0);
$pdf->SetAutoPageBreak(true, 0);

setlocale(LC_TIME, "spanish");

$fecha = date('d-M-Y');

$revision = strftime("%d de %b del %Y", strtotime($fecha . "+ 1 year"));

$pdf->Ln(-5);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(20, 4, "PROXIMA REVISIÓN", 0, 0, 'L');
$pdf->Cell(100, 4, "CDA AUTOMOTOS S.A.S", 0, 0, 'R');

$pdf->Ln(5);



$pdf->Cell(20, 4, strtoupper($revision), 0, 0, 'L');
$pdf->Cell(100, 4, "316 222 3400", 0, 0, 'R');

$pdf->Output('I', 'automotos_stiker_moto_' . $fecha . '.pdf');
