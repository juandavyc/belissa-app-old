<?php

if (
    isset($_POST['id']) &&
    isset($_POST['status']) &&
    count($_POST) == 2
) {

    $reportes = new BelissaLogClass($this->pdo, $this->configuracion);
    // datos de sesion y token para comprobaciones

    $id = encrypt($_POST['id'],2);

    $this->arrayResponse = $reportes->infoBelissa(
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
