<?php

if ( 
    isset($_POST['status']) &&
    count($_POST) == 1
) {

    $json_status = "error";
    $json_title = array();
    $json_head = array();
    $json_message = array();
    $json_pagination = array();
    
   

    
    $canalClass = new CanalClass($this->pdo);
    $this->arrayResponse = $canalClass->getBuscadorTipoCanal();


    if ($this->arrayResponse['statusText'] == 'bien' && $this->arrayResponse['statusCode'] == 200) {

        $json_status = "bien";
        $json_message = $this->arrayResponse['message'];
         
    } else {
        $json_status = $this->arrayResponse['status'];
        $json_message = $this->arrayResponse['message'];
    }

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