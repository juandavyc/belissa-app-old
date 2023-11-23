<?php
//var_dump($_POST);

if (
    isset($_POST['moto']) &&
    isset($_POST['liviano']) &&
    isset($_POST['acepto_terminos_condiciones']) &&
    isset($_POST['status']) &&
    count($_POST) == 4
) {

    $response = array(
        'liviano' => array(),
        'moto' => array(),
    );

    $agendamiento = new AgendamientoClass($this->pdo);
    $response['liviano'] = $agendamiento->setCupos(
        1,
        htmlspecialchars($_POST['liviano']),
        $_SESSION['session_user'][1]
    );
    $response['moto'] = $agendamiento->setCupos(
        2,
        htmlspecialchars($_POST['moto']),
        $_SESSION['session_user'][1]
    );

    $this->arrayResponse = $response;

    $this->pdo = null;

} else if (!isset($_POST['status'])) {

    $json = array('statusCode' => 400, 'status' => false, 'message' => 'No tiene permisos para acceder');
    echo json_encode($json, http_response_code($json["statusCode"]), JSON_FORCE_OBJECT);
} else {

    $json = array('statusCode' => 400, 'status' => false, 'message' => 'Formulario incompleto');
    echo json_encode($json, http_response_code($json["statusCode"]), JSON_FORCE_OBJECT);
}