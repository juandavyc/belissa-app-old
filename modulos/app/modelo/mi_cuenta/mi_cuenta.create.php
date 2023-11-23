<?php

// var_dump($_POST);
if (
    isset($_POST["form_0_nombre"]) &&
    isset($_POST["form_0_apellido"]) &&
    isset($_POST["foto_usuario"]) &&
    isset($_POST["interfaz"]) &&
    isset($_POST['form_firma']) &&
    isset($_POST['status']) &&
    count($_POST) == 6
) {

    $id = htmlspecialchars($_SESSION['session_user'][1]);
    $nombre = htmlspecialchars(strtoupper($_POST["form_0_nombre"]));
    $apellido = htmlspecialchars(strtoupper($_POST["form_0_apellido"]));
    $foto = htmlspecialchars($_POST["foto_usuario"]);
    $interfaz = htmlspecialchars($_POST["interfaz"]);
    $firma = getSRCImage64($_POST['form_firma'], '/archivos/usuario/firma', time());

    $_SESSION['session_user'][7] = ($interfaz == 1) ? 'white' : 'black';

    $micuentaClass = new MiCuentaClass($this->pdo);
    $this->arrayResponse = $micuentaClass->setDatosInformacion(
        $nombre,
        $apellido,
        $foto,
        $firma,
        $interfaz,
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