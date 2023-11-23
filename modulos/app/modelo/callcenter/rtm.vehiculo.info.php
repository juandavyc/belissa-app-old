<?php
// var_dump($_POST);
if (
    isset($_POST['vehiculo']) &&
    isset($_POST['rol']) &&
    isset($_POST['status']) &&
    count($_POST) == 3
) {

    $vehiculoDetalles = new VehiculoClass($this->pdo);

    $this->arrayResponse = $vehiculoDetalles->getInformacion(
        htmlspecialchars($_POST['rol']),
        htmlspecialchars($_POST['vehiculo'])
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