<?php
//  var_dump($_POST);

if (

    isset($_POST['status']) &&
    isset($_POST['form_id_canal']) &&
    isset($_POST['nombre_canal']) &&
    isset($_POST['editar_tipo_canal']) &&
    isset($_POST['acepto_responsabilidad']) &&
    count($_POST) == 5
) {

  
    $_id = htmlspecialchars($_POST['form_id_canal']);
    $nombre = htmlspecialchars(strtoupper($_POST['nombre_canal']));
    $tipo_canal = htmlspecialchars($_POST['editar_tipo_canal']);
    $id_usuario = htmlspecialchars($_SESSION['session_user'][1]);
    


        $canalClass = new CanalClass($this->pdo);
        $this->arrayResponse = $canalClass->EditCanal(
        
            $_id,  
            $nombre,
            $tipo_canal,
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