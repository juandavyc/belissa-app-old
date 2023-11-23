<?php

if (

    isset($_POST['titulo']) &&
    isset($_POST['mensaje']) &&
    isset($_POST['acepto_responsabilidad']) &&
    isset($_POST['status']) &&
    count($_POST) == 4
) {


    $titulo = htmlspecialchars($_POST['titulo']);
    $mensaje = htmlspecialchars($_POST['mensaje']);
    $id_usuario = $_SESSION['session_user'][1];


    $Mensajes = new MensajeClass($this->pdo);
    $this->arrayResponse = $Mensajes->CreateMensaje(
        array(
            'TITULO' => $titulo,
            'MENSAJE' => $mensaje,
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
