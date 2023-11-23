<?php
// var_dump($_FILES);
// print_r($_FILES);
if (

    isset($_POST['status']) &&
    isset($_POST['tipo_archivo']) &&
    isset($_POST['acepto_responsabilidad']) &&
    count($_POST) == 3
) {

  

    $archivo = "";
    $folder = "";

    $ruta = $_SERVER["DOCUMENT_ROOT"] . '/archivos/';

    if ($_FILES["archivos"]["name"]["foto"] >= 0) {
        $folder = "/uploads/foto/";
    } else if ($_FILES["archivos"]["name"]["video"] >= 0) {
        $folder = "/uploads/video/";
    } else if ($_FILES["archivos"]["name"]["pdf"] >= 0) {
        $folder = "/uploads/pdf/";
    } else if ($_FILES["archivos"]["name"]["excel"] >= 0) {
        $folder = "/uploads/excel/";
    } else if ($_FILES["archivos"]["name"]["documento"] >= 0) {
        $folder = "/uploads/documento/";
    } else {
        $folder = "paila";
    }

    $carpeta_diaria = date('d-m-Y');

    $micarpeta = $ruta . $folder . $carpeta_diaria;
    if (!file_exists($micarpeta)) {
        mkdir($micarpeta, 0777, true);
    }


    foreach ($_FILES["archivos"]["error"] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["archivos"]["tmp_name"][$key];
            $name = basename($_FILES["archivos"]["name"][$key]);
            move_uploaded_file($tmp_name, $micarpeta . '/' . $name);
        }
    }


    $archivo = '/archivos' . $folder . $carpeta_diaria . '/' . $name;
    $tamano = filesize($_SERVER["DOCUMENT_ROOT"] . $archivo);

    function contar_bytes($bytes, $decimals = 2)
    {
        $factor = floor((strlen($bytes) - 1) / 3);
        if ($factor > 0) $sz = 'KMGT';
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor - 1] . 'B';
    }

    $tipo_archivo = htmlspecialchars($_POST['tipo_archivo']);
    $id_usuario = htmlspecialchars($_SESSION['session_user'][1]);


        $archivoClass = new ArchivoClass($this->pdo);
        $this->arrayResponse = $archivoClass->CreateArchivo(
            array(
                'TIPO_ARCHIVO' => $tipo_archivo,
                'ARCHIVO' => $archivo,
                'USUARIO' => $id_usuario,
                'NOMBRE_ARCHIVO' => $name,
                'TAMANO_ARCHIVO' => contar_bytes($tamano, 0)
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
