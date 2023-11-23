<?php
// var_dump($_POST);
if (
    isset($_POST['id']) &&
    isset($_POST['status']) &&
    count($_POST) == 2
) {

    $id_archivo = htmlspecialchars($_POST['id']);
    

    $archivoClass = new ArchivoClass($this->pdo);
    $this->arrayResponse = $archivoClass->LinkArchivo(
        
        encrypt($id_archivo, 2)   
       
    );
    $this->pdo = null;


        


    

} else if (!isset($_POST['status'])) {

    $json = array('statusCode' => 400, 'status' => false, 'message' => 'No tiene permisos para acceder');
    echo json_encode($json, http_response_code($json["statusCode"]), JSON_FORCE_OBJECT);
} else {

    $json = array('statusCode' => 400, 'status' => false, 'message' => 'Formulario incompleto');
    echo json_encode($json, http_response_code($json["statusCode"]), JSON_FORCE_OBJECT);
}



  


