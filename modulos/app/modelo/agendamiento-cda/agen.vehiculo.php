<?php

if (

    isset($_POST['vehiculo']) &&
    isset($_POST['rol']) &&
    isset($_POST['status']) &&
    count($_POST) == 3
) {

    $placa = htmlspecialchars($_POST['vehiculo']);

    $agendamiento = new AgendamientoClass($this->pdo);
    $this->arrayResponse = $agendamiento->getVehiculoInformacion(
        'PLACA',
        $placa
    );
    $this->pdo = null;

} else if (!isset($_POST['status'])) {

    $json = array('statusCode' => 400, 'status' => false, 'message' => 'No tiene permisos para acceder');
    echo json_encode($json, http_response_code($json["statusCode"]), JSON_FORCE_OBJECT);
} else {

    $json = array('statusCode' => 400, 'status' => false, 'message' => 'Formulario incompleto');
    echo json_encode($json, http_response_code($json["statusCode"]), JSON_FORCE_OBJECT);
}