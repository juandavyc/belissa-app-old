<?php
// var_dump($_POST);

if (

    isset($_POST['status']) &&
    isset($_POST['form_id_tarifa']) &&
    isset($_POST['tipo_vehiculo']) &&
    isset($_POST['desde']) &&
    isset($_POST['hasta']) &&
    isset($_POST['precio']) &&
    isset($_POST['acepto_responsabilidad']) &&
    count($_POST) == 7
) {

  
    $_id = htmlspecialchars($_POST['form_id_tarifa']);
    $tipo_vehiculo = htmlspecialchars($_POST['tipo_vehiculo']);
    $desde = htmlspecialchars($_POST['desde']);
    $hasta = htmlspecialchars($_POST['hasta']);
    $precio = htmlspecialchars($_POST['precio']);
    $id_usuario = htmlspecialchars($_SESSION['session_user'][1]);
    


        $tarifaClass = new TarifaClass($this->pdo);
        $this->arrayResponse = $tarifaClass->EditTarifa(
        
            $_id,  
            $desde,
            $hasta,
            $precio,
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