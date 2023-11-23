<?php

if (
    isset($_POST['data_dev']) &&
    isset($_POST['status']) &&
    count($_POST) == 2
) {

    $id = $_SESSION['session_user'][1];

    $micuentaClass = new MiCuentaClass($this->pdo);
    $this->arrayResponse = $micuentaClass->getMiCuenta(
        $id
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