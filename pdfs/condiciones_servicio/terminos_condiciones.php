<?php

if($vez == 1){

    $vez = "PRIMERA VEZ";
}
else{
    $vez = "SEGUNDA VEZ";
}

$pdf-> SetLineWidth(0.3);
$pdf->AddPage('', '', '', array(20, 250, 'A U T O M O T O S', 45,));


$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 20, " ", 0, 1, 'C');

$pdf->Ln(0);
$pdf->SetFont('Arial','',7);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetDrawColor( 255, 176, 32 );
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();
$pdf->SetXY($current_x + 72, $current_y - 17);
$pdf->MultiCell(55,3,utf8_decode("CDA AUTOMOTOS SAS \nNit. 900771073 - 1 \nWWW.CDAAUTOMOTOS.COM\nCra. 85 No. 7d-30. Av. Ciudad de Cali "),0,"L");
//codigo formato
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();
$pdf->SetXY($current_x + 145, $current_y - 12);
$pdf->MultiCell(55,3,utf8_decode("RECEPCIÓN DE VEHÍCULOS\nCódigo :PGT - F - 01\nFecha : 2021 - 03 - 11\nVersión : 07"),0,"R");

$pdf->Ln(10);

$image1 = ($_SERVER["DOCUMENT_ROOT"]   . "/images/escudo.jpg");
$pdf->Cell(60, 20, $pdf->Image($image1, $pdf->GetX() -8, $pdf->GetY() -30, 30,30), 0, 0, 'L', false);
$image2 = ($_SERVER["DOCUMENT_ROOT"]   . "/images/logo_empresa.jpg");
$pdf->Cell(60, 20, $pdf->Image($image2, $pdf->GetX() -36, $pdf->GetY() -22, 35,15), 0, 0, 'L', false);


