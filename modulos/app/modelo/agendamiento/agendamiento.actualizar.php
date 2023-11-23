<?php
//var_dump($_POST);

if (

    isset($_POST['status']) &&
    isset($_POST['id_agendamiento']) &&
    isset($_POST['fecha']) &&
    isset($_POST['horario']) &&
    isset($_POST['acepto_responsabilidad']) &&
    count($_POST) == 5
) {

    $id = htmlspecialchars($_POST['id_agendamiento']);
    $fecha = getSpecialDateDatabase($_POST['fecha']);
    $horario = htmlspecialchars($_POST['horario']);
    $id_usuario = htmlspecialchars($_SESSION['session_user'][1]);

    $agenClass = new AgendamientoCanalClass($this->pdo);
    $this->arrayResponse = $agenClass->EditAgendamiento(
        $id,
        $fecha,
        $horario,
        $id_usuario
    );
    $this->pdo = null;

} else if (!isset($_POST['status'])) {

    $json = array('statusCode' => 400, 'status' => false, 'message' => 'No tiene permisos para acceder');
    echo json_encode($json, http_response_code($json["statusCode"]), JSON_FORCE_OBJECT);
} else {

    $json = array('statusCode' => 400, 'status' => false, 'message' => 'Formulario incompleto');
    echo json_encode($json, http_response_code($json["statusCode"]), JSON_FORCE_OBJECT);
}