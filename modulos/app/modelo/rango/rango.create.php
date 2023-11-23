<?php

if (
    isset($_POST['nombre']) &&
    isset($_POST['status']) &&
    isset($_POST['tipo_conexion']) &&
    isset($_POST['modulo']) &&
    isset($_POST['acepto_responsabilidad']) &&
    count($_POST) == 5
) {

    $nombre = htmlspecialchars($_POST['nombre']);
    $modu = '';

    foreach ($_POST['modulo'] as $key => $value) {
        $modu .= '"' . $value . '",';
    }

    $modulos = '["inicio",' . substr_replace($modu, "", -1) . ']';

    $rangoClass = new RangoClass($this->pdo);
    $this->arrayResponse = $rangoClass->CreateRango(
        array(
            'NOMBRE' => $nombre,
            'MODULO' => $modulos,
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