$pdf->Ln(3);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(240, 240, 240);
$pdf->SetDrawColor( 0, 0, 0 );
$pdf->Cell(49,5,utf8_decode("NÙMERO"),'T,L',0,'C');
$pdf->Cell(49,5,"PLACA",'T',0,'C');
$pdf->Cell(49,5,"VEZ",'T',0,'C');
$pdf->Cell(49,5,"FECHA",'T,R',0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(49,5,$id_ingreso,'B,L',0,'C');
$pdf->Cell(49,5,$placa,'B',0,'C');
$pdf->Cell(49,5,$vez,'B',0,'C');
$pdf->Cell(49,5,$fecha,'B,R',0,'C');

$pdf->Ln(10);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(49,5,utf8_decode("TIPO DE VEHÌCULO"),'T,L',0,'C');
$pdf->Cell(49,5,"MOTOR (APLICA MOTOS)",'T',0,'C');
$pdf->Cell(49,5,"SERVICIO",'T',0,'C');
$pdf->Cell(49,5,"PASAJEROS",'T,R',0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(49,5,$tipo_vehiculo,'B,L',0,'C');
if($tipo_vehiculo == 'MOTO'){
	$pdf->Cell(49,5,$tiempo_motor,'B',0,'C');
}
else{
	$pdf->Cell(49,5,'NO APLICA','B',0,'C');
}

$pdf->Cell(49,5,$servicio,'B',0,'C');
$pdf->Cell(49,5,$pasajeros,'B,R',0,'C');

$pdf->Ln(10);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(49,5,"MARCA",'T,L',0,'C');
$pdf->Cell(49,5,"MODELO",'T',0,'C');
$pdf->Cell(49,5,"COLOR",'T',0,'C');
$pdf->Cell(49,5,"KILOMETRAJE",'T,R',0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(49,5,$marca,'B,L',0,'C');
$pdf->Cell(49,5,$modelo,'B',0,'C');
$pdf->Cell(49,5,$color,'B',0,'C');
$pdf->Cell(49,5,$kilometraje,'B,R',0,'C');

$pdf->Ln(10);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(49,5,"COMBUSTIBLE",'T,L',0,'C');
$pdf->Cell(49,5,"GNCV/GASOLINA",'T',0,'C');
$pdf->Cell(49,5,"BLINDADO",'T',0,'C');
$pdf->Cell(49,5,"POLARIZADO",'T,R',0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(49,5,$combustible,'B,L',0,'C');
if($numero_gas == 'SIN_CERTIFICADO'){
	$pdf->Cell(49,5,"NO APLICA",'B',0,'C');
}
else{
	$pdf->Cell(49,5,$numero_gas,'B',0,'C');
}
$pdf->Cell(49,5,$blindado,'B',0,'C');
$pdf->Cell(49,5,$polarizado,'B,R',0,'C');


$pdf->Ln(10);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(98,5,"(CONDUCTOR) DOCUMENTO",'T,L',0,'C');
$pdf->Cell(98,5,"(CONDUCTOR) NOMBRE",'T,R',0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(98,5,$documento_conductor,'B,L',0,'C');
$pdf->Cell(98,5,utf8_decode($nombre_conductor),'B,R',0,'C');


$pdf->Ln(10);
$pdf->SetFont('Arial','',8);
$pdf->Cell(196,5,utf8_decode("VERIFICACIÓN DE CONDICIONES Y REQUISITOS MINIMOS PARA REALIZAR LA INSPECCIÓN"),0,0,'C');

$pdf->Ln(10);
$pdf->SetFont('Arial','',7);
$pdf->Cell(196,5,utf8_decode("(Se deben cumplir todos los criterios para autorizar la inspección, si se cumple el criterio se marca “SI” y si no cumple se marca “NO”, en el caso de la presión de aire de las"),'T,L,R',0,'C');
$pdf->Ln();
$pdf->Cell(196,5,utf8_decode("ruedas se debe registrar el valor numérico de la presión de cada rueda expresado en PSI)"),'B,L,R',0,'C');

$pdf->Ln(10);
$pdf->SetFont('Arial','B',8);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(240, 240, 240);
$pdf->SetDrawColor( 0, 0, 0 );
$pdf->Cell(30,5,"",'T,L',0,'C');
$pdf->Cell(68,5,"CRITERIO",'T',0,'C');
$pdf->Cell(39,5,"",'T',0,'C');
$pdf->Cell(59,5,"CUMPLE",'T,R',0,'C');


$criterios = json_decode($criterio,2); 


foreach($criterios as $key => $value) {
    $titulo = utf8_decode($value['titulo']);
	$respuesta = utf8_decode($value['respuesta']);


	$pdf->Ln(5);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(30,5,"",'L',0,'C');
    $pdf->Cell(68,5,$titulo,0,0,'L');
    $pdf->Cell(39,5,'',0,0,'R');
    $pdf->Cell(59,5,$respuesta,'R',0,'C');
	

}
$pdf->Ln(5);
$pdf->Cell(196,5,"",'T',0,'C');

if($tipo_vehiculo == 'MOTO'){
	$pdf->Ln(10);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(196,5,utf8_decode("PRESION DE LAS LLANTAS MOTO"),0,0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(240, 240, 240);
$pdf->SetDrawColor( 0, 0, 0 );
$pdf->Cell(49,5,"DELANTERA",'T,L,B',0,'C');
$pdf->Cell(49,5,$psi_moto_delantera,'T,B',0,'C');
$pdf->Cell(49,5,"TRASERA",'T,B',0,'C');
$pdf->Cell(49,5,$psi_moto_trasera,'T,R,B',0,'C');
}
else{
$pdf->Ln(10);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(196,5,utf8_decode("PRESION DE LAS LLANTAS LIVIANO"),0,0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(240, 240, 240);
$pdf->SetDrawColor( 0, 0, 0 );
$pdf->Cell(49,5,"DELANTERA DERECHA",'T,L',0,'C');
$pdf->Cell(49,5,$psi_liviano_delantera_derecha ,'T',0,'C');
$pdf->Cell(49,5,"TRASERA DERECHA",'T',0,'C');
$pdf->Cell(49,5,$psi_liviano_trasera_derecha,'T,R',0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(49,5,"DELANTERA IZQUIERDA",'L',0,'C');
$pdf->Cell(49,5,$psi_liviano_delantera_izquierda ,'',0,'C');
$pdf->Cell(49,5,"TRASERA IZQUIERDA",'',0,'C');
$pdf->Cell(49,5,$psi_liviano_trasera_izquierda,'R',0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(49,5,"LLANTA DE REPUESTO",'B,L',0,'C');
$pdf->Cell(49,5,$psi_liviano_repuesto,'B',0,'C');
$pdf->Cell(98,5,"",'B,R',0,'C');
}



$pdf->Ln(15);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(240, 240, 240);
$pdf->SetDrawColor( 0, 0, 0 );
$pdf->Cell(98,5,"(PROPIETARIO) CEDULA/NIT",'T,L',0,'C');
$pdf->Cell(98,5,"(PROPIETARIO) NOMBRE",'T,R',0,'C');
$pdf->Ln();
$pdf->SetFont('Arial','',10);
$pdf->Cell(98,5,$documento_propietario,'B,L',0,'C');
$pdf->Cell(98,5,utf8_decode($nombre_propietario),'B,R',0,'C');

$pdf->Ln(10);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(240, 240, 240);
$pdf->SetDrawColor( 0, 0, 0 );
$pdf->Cell(65.33,5,"(PROPIETARIO) TELEFONO",'T,L',0,'C');
$pdf->Cell(65.33,5,"(PROPIETARIO) CORREO ELECTRONICO",'T',0,'C');
$pdf->Cell(65.33,5,"(PROPIETARIO) DIRECCION",'T,R',0,'C');
$pdf->Ln();
$pdf->SetFont('Arial','',10);
$pdf->Cell(65.33,5,$telefono_propietario,'B,L',0,'C');
$pdf->Cell(65.33,5,$correo_propietario,'B',0,'C');
$pdf->Cell(65.33,5,$direccion_propietario,'B,R',0,'C');

$pdf->Ln(10);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(240, 240, 240);
$pdf->SetDrawColor( 0, 0, 0 );
$pdf->Cell(98,5,"CLIENTE",'T,L,R',0,'C');
$pdf->Cell(98,5,"RECEPCIONISTA",'T,R,L',0,'C');
$pdf->Ln();
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(98,5,utf8_decode("Señor usuario, usted firma este documento acepta el
servicio en las condiciones establecidas en este contrato y
que las condiciones de su vehículo registradas en el
inventario son veraces."),1,"L");
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();
$pdf->SetXY($current_x +98, $current_y -20);
$pdf->MultiCell(98,5,utf8_decode("Visto bueno del encargado de recepción, con respecto al 
cumplimiento de los requisitos previos a la inspección.\n\n\n"),1,"L");


$pdf->Ln(50);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(240, 240, 240);
$pdf->SetDrawColor( 0, 0, 0 );
$pdf->Cell(98,5,"TRATAMIENTO DE SUS DATOS",'T,L,R',0,'C');
$pdf->Cell(98,5,"DATOS PERSONALES PARA CONTACTARME",'T,R,L',0,'C');
$pdf->Ln();
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(98,5,utf8_decode("¿Autoriza el tratamiento de sus datos personales
sensibles?\n\n
"),'L,R',"L");
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();
$pdf->SetXY($current_x +98, $current_y -20);
$pdf->MultiCell(98,5,utf8_decode("Además de lo anterior autorizo a CDA AUTOMOTOS SAS
para utilizar mis datos personales para contactarme vía
telefónica, mensaje de texto, correo postal y/o correo
electrónico para recordatorios y ofertas comerciales."),'L,R',"L");
$pdf->Ln(0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(98,5,"(CLIENTE) SI, AUTORIZO",'B,L,R',0,'C');
$pdf->Cell(98,5,"(CLIENTE) SI, AUTORIZO",'B,R,L',0,'C');

$pdf->Ln(10);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(240, 240, 240);
$pdf->SetDrawColor( 0, 0, 0 );
$pdf->Cell(98,5,"CLIENTE",1,0,'C');
$pdf->Cell(98,5,"RECEPCIONISTA",1,0,'C');

$pdf->Ln(-20);
$image3 = ($_SERVER["DOCUMENT_ROOT"] . $firma_ingreso);
$pdf->Cell(60, 20, $pdf->Image($image3, $pdf->GetX() + 25, $pdf->GetY() +30, 50,20), 50, 20, 'L', false);

$image4 = ($_SERVER["DOCUMENT_ROOT"] .$firma_usuario);
$pdf->Cell(60, 20, $pdf->Image($image4, $pdf->GetX() + 125, $pdf->GetY() +10, 50,20), 50, 20, 'L', false);
$pdf->Ln(8);
$pdf->Cell(98,4,"____________________________________",0,0,'C');
$pdf->Cell(98,4,"____________________________________",0,0,'C');

$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->Ln(8);
$pdf->Cell(98,4,utf8_decode($nombre_conductor),0,0,'C');
$pdf->Cell(98,4,$usuario,0,0,'C');
$pdf->Ln(5);
$pdf->Cell(98,4,$fecha,0,0,'C');
$pdf->Cell(98,4,$fecha,0,0,'C');

$pdf->Ln(10);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(240, 240, 240);
$pdf->SetDrawColor( 0, 0, 0 );
$pdf->Cell(196,5,"OBSERVACIONES",1,0,'C');
$pdf->Ln();
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(196,5,utf8_decode($observaciones),1,"L");


$pdf->Ln(5);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(190,5,"FOTOS DE DEFECTOS ENCONTRADOS AL INGRESO",0,0,'C');

$fotos = json_decode($defecto,2); 
$default_value = '/images/sin_imagen.png';
$foto1 = isset($fotos[0]['respuesta']) ? $fotos[0]['respuesta'] : $default_value;
$foto2 = isset($fotos[1]['respuesta']) ? $fotos[1]['respuesta'] : $default_value;
$foto3 = isset($fotos[2]['respuesta']) ? $fotos[2]['respuesta'] : $default_value;
$foto4 = isset($fotos[3]['respuesta']) ? $fotos[3]['respuesta'] : $default_value;
$foto5 = isset($fotos[4]['respuesta']) ? $fotos[4]['respuesta'] : $default_value;
$foto6 = isset($fotos[5]['respuesta']) ? $fotos[5]['respuesta'] : $default_value;
$foto7 = isset($fotos[6]['respuesta']) ? $fotos[6]['respuesta'] : $default_value;
$foto8 = isset($fotos[7]['respuesta']) ? $fotos[7]['respuesta'] : $default_value;
$foto9 = isset($fotos[8]['respuesta']) ? $fotos[8]['respuesta'] : $default_value;

$pdf->Ln(10);
$image5 = ($_SERVER["DOCUMENT_ROOT"]   . $foto1);
$pdf->Cell(60, 20, $pdf->Image($image5, $pdf->GetX() , $pdf->GetY() , 60,60), 0, 0, 'L', false);
$image6 = ($_SERVER["DOCUMENT_ROOT"]   . $foto2);
$pdf->Cell(60, 20, $pdf->Image($image6, $pdf->GetX() +8 , $pdf->GetY() , 60,60), 0, 0, 'L', false);
$image7 = ($_SERVER["DOCUMENT_ROOT"]   . $foto2);
$pdf->Cell(60, 20, $pdf->Image($image7, $pdf->GetX()+15 , $pdf->GetY() , 60,60), 0, 0, 'L', false);


$pdf->Ln(65);
$image8 = ($_SERVER["DOCUMENT_ROOT"]   . $foto4);
$pdf->Cell(60, 20, $pdf->Image($image8, $pdf->GetX() , $pdf->GetY() , 60,60), 0, 0, 'L', false);
$image9 = ($_SERVER["DOCUMENT_ROOT"]   . $foto5);
$pdf->Cell(60, 20, $pdf->Image($image9, $pdf->GetX() +8 , $pdf->GetY() , 60,60), 0, 0, 'L', false);
$image10 = ($_SERVER["DOCUMENT_ROOT"]   . $foto6);
$pdf->Cell(60, 20, $pdf->Image($image10, $pdf->GetX()+15 , $pdf->GetY() , 60,60), 0, 0, 'L', false);

$pdf->Ln(65);
$image11 = ($_SERVER["DOCUMENT_ROOT"]   . $foto7);
$pdf->Cell(60, 20, $pdf->Image($image11, $pdf->GetX() , $pdf->GetY() , 60,60), 0, 0, 'L', false);
$image12 = ($_SERVER["DOCUMENT_ROOT"]   . $foto8);
$pdf->Cell(60, 20, $pdf->Image($image12, $pdf->GetX() +8 , $pdf->GetY() , 60,60), 0, 0, 'L', false);
$image13 = ($_SERVER["DOCUMENT_ROOT"]   . $foto9);
$pdf->Cell(60, 20, $pdf->Image($image13, $pdf->GetX()+15 , $pdf->GetY() , 60,60), 0, 0, 'L', false);

$pdf->Ln(200);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(196,5,"TERMINOS Y CONDICIONES DEL SERVICIO ",0,0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','',8);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetDrawColor( 255, 176, 32 );
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();
$pdf->SetXY($current_x , $current_y);
$pdf->MultiCell(196,5,utf8_decode("1. El CDA AUTOMOTOS SAS, se encuentra habilitado para prestar los servicios de inspección y certificación para la Revisión Técnico Mecánica
y Emisiones Contaminantes - RTM y EC-, para motocicletas con motor 4T y 2T y vehículos livianos a través de las resoluciones 2962 del 25 de
agosto del 2015 del ministerio de transporte y 03319 de la secretaria distrital de ambiente, en el CDA AUTOMOTOS SAS, contamos con acreditación
ONAC vigente a la fecha, con código de acreditación 15-OIN-010 bajo la norma ISOIEC 17020:2012, Por lo anteriormente descrito cabe resaltar que
El CDA AUTOMOTOS SAS, cuenta con instalaciones adecuadas, los equipos requeridos y personal técnico competente para realizar esta labor.
			2. La RTM y EC se realiza de acuerdo a lo estipulado en las Normas Técnicas Colombianas y a la normatividad legal vigente aplicable al proceso
de inspección (ISO-IEC 17020:2012, NTC 5375:2012, NTC 5385:2011, NTC 5365:2012, NTC 4231:2012, NTC5385:2011 leyes, resoluciones
aplicables) y solo serán aprobados aquellos vehículos que cumplan la conformidad de la inspección.
			3. El tiempo estimado para la realización de la prueba es de 40 min, una vez que el vehículo ha ingresado a la pista de revisión, teniendo en
cuenta que puede haber más vehículos en espera, lo que ocasionara un tiempo adicional.
			4. Es obligatoria la presencia física del vehículo en el CDA AUTOMOTOS SAS con su respectiva documentación y el cumplimiento de las
condiciones de preparación para la inspección, entre otras condiciones se tendrán en cuenta:  Presentar el vehículo descargado, en estado de
limpieza, sin tapacubos o copas, alarma desactivada, además de otras condiciones que hacen parte de la preparación del vehículo como son:
Todos los cinturones de seguridad deben estar visibles, llantas de repuesto accesibles, sin cubiertas que no permitan su verificación, puertas y
compuertas sin candados, cubiertas de las baterías sin elementos que no permitan su verificación, vehículo con suficiente combustible que permita
la realización de las pruebas (no reserva) EN CASO DE LAS MOTOCICLETAS ADICIONALMENTE ESTADO ADECUADO DE LA MIRILLA PARA
VERIFICACION DE LIQUIDO DE FRENOS Y SOPORTE CENTRAL, y demás condiciones adicionales que podrían ser informadas al momento de
su presentación, tenga en cuenta que la identificación del vehículo se realizara por medio de la licencia de transito del vehículo y la plataforma
RUNT, confrontando placa, marca, clase de vehículo, servicio y color, para los vehículos que funcionan con gas natural se debe verificar la vigencia
del certificado de revisión de la instalación 
			5. Al realizar la RTM y EC, su vehículos será sometido a pruebas con el grado de exigencia estipulado por las Normas Técnicas Colombianas y a
la normatividad legal vigente aplicable al proceso de inspección, por lo tanto, el CDA AUTOMOTOS SAS, no se hace responsable por los elementos
del vehículo que pudieran fallar al momento de ejecutar el proceso, tampoco se hace responsable de los elementos del vehículo que pudieran fallar
al momento de la inspección por causas asociadas a vejez, deterioro o falta de mantenimiento, dentro o fuera del CDA AUTOMOTOS SAS.
			6. Verifique el estado con el personal de recepción el estado con el cual entrega su vehículo y si existen novedades, el personal de recepción las
registrara en el software destinado para ello.
			7. Retire elementos de valor, dinero, celulares u otros ya que el CDA AUTOMOTOS SAS, no se hará responsable en caso de pérdida.
			8. Desplácese por las áreas autorizadas, el cliente no debe ingresar a la pista de inspección, para la espera de los resultados de la inspección, el
CDA AUTOMOTOS SAS, dispone de una sala de espera, la cual permite evidenciar de forma directa el proceso de revisión de su vehículo.
			9. Está totalmente prohibida la comunicación o interacción de los clientes con el personal técnico que realiza la inspección. De ser necesario
puede dirigirse al director técnico responsable, CDA AUTOMOTOS SAS, mantiene políticas de independencia e imparcialidad para asegurar que
las inspecciones realizadas se realicen objetivamente, de encontrarse algún conflicto de interés o resultados implicados en falta de imparcialidad, se
iniciaran las correcciones pertinentes
			10. Los resultados de la RTM y EC se obtienen de un proceso totalmente técnico, no son modificables y no están sujetos a la entrega del
certificado.
			11. Por favor absténgase de dar propinas, obsequios o cualquier otro tipo de remuneración por la certificación de su vehículo: al hacerlo pone
en riesgo la estabilidad laboral del empleado ya que el proceso de inspección debe ser imparcial.
			12. En caso de que el resultado de la RTM y EC sea no aprobado, el cliente tendrá un periodo de 15 días calendario, contados a partir de la fecha
en que fue reprobado, para efectuar las reparaciones pertinentes y subsanar los aspectos reprobados en la visita inicial. Una vez efectuadas las
reparaciones el vehículo puede regresar por una única vez más sin costo al CDA AUTOMOTOS SAS, para someter el vehículo a la revisión de
los aspectos reprobados en la visita inicial. En la segunda visita al CDA AUTOMOTOS SAS, el vehículo, en todos los casos, será objeto de una
revisión sensorial completa para verificar que las condiciones generales del vehículo se mantienen, y se procederá a hacer una revisión gratuita de
los aspectos reprobados en la visita inicial mediante revisión visual o revisión mecanizada, según corresponda. Cuando de la revisión visual se
compruebe que el vehículo pudo haber sufrido alguna alteración, este será sometido a una revisión total como si acudiera por primera vez y esta
generará el respectivo cobro. (Art. 28 Resolución 3768 de 2013 del ministerio de transporte).
			13. Por ningún motivo se realizará la devolución del dinero ya que el pago del servicio para realizar la RTM y EC no depende del resultado de la
inspección.
			14. Al presentarse alguna falla en el vehículo en el transcurso de alguna de las pruebas de la inspección, el CDA AUTOMOTOS SAS, no realizara
ningún ajuste o arreglo al vehículo, pues su único objetivo es evaluar los parámetros de revisión los cuales determinan su APROBACION o NO
APROBACION. PARA LOS VEHICULOS QUE NO PRESENTEN PROFUNDIDAD DE LABRADO SUFICIENTE (1.6/2.0 mm) Y MOTOS (1.0mm), NO
SE REALIZARÁ LA PRUEBA DE FRENOS, LA PRUEBA SE REALIZARÁ EN LA REINSPECCION DEL VEHICULO O MOTOCICLETA.
			15. Revise que los documentos entregados después de la revisión son de su propiedad.
			16. En su condición de cliente, usted tiene derecho a calificar nuestro servicio instaurar una queja o apelación cuando sea necesario, para ello
puede acercarse al punto disponible en la sala de espera para tal fin.
			17. Los resultados de la inspección, así como sus datos personales, son confidenciales y están protegidos
			18. Revise su vehículo antes de retirarlo del CDA AUTOMOTOS SAS, no se atenderán posteriores reclamos.
			19. Cualquier otra actividad económica o complementaria diferente a la RTM y EC que desarrolle el CDA AUTOMOTOS SAS  con sus clientes, por
ejemplo la venta de SOAT o la realización de preventivas, es independiente al proceso de certificación, por ende no se dará ningún tipo de
favorecimiento en los resultados de la RTM y EC ni tampoco favorecimientos económicos en los costos del servicio por el desarrollo de estas
actividades, la inspección se realizara de una manera independiente e imparcial para todos los clientes ,SEÑOR USUARIO NUESTRAS TARIFAS DE
RTM y  EC. ESTÁN REGULADAS CONDFORME A LA REGLAMENTACION PARA EL SECTOR. "),0,"J");


$pdf->Ln(5);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(196,5,"AVISO DE PRIVACIDAD ",0,0,'C');

$pdf->Ln(5);
$pdf->SetFont('Arial','',8);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetDrawColor( 255, 176, 32 );
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();
$pdf->SetXY($current_x , $current_y);
$pdf->MultiCell(196,5,utf8_decode("El CDA actuando en calidad de responsable del tratamiento de sus datos personales, informa que los datos personales suministrados por Usted con
ocasión de su acceso a los servicios ofrecidos, serán incluidos en distintas bases de datos y serán utilizados para las siguientes finalidades:
	A ) Transferencia al RUNT de los resultados de la revisión, sea esta aprobada o rechazada.
	B ) Transferencia a la Autoridad ambiental y c) transferencia al SICOV CI2, de la información de los propietarios, poseedor o tenedor del vehículo,
información del vehículo y de los valores del análisis de emisiones contaminantes y las demás pruebas aplicables, así como el envió de la
información requerida por la Secretaria de Medio Ambiente y ONAC, entre otros por condiciones contractuales y legales del CDA.
	C ) si es requerido transferencia al organismo de transito del municipio, de las inconsistencias encontradas entre la información documental y la
presencia física del vehículo.
	D ) Transferencia a la Superintendencia de puertos y transporte de la información de los propietarios, poseedor o tenedor del vehículo, información
del vehículo y de todos los resultados de la inspección.
	E ) Envío de avisos,propaganda o publicidad sobre nuestros servicios.
	F ) Notificación de vencimiento de la RTM y EC, así como notificación de vencimiento de SOAT g) Al uso de la información personal recolectada
para finalidades iguales, análogas o compatibles con aquellas para las cuales se recogieron los datos personales inicialmente.
	El CDA se reserva el derecho de modificar los términos y condiciones de este aviso de privacidad y la política de tratamiento de información, en
cuyo caso la modificación se notificará a través del medio de comunicación que considere más adecuado para tal efecto, (pudiendo ser, por
ejemplo, correo electrónico, avisos en medios de comunicación, comunicación directa, y/o un anuncio en nuestra página de Internet, etc.).
	Los titulares podrán conocer a mayor profundidad las políticas de tratamiento mediante consulta en las instalaciones del CDA. Para cualquier
información sobre este aviso de privacidad, de la ley aplicable o para el ejercicio de cualquiera de los derechos derivados de la protección de sus
datos personales, incluyendo sin limitación sus derechos de acceso, rectificación, y supresión (siempre que no exista un mandato legal o contractual
que faculte a El CDA para continuar con el tratamiento directamente), Si por ley se deba divulgar su información confidencial o cuando esté
autorizado por compromisos contractuales usted será notificado salvo que lo prohíba la ley La información obtenida por fuentes distintas al cliente
será tratada de manera confidencial."),0,"J");


$pdf->Ln(5);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(196,5,"TRATAMIENTO DE DATOS",0,0,'C');

$pdf->Ln(5);
$pdf->SetFont('Arial','',8);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetDrawColor( 255, 176, 32 );
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();
$pdf->SetXY($current_x , $current_y);
$pdf->MultiCell(196,5,utf8_decode("CDA AUTOMOTOS S.A.S, manifiesta que garantiza el derecho a la privacidad de los datos de sus clientes y teniendo como base que la información
obtenida por el cliente se podrá utilizar con fines comerciales, cumpliendo con lo establecido en la ley 1581 de 2012 y el decreto reglamentario 1377
de 2013, previa autorización del cliente.
		Por lo anterior el CDA AUTOMOTOS S.A.S, solicita su autorización expresa para el manejo de sus datos personales obtenidos como resultado de la
prestación de servicio de preventiva, y la cual se podrá utilizar para lo siguiente:
		1.	Proporcionar la información correspondiente en los resultados.
		2.	Se realizarán las actividades y pruebas solicitadas por el cliente.
		3.	Evaluar la calidad de nuestros servicios mediante las herramientas que el CDA AUTOMOTOS S.A.S dispone para ello.
		4.	Realizar actividades de mercadeo, publicidad, mejoras en el servicio, consultas y cualquier actividad relacionada con nuestros servicios.
		Autoriza que el CDA AUTOMOTOS S.A.S, use la información consignada en este documento para los fines anteriormente descritos: 
		SI:  X      NO: "),0,"J");
        


        $pdf->Ln(-20);
        $image5 = ($_SERVER["DOCUMENT_ROOT"] . "/images/super_transporte.jpg");
        $pdf->Cell(60, 20, $pdf->Image($image5, $pdf->GetX() + 0, $pdf->GetY() +30, 50,20), 50, 20, 'L', false);









