<?php
/*
if($vez == 1){

    $vez = " - 1";
}
else{
    $vez = " - 2";
}
*/

$fecha;
$fecha = str_replace("/", "-", $fecha); 

$fecha_revision = strftime("DIA:%d MES:%m AÑO:%Y %I:%M %p", strtotime($fecha));

// var_dump($fecha_revision);

$pdf-> SetLineWidth(0.3);
$pdf->AddPage('', '', '', array(10, 100, '', 45,));

$pdf->SetMargins(1,0,0);
$pdf->SetAutoPageBreak(true,0);


$pdf->Image($_SERVER["DOCUMENT_ROOT"] . '/images/super_vigilado.jpg',1,1,30,15);

if($tipo_vehiculo == 'MOTO'){

    $pdf->Image($_SERVER["DOCUMENT_ROOT"] . '/images/moto_ingreso.png',85,5,16,60);
}
else{
    $pdf->Image($_SERVER["DOCUMENT_ROOT"] . '/images/liviano_ingreso.png',85,5,16,60);
}



$pdf->Ln(10);
$pdf->SetFont('', 'B', 16);
$pdf->Cell(70, 5, "CDA AUTOMOTOS S.A.S", 'B', 1, 'L');
$pdf->Ln(0);
$pdf->SetFont('Courier', '', 12);
$pdf->Cell(70, 5, "km: ".$kilometraje, 'B', 0, 'L');
$pdf->Ln();
$pdf->SetFont('Courier', 'B', 12);
$pdf->Cell(60, 5, " ", 0, 0, 'L');
$pdf->Ln();
$pdf->SetFont('Times', 'B', 27);
$pdf->Cell(40, 2, $placa." ".$vez , 0, 0, 'L');
$pdf->SetFont('Courier', '', 13);
$pdf->Cell(20, 5, "    ".$servicio, 0, 0, 'L');


$pdf->Ln(6);
$pdf->SetFont('Courier', 'B', 12);
$pdf->Cell(80, 5, $fecha_revision, 'B', 1, 'L');
$pdf->Ln(2);
$pdf->SetFont('Courier', '', 10);
$pdf->Cell(20, 5, "NÚMERO DE CELULAR CON WHATSAPP", 0, 0, 'L');
$pdf->Ln();
$pdf->SetFont('Times', '', 20);
$pdf->Cell(20, 5, $telefono_conductor, 0, 0, 'L');
$pdf->Ln();
$pdf->SetFont('Courier', '', 10);
$pdf->Cell(20, 5, "DIRECCIÓN", 0, 0, 'L');
$pdf->Ln();
$pdf->SetFont('Times', '', 20);
$pdf->Cell(20, 5, $direccion_conductor, 0, 0, 'L');
$pdf->Ln();
$pdf->SetFont('Courier', '', 10);
$pdf->Cell(20, 5, "CORREO ELECTRÓNICO", 0, 0, 'L');
$pdf->Ln();
$pdf->SetFont('Times', '', 20);
$pdf->Cell(98, 7, $correo_conductor, 'B', 0, 'L');

$pdf->Ln(13);
$pdf->SetFont('', 'B', 16);
$pdf->Cell(60, 5, "WWW.CDAAUTOMOTOS.COM", 0, 1, 'L');

$pdf->Ln(1);
$pdf->SetFont('', 'B', 18);
$pdf->Cell(60, 5, "¡GRACIAS POR PREFERIRNOS!", 0, 1, 'L');

//codigo formato
$pdf->SetFont('Arial', '', 9);
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();
$pdf->SetXY($current_x +29 , $current_y -91 );
$pdf->MultiCell(55,3,"Código :PGT - F - 01\nFecha : 2021 - 03 - 11\nVersión : 07",0,"R");


