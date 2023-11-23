<?php

// var_dump($_POST);
if (

    isset($_POST['id']) &&
    isset($_POST['status']) &&
    count($_POST) == 2
) {


    $id = htmlspecialchars($_POST['id']);
    $id_usuario = $_SESSION['session_user'][1];


    $Mensajes = new MensajeClass($this->pdo);
    $this->arrayResponse = $Mensajes->GetMensaje(
        array(
            'ID' => $id,
            'USUARIO' => $id_usuario,
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
