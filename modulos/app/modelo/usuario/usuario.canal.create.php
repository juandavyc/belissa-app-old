<?php

// var_dump($_POST);

if (
    isset($_POST['form_id_agregar_canal']) &&   
    isset($_POST['agregar_tipo_canal']) &&
    isset($_POST['nombre_canal']) &&
    isset($_POST['acepto_responsabilidad']) &&
    isset($_POST['status']) &&
    count($_POST) == 5
) {

    $id_usuario_asignar = htmlspecialchars($_POST['form_id_agregar_canal']);
    $tipo_canal = htmlspecialchars($_POST['agregar_tipo_canal']);
    $nombre = htmlspecialchars($_POST['nombre_canal']);   
    $id = htmlspecialchars($_SESSION['session_user'][1]);

    $UsuarioClass = new UsuarioClass($this->pdo);
    $this->arrayResponse = $UsuarioClass->CreateCanalUsuario(
        $id_usuario_asignar,
        $tipo_canal,
        $nombre,
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
