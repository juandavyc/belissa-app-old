<?php

if (
    isset($_POST["data"]) &&
    isset($_POST["type"]) &&
    isset($_POST["value"]) &&
    isset($_POST["status"]) &&
    count($_POST) == 4
) {

    $tpet = htmlspecialchars($_POST["data"]);
    $type = htmlspecialchars($_POST["type"]);
    $value = htmlspecialchars($_POST["value"]);

    if ($tpet == 'VEHICULO') {
        $vehiculoClass = new VehiculoClass($this->pdo);
        $this->arrayResponse = $vehiculoClass->getInformacion(
            $type,
            $value,
        );
    } else if ($tpet == 'CONDUCTOR') {
        $clienteClass = new ClienteClass($this->pdo);
        $this->arrayResponse = $clienteClass->getInformacion(
            $type,
            $value,
        );
    } else if ($tpet == 'PROPIETARIO') {

        $clienteClass = new ClienteClass($this->pdo);
        $this->arrayResponse = $clienteClass->getInformacion(
            $type,
            $value,
        );
        // CONSULTA INVALIDA
    } else {
        echo json_encode(array('statusCode' => 400, 'statusText' => false, 'message' => 'Bad request'), http_response_code(400), JSON_FORCE_OBJECT);
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
