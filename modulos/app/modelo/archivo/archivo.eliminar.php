<?php
// var_dump($_POST);
if (
    isset($_POST['id_elemento']) &&
    isset($_POST['razon']) &&
    isset($_POST['status']) &&
    count($_POST) == 3
) {

    $id_archivo = htmlspecialchars($_POST['id_elemento']);
    $id_usuario = htmlspecialchars($_SESSION['session_user'][1]);
    

    $archivoClass = new ArchivoClass($this->pdo);
    $this->arrayResponse = $archivoClass->EliminarArchivo(
        
        encrypt($id_archivo, 2) ,
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



  


