<?php
//var_dump($_POST);

if (
    isset($_POST['status']) &&
    count($_POST) == 1
) {

    $response = array(
        'cupo' => array(),
        'listado' => array(),
    );

    $agendamiento = new AgendamientoClass($this->pdo);
    $response['cupo'] = $agendamiento->getCupos();
    if ($response['cupo']['statusText'] == 'bien') {
        $response['listado'] = $agendamiento->getCupoUsados();
    }

    $this->arrayResponse = $response;
    $this->pdo = null;

} else if (!isset($_POST['status'])) {

    $json = array('statusCode' => 400, 'status' => false, 'message' => 'No tiene permisos para acceder');
    echo json_encode($json, http_response_code($json["statusCode"]), JSON_FORCE_OBJECT);
} else {

    $json = array('statusCode' => 400, 'status' => false, 'message' => 'Formulario incompleto');
    echo json_encode($json, http_response_code($json["statusCode"]), JSON_FORCE_OBJECT);
}