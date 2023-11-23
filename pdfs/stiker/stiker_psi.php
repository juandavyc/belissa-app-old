<?php

$pdf = new PDF("L", "mm", array(160, 100));
$pdf->AliasNbPages();

$pdf->AddPage('', '', '', array(20, 250, '', 45));
$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(true,1);

$pdf->Image($_SERVER["DOCUMENT_ROOT"] . '/images/stiker_psi.jpg', 0, 0, 160, 100);


$pdf->Ln(-1);
$pdf->SetFont('Arial', 'B', 30);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(16, 4, "", 0, 0, 'R');
$pdf->Cell(60, 4, $placa, 0, 0, 'R');
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(110, 4, $fecha, 0, 0, 'C');
$pdf->Ln(14);
$pdf->SetFont('Arial', 'B', 28);
$pdf->Cell(85, 4, "", 0, 0, 'R');
$pdf->Cell(40, 4, $tipo_vehiculo, 0, 0, 'L');
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(64, 4, "", 0, 0, 'C');
$pdf->Cell(40, 4,$carroceria, 0, 0, 'C');

$pdf->Ln(11.5);
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(25, 4,"", 0, 0, 'L');
$pdf->Cell(100, 4,$linea, 0, 0, 'L');

$pdf->Ln(9.5);
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(16, 4,"", 0, 0, 'L');
$pdf->Cell(100, 4,$kilometraje, 0, 0, 'L');

$pdf->Ln(12);
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(60, 4,"", 0, 0, 'L');
$pdf->Cell(100, 4,$pasajeros, 0, 0, 'L');

if($vez == "PRIMERA VEZ"){
    $pdf->Ln(11.2);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 4,"", 0, 0, 'L');
    $pdf->Cell(100, 4,"X", 0, 0, 'L');
    
    $pdf->Ln(10.2);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(45, 4,"", 0, 0, 'L');
    $pdf->Cell(100, 4,"", 0, 0, 'L');

}
else{

$pdf->Ln(11.2);
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(40, 4,"", 0, 0, 'L');
$pdf->Cell(100, 4,"", 0, 0, 'L');

$pdf->Ln(10.2);
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(45, 4,"", 0, 0, 'L');
$pdf->Cell(100, 4,"X", 0, 0, 'L');

}

if($tipo_vehiculo == 'MOTO'){

$pdf->Ln(4);
$pdf->SetFont('Arial', '', 12);
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();
$pdf->SetXY($current_x +90, $current_y -36 );
$pdf->MultiCell(55,3,$psi_moto_delantera,0,"R");

$pdf->Ln(4);
$pdf->SetFont('Arial', '', 12);
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();
$pdf->SetXY($current_x +90, $current_y +1 );
$pdf->MultiCell(55,3,$psi_moto_trasera,0,"R");

$pdf->Ln(4);
$pdf->SetFont('Arial', '', 12);
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();
$pdf->SetXY($current_x +90, $current_y +1 );
$pdf->MultiCell(55,3,"",0,"R");

$pdf->Ln(4);
$pdf->SetFont('Arial', '', 12);
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();
$pdf->SetXY($current_x +90, $current_y +1 );
$pdf->MultiCell(55,3,"",0,"R");

$pdf->Ln(4);
$pdf->SetFont('Arial', '', 12);
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();
$pdf->SetXY($current_x +90, $current_y +1 );
$pdf->MultiCell(55,3,"",0,"R");
}
 else{

$pdf->Ln(4);
$pdf->SetFont('Arial', '', 12);
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();
$pdf->SetXY($current_x +90, $current_y -36 );
$pdf->MultiCell(55,3,$psi_liviano_delantera_izquierda,0,"R");

$pdf->Ln(4);
$pdf->SetFont('Arial', '', 12);
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();
$pdf->SetXY($current_x +90, $current_y +1 );
$pdf->MultiCell(55,3,$psi_liviano_trasera_izquierda,0,"R");

$pdf->Ln(4);
$pdf->SetFont('Arial', '', 12);
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();
$pdf->SetXY($current_x +90, $current_y +1 );
$pdf->MultiCell(55,3,$psi_liviano_delantera_derecha,0,"R");

$pdf->Ln(4);
$pdf->SetFont('Arial', '', 12);
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();
$pdf->SetXY($current_x +90, $current_y +1 );
$pdf->MultiCell(55,3,$psi_liviano_trasera_derecha,0,"R");

$pdf->Ln(4);
$pdf->SetFont('Arial', '', 12);
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();
$pdf->SetXY($current_x +90, $current_y +1 );
$pdf->MultiCell(55,3,$psi_liviano_repuesto,0,"R");


 }
