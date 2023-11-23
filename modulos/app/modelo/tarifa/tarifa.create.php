<?php
// var_dump($_POST);

if (

    isset($_POST['status']) &&
    isset($_POST['nombre_tarifa']) &&
    isset($_POST['acepto_responsabilidad']) &&
    count($_POST) == 3
) {

    $nombre_tarifa = htmlspecialchars(strtoupper($_POST['nombre_tarifa']));
    $id_usuario = htmlspecialchars($_SESSION['session_user'][1]);

    $tarifaClass = new TarifaClass($this->pdo);
    $this->arrayResponse = $tarifaClass->CreateTarifa(
        array(
            'NOMBRE_TARIFA' => $nombre_tarifa,
            'USUARIO' => $id_usuario,

        )
    );
    $this->pdo = null;

} else if (!isset($_POST['status'])) {

    $json = array('statusCode' => 400, 'status' => false, 'message' => 'No tiene permisos para acceder');
    echo json_encode($json, http_response_code($json["statusCode"]), JSON_FORCE_OBJECT);
} else {

    $json = array('statusCode' => 400, 'status' => false, 'message' => 'Formulario incompleto');
    echo json_encode($json, http_response_code($json["statusCode"]), JSON_FORCE_OBJECT);
}