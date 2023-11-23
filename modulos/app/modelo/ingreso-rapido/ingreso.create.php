<?php

// foreach ($_POST as $key => $value) {
//     echo '$' . $key . ' = htmlspecialchars($_POST[' . '"' . $key . '"' . ']); <br>';

//     //echo 'isset($_POST["' . $key . '"]) &&  <br>';
// }

if (
    // nuevo
    isset($_POST["id_vehiculo"]) &&
    isset($_POST["placa"]) &&
    isset($_POST["id_propietario"]) &&
    isset($_POST["id_conductor"]) &&
    isset($_POST["vez"]) &&
    // normal
    isset($_POST["tipo_vehiculo"]) &&
    isset($_POST["servicio_vehiculo"]) &&
    isset($_POST["marca"]) &&
    isset($_POST["linea"]) &&
    isset($_POST["modelo"]) &&
    isset($_POST["color"]) &&
    isset($_POST["carroceria"]) &&
    isset($_POST["combustible"]) &&
    isset($_POST["certificado_gncv"]) &&
    isset($_POST["fecha_gncv"]) &&
    isset($_POST["capacidad"]) &&
    isset($_POST["puertas"]) &&
    isset($_POST["enseñanza"]) &&
    isset($_POST["kilometraje"]) &&
    isset($_POST["tipo_caja"]) &&
    isset($_POST["tiempos_motor"]) &&
    isset($_POST["disenio"]) &&
    isset($_POST["blindado"]) &&
    isset($_POST["polarizado"]) &&
    isset($_POST["delantera_moto"]) &&
    isset($_POST["trasera_moto"]) &&
    isset($_POST["delantera_izquierda_liviano"]) &&
    isset($_POST["trasera_izquierda_liviano"]) &&
    isset($_POST["trasera_derecha_liviano"]) &&
    isset($_POST["delantera_derecha_liviano"]) &&
    isset($_POST["repuesto_liviano"]) &&
    isset($_POST["defecto"]) &&
    isset($_POST["propietario_tipo_documento"]) &&
    isset($_POST["propietario_documento"]) &&
    isset($_POST["propietario_nombres"]) &&
    isset($_POST["propietario_apellidos"]) &&
    isset($_POST["propietario_telefono"]) &&
    isset($_POST["propietario_correo_nombre"]) &&
    isset($_POST["propietario_correo_dominio"]) &&
    isset($_POST["propietario_direccion"]) &&
    isset($_POST["conductor_tipo_documento"]) &&
    isset($_POST["conductor_documento"]) &&
    isset($_POST["conductor_nombres"]) &&
    isset($_POST["conductor_apellidos"]) &&
    isset($_POST["conductor_telefono"]) &&
    isset($_POST["conductor_correo_nombre"]) &&
    isset($_POST["conductor_correo_dominio"]) &&
    isset($_POST["canal_mercadeo"]) &&
    isset($_POST["guardar"]) &&
    isset($_POST["observaciones"]) &&
    isset($_POST["acepto_responsabilidad"]) &&
    isset($_POST["criterio"]) &&
    isset($_POST["firma"]) &&
    isset($_POST["status"]) &&
    count($_POST) == 54
) {

    $id_vehiculo = htmlspecialchars($_POST["id_vehiculo"]);
    $placa = htmlspecialchars(strtoupper($_POST["placa"]));
    $id_propietario = htmlspecialchars($_POST["id_propietario"]);
    $id_conductor = htmlspecialchars($_POST["id_conductor"]);
    $vez = htmlspecialchars($_POST["vez"]);
    $tipo_vehiculo = htmlspecialchars($_POST["tipo_vehiculo"]);
    $servicio_vehiculo = htmlspecialchars($_POST["servicio_vehiculo"]);
    $marca = htmlspecialchars($_POST["marca"]);
    $linea = htmlspecialchars($_POST["linea"]);
    $modelo = htmlspecialchars($_POST["modelo"]);
    $color = htmlspecialchars($_POST["color"]);
    $carroceria = htmlspecialchars($_POST["carroceria"]);
    $combustible = htmlspecialchars($_POST["combustible"]);
    $certificado_gncv = htmlspecialchars($_POST["certificado_gncv"]);
    $fecha_gncv = htmlspecialchars($_POST["fecha_gncv"]);
    $capacidad = htmlspecialchars($_POST["capacidad"]);
    $puertas = htmlspecialchars($_POST["puertas"]);
    $enseñanza = htmlspecialchars($_POST["enseñanza"]);
    $kilometraje = htmlspecialchars($_POST["kilometraje"]);
    $tipo_caja = htmlspecialchars($_POST["tipo_caja"]);
    $tiempos_motor = htmlspecialchars($_POST["tiempos_motor"]);
    $disenio = htmlspecialchars($_POST["disenio"]);
    $blindado = htmlspecialchars($_POST["blindado"]);
    $polarizado = htmlspecialchars($_POST["polarizado"]);
    $delantera_moto = htmlspecialchars($_POST["delantera_moto"]);
    $trasera_moto = htmlspecialchars($_POST["trasera_moto"]);
    $delantera_izquierda_liviano = htmlspecialchars($_POST["delantera_izquierda_liviano"]);
    $trasera_izquierda_liviano = htmlspecialchars($_POST["trasera_izquierda_liviano"]);
    $trasera_derecha_liviano = htmlspecialchars($_POST["trasera_derecha_liviano"]);
    $delantera_derecha_liviano = htmlspecialchars($_POST["delantera_derecha_liviano"]);
    $repuesto_liviano = htmlspecialchars($_POST["repuesto_liviano"]);
    $defecto = ($_POST["defecto"]);
    $propietario_tipo_documento = htmlspecialchars($_POST["propietario_tipo_documento"]);
    $propietario_documento = htmlspecialchars(strtoupper($_POST["propietario_documento"]));
    $propietario_nombres = htmlspecialchars(strtoupper($_POST["propietario_nombres"]));
    $propietario_apellidos = htmlspecialchars($_POST["propietario_apellidos"]);
    $telefono_propietario = htmlspecialchars($_POST["propietario_telefono"]);
    $propietario_correo = htmlspecialchars($_POST["propietario_correo_nombre"] . '@' . $_POST["propietario_correo_dominio"]);
    $propietario_direccion = htmlspecialchars($_POST["propietario_direccion"]);
    $conductor_tipo_documento = htmlspecialchars($_POST["conductor_tipo_documento"]);
    $conductor_documento = htmlspecialchars($_POST["conductor_documento"]);
    $conductor_nombres = htmlspecialchars(strtoupper($_POST["conductor_nombres"]));
    $conductor_apellidos = htmlspecialchars(strtoupper($_POST["conductor_apellidos"]));
    $conductor_telefono = htmlspecialchars($_POST["conductor_telefono"]);
    $conductor_correo = htmlspecialchars($_POST["conductor_correo_nombre"] . '@' . $_POST["conductor_correo_dominio"]);
    $canal_mercadeo = htmlspecialchars($_POST["canal_mercadeo"]);
    $guardar = htmlspecialchars($_POST["guardar"]);
    $observaciones = htmlspecialchars($_POST["observaciones"]);
    $acepto_responsabilidad = htmlspecialchars($_POST["acepto_responsabilidad"]);
    $criterio = ($_POST["criterio"]);
    
    
    if (
        $propietario_documento == '1110' || strlen($propietario_documento) <= 4 ||
        $conductor_documento == '1110' || strlen($conductor_documento) <= 4 ||
        $id_propietario == 1 || $id_conductor == 1
    ) {
        echo json_encode(array('statusCode' => 400, 'statusText' => 'error', 'message' => 'Verifique los <b>documentos del propietario o conductor</b>'), JSON_FORCE_OBJECT);
        exit;
    } else {
        
        $firma = getSRCImage64($_POST['firma'], '/archivos/ingreso/firma', time());
        $status = htmlspecialchars($_POST["status"]);
    
        $ingresoClass = new IngresoClass($this->pdo);
        $this->arrayResponse = $ingresoClass->CreateIngresoCom(
            array(
                "ID_VEHICULO" => $id_vehiculo,
                "PLACA" => $placa,
                "ID_PROPIETARIO" => $id_propietario,
                "ID_CONDUCTOR" => $id_conductor,
                "VEZ" => $vez,
                "TIPO_VEHICULO" => $tipo_vehiculo,
                "SERVICIO_VEHICULO" => $servicio_vehiculo,
                "MARCA" => $marca,
                "LINEA" => $linea,
                "MODELO" => $modelo,
                "COLOR" => $color,
                "CARROCERIA" => $carroceria,
                "COMBUSTIBLE" => $combustible,
                "CERTIFICADO_GNCV" => $certificado_gncv,
                "FECHA_GNCV" => $fecha_gncv,
                "CAPACIDAD" => $capacidad,
                "PUERTAS" => $puertas,
                "ENSENANZA" => $enseñanza,
                "KILOMETRAJE" => $kilometraje,
                "TIPO_CAJA" => $tipo_caja,
                "TIEMPOS_MOTOR" => $tiempos_motor,
                "DISENIO" => $disenio,
                "BLINDADO" => $blindado,
                "POLARIZADO" => $polarizado,
                "LLANTA_REFERENCIA" => 1, // SIN_REFERENCIA
                "DELANTERA_MOTO" => $delantera_moto,
                "TRASERA_MOTO" => $trasera_moto,
                "DELANTERA_IZQUIERDA_LIVIANO" => $delantera_izquierda_liviano,
                "TRASERA_IZQUIERDA_LIVIANO" => $trasera_izquierda_liviano,
                "TRASERA_DERECHA_LIVIANO" => $trasera_derecha_liviano,
                "DELANTERA_DERECHA_LIVIANO" => $delantera_derecha_liviano,
                "REPUESTO_LIVIANO" => $repuesto_liviano,
                "DEFECTO" => $defecto,
                "CRITERIO" => $criterio,
                "PROPIETARIO_TIPO_DOCUMENTO" => $propietario_tipo_documento,
                "PROPIETARIO_DOCUMENTO" => $propietario_documento,
                "PROPIETARIO_NOMBRES" => $propietario_nombres,
                "PROPIETARIO_APELLIDOS" => $propietario_apellidos,
                "TELEFONO_PROPIETARIO" => $telefono_propietario,
                "PROPIETARIO_CORREO" => $propietario_correo,
                "PROPIETARIO_DIRECCION" => $propietario_direccion,
                "CONDUCTOR_TIPO_DOCUMENTO" => $conductor_tipo_documento,
                "CONDUCTOR_DOCUMENTO" => $conductor_documento,
                "CONDUCTOR_NOMBRES" => $conductor_nombres,
                "CONDUCTOR_APELLIDOS" => $conductor_apellidos,
                "CONDUCTOR_TELEFONO" => $conductor_telefono,
                "CONDUCTOR_CORREO" => $conductor_correo,
                "CANAL_MERCADEO" => $canal_mercadeo,
                "POLITICA_CONFIDENCIALIDAD" => 2, // SI
                "OFERTAS_COMERCIALES" => 2, // SI
                "AUTORIZA_INSPECCION" => 2, // SI
                "GUARDAR" => $guardar,
                "OBSERVACIONES" => $observaciones,
                "FIRMA" => $firma,
                "USUARIO" => $_SESSION['session_user'][1],
            )
        );
    }
    $this->pdo = null;

} else if (!isset($_config)) {
    if (!isset($_POST['status'])) {
        echo json_encode(array('statusCode' => 400, 'statusText' => false, 'message' => 'Bad request'), http_response_code(400), JSON_FORCE_OBJECT);
        exit;
    } else {
        echo json_encode(array('statusCode' => 400, 'statusText' => 'error', 'message' => 'Formulario incompleto'), JSON_FORCE_OBJECT);
        exit;
    }
}