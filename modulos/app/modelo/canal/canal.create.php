<?php
// var_dump($_POST);

if (

    isset($_POST['status']) &&
    isset($_POST['tipo_canal']) &&
    isset($_POST['nombre_canal']) &&
    isset($_POST['acepto_responsabilidad']) &&
    count($_POST) == 4
) {

  
    $tipo_canal = htmlspecialchars($_POST['tipo_canal']);
    $nombre_canal = htmlspecialchars(strtoupper($_POST['nombre_canal']));
    $id_usuario = htmlspecialchars($_SESSION['session_user'][1]);


        $canalClass = new CanalClass($this->pdo);
        $this->arrayResponse = $canalClass->CreateCanal(
            array(
                'TIPO_CANAL' => $tipo_canal,
                'NOMBRE_CANAL' => $nombre_canal,
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
