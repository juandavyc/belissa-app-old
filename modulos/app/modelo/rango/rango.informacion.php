<?php

if (
    isset($_POST['id']) &&
    isset($_POST['status']) &&
    count($_POST) == 2
) {

    $id_rango = htmlspecialchars($_POST['id']);

    $rangoClass = new RangoClass($this->pdo);
    $this->arrayResponse = $rangoClass->InformacionRango(
        encrypt($id_rango, 2)
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