<?php
//var_dump($_POST);

if (

    isset($_POST['status']) &&
    isset($_POST['form_id_tipo_gestion']) &&
    isset($_POST['nombre_tipo_gestion']) &&
    isset($_POST['acepto_responsabilidad']) &&
    count($_POST) == 4
) {

  
    $_id = htmlspecialchars($_POST['form_id_tipo_gestion']);
    $nombre = htmlspecialchars(strtoupper($_POST['nombre_tipo_gestion']));
    $id_usuario = htmlspecialchars($_SESSION['session_user'][1]);
    


        $tipogestionClass = new TipoGestionClass($this->pdo);
        $this->arrayResponse = $tipogestionClass->EditTipoGestion(
        
            $_id,  
            $nombre,
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