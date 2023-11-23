<?php
// var_dump($_POST);

if (

    isset($_POST['status']) &&
    isset($_POST['id']) &&
    count($_POST) == 2
) {

  
    $_id = htmlspecialchars($_POST['id']);
 
    


        $editarusuarioClass = new EditarUsuarioClass($this->pdo);
        $this->arrayResponse = $editarusuarioClass->getEditarUsuario(
        
            encrypt($_id, 2)         
            
        );
        $this->pdo = null;
    
} else if (!isset($_POST['status'])) {

    $json = array('statusCode' => 400, 'status' => false, 'message' => 'No tiene permisos para acceder');
    echo json_encode($json, http_response_code($json["statusCode"]), JSON_FORCE_OBJECT);
} else {

    $json = array('statusCode' => 400, 'status' => false, 'message' => 'Formulario incompleto');
    echo json_encode($json, http_response_code($json["statusCode"]), JSON_FORCE_OBJECT);
}