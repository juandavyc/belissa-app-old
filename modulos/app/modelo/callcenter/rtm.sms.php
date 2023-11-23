<?php

if (
    isset($_POST['numero']) &&
    isset($_POST['mensaje']) &&
    isset($_POST['acepto_terminos_condiciones']) &&
    isset($_POST['status']) &&
    count($_POST) == 4
) {

    $apiSms = new ApiSmsClass($this->pdo, $this->configuracion);
    // datos de sesion y token para comprobaciones

    $this->arrayResponse = $apiSms->SendMessage(
        $_POST
    );


    // foreach ($_POST['numero'] as $key => $value) {
    // }

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
