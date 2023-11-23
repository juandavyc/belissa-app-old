<?php
//  var_dump($_POST);

if (

    isset($_POST['status']) &&
    isset($_POST['id_elemento']) &&
    isset($_POST['razon']) &&
    count($_POST) == 3
) {

  
    $_id = htmlspecialchars($_POST['id_elemento']);
    $razon = htmlspecialchars(strtoupper($_POST['razon']));
    $id_usuario = htmlspecialchars($_SESSION['session_user'][1]);
    


        $agenClass = new AgendamientoClass($this->pdo);
        $this->arrayResponse = $agenClass->SetAgen(
        
            encrypt($_id, 2), 
            $razon, 
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
