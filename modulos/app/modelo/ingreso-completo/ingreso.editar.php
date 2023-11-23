<?php

//foreach ($_POST as $key => $value) {

//echo '$mysqlStmt->bindParam(ññ:' . $key . 'ññ, $_datos[ññ' . strtoupper($key) . 'ññ], PDO::PARAM_STR); <br>';
//}

if (
    isset($_POST["id_ingreso"]) &&
    isset($_POST["id_vehiculo"]) &&
    isset($_POST["id_propietario"]) &&
    isset($_POST["id_conductor"]) &&
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
    isset($_POST["acepto_terminos_condiciones"]) &&
    isset($_POST["status"]) &&
    count($_POST) == 21//20
) {

    $ingresoClass = new IngresoClass($this->pdo);
    $this->arrayResponse = $ingresoClass->EditarIngreso(
        array(
            "ID_INGRESO" => ($_POST["id_ingreso"]),
            "ID_VEHICULO" => ($_POST["id_vehiculo"]),
            "ID_PROPIETARIO" => ($_POST["id_propietario"]),
            "ID_CONDUCTOR" => ($_POST["id_conductor"]),
            "PROPIETARIO_TIPO_DOCUMENTO" => $_POST["propietario_tipo_documento"],
            "PROPIETARIO_DOCUMENTO" => htmlspecialchars(strtoupper($_POST["propietario_documento"])),
            "PROPIETARIO_NOMBRES" => htmlspecialchars(strtoupper($_POST["propietario_nombres"])),
            "PROPIETARIO_APELLIDOS" => htmlspecialchars(strtoupper($_POST["propietario_apellidos"])),
            "PROPIETARIO_TELEFONO" => htmlspecialchars(strtoupper($_POST["propietario_telefono"])),
            "PROPIETARIO_CORREO" => htmlspecialchars(strtoupper($_POST["propietario_correo_nombre"] . '@' . $_POST["propietario_correo_dominio"])),
            "PROPIETARIO_DIRECCION" => htmlspecialchars(strtoupper($_POST["propietario_direccion"])),
            "CONDUCTOR_TIPO_DOCUMENTO" => $_POST["conductor_tipo_documento"],
            "CONDUCTOR_DOCUMENTO" => htmlspecialchars(strtoupper($_POST["conductor_documento"])),
            "CONDUCTOR_NOMBRES" => htmlspecialchars(strtoupper($_POST["conductor_nombres"])),
            "CONDUCTOR_APELLIDOS" => htmlspecialchars(strtoupper($_POST["conductor_apellidos"])),
            "CONDUCTOR_TELEFONO" => htmlspecialchars(strtoupper($_POST["conductor_telefono"])),
            "CONDUCTOR_CORREO" => htmlspecialchars(strtoupper($_POST["conductor_correo_nombre"] . '@' . $_POST["conductor_correo_dominio"])),
            "USUARIO" => $_SESSION['session_user'][1],
        )
    );
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