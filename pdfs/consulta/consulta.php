<?php 

require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/clases/ingreso/ingreso.class.php';




$database = new databaseConnection();
if ($database->estadoConexion()) {
    $pdo = $database->getPDO();


    $datos_vehiculo = new IngresoClass($pdo);
    $datos = $datos_vehiculo->InfoIngreso(
   
    $ID
   
);

$id_ingreso =  $datos["message"]["id"];
$placa = $datos["message"]["placa"];
$tipo_vehiculo = $datos["message"]["tipo_vehiculo"];
$kilometraje = $datos["message"]["kilometraje"];
$modelo = $datos["message"]["modelo"];
$marca = $datos["message"]["marca"];
$linea = $datos["message"]["linea"];
$color = $datos["message"]["color"];
$combustible = $datos["message"]["combustible"];
$puertas = $datos["message"]["puertas"];
$pasajeros = $datos["message"]["pasajeros"];
$blindado = $datos["message"]["blindado"];
$servicio = $datos["message"]["servicio_vehiculo"];
if($blindado == 1){

    $blindado = "NO";
}
else{
    $blindado = "SI";
}
$polarizado = $datos["message"]["polarizado"];
if($polarizado == 1){

    $polarizado = "NO";
}
else{
    $polarizado = "SI";
}
$tipo_caja = $datos["message"]["tipo_caja"];
$tiempo_motor = $datos["message"]["tiempo_motor"];
$vin = $datos["message"]["vin"];
$fecha = $datos["message"]["fecha_ingreso"];
//propietario
$telefono_propietario = $datos["message"]["telefono_propietario"];
$nombre_propietario = $datos["message"]["nombre_propietario"];
$correo_propietario = $datos["message"]["correo_propietario"];
$direccion_propietario = $datos["message"]["direccion_propietario"];
$documento_propietario = $datos["message"]["documento_propietario"];
//conductor
$telefono_conductor = $datos["message"]["telefono_conductor"];
$nombre_conductor = $datos["message"]["nombre_conductor"];
$correo_conductor = $datos["message"]["correo_conductor"];
$direccion_conductor = $datos["message"]["direccion_conductor"];
$documento_conductor = $datos["message"]["documento_conductor"];

$carroceria = $datos["message"]["carroceria"];
$vez = $datos["message"]["vez"];
$firma_usuario = $datos["message"]["firma_usuario"];
$firma_ingreso = $datos["message"]["firma_ingreso"];

$psi_moto_delantera = $datos["message"]["psi"]["moto_delantera"];
$psi_moto_trasera = $datos["message"]["psi"]["moto_trasera"];

$psi_liviano_delantera_derecha = $datos["message"]["psi"]["liviano_delantera_derecha"];
$psi_liviano_delantera_izquierda = $datos["message"]["psi"]["liviano_delantera_izquierda"];
$psi_liviano_trasera_derecha  = $datos["message"]["psi"]["liviano_trasera_derecha"];
$psi_liviano_trasera_izquierda = $datos["message"]["psi"]["liviano_trasera_izquierda"];
$psi_liviano_repuesto = $datos["message"]["psi"]["repuesto"];

$usuario = $datos["message"]["usuario"];
$observaciones = $datos["message"]["observaciones"];
$numero_gas = $datos["message"]["nro_gncv"];
$fecha_gas = $datos["message"]["fecha_gncv"];

$criterio = $datos["message"]["criterio"];
$defecto = $datos["message"]["defecto"];


}

 


// var_dump($datos["message"]);