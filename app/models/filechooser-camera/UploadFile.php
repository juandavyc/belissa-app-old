<?php session_start();
header('Content-Type: application/json');
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';

$config = new RecursosApp();
$recursosResponse['session'] = $config->verificarSession('AJAX');
$recursosResponse['token'] = $config->verificarToken(apache_request_headers());
$recursosResponse['camera'] = array();

if (
    $recursosResponse['session']['status'] &&
    $recursosResponse['token']['status']
) {

    if (
        isset($_FILES["file"]) &&
        isset($_POST['folder']) &&
        count($_FILES) == 1 &&
        count($_POST) == 1
    ) {


        $responseStatus = 'error';
        $responseStatus = 'sin_iniciar_modulo';
        $responseSrc = 'upload_file_src';

        $srcFolder = htmlspecialchars($_POST['folder']);
        $idUser = $_SESSION['session_user'][1];
        $srcFolderDate = date("d-m-Y");
        $srcName = $idUser . "_" . time();

        $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
       
        if (!file_exists(DOCUMENT_ROOT . '/archivos/' . $srcFolder . '/' . $srcFolderDate)) {
            mkdir(DOCUMENT_ROOT . '/archivos/' . $srcFolder . '/' . $srcFolderDate, 0777, true);
        }

        try {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER["DOCUMENT_ROOT"] . '/archivos/' . $srcFolder . '/' . $srcFolderDate . '/' . $srcName.'.'.$extension)) {
                $responseStatus = 'bien';
                $responseMessage = 'Archivo subido';
                $responseSrc = '/archivos/' . $srcFolder . '/' . $srcFolderDate . '/' . $srcName.'.'.$extension;
            } else {
                $responseStatus = 'error';
                $responseMessage = 'Archivo NO subido';
            }
        } catch (Exception $e) {
            $responseMessage = 'Imposible subir: ' . $e->getMessage();
        }

        $json_array = array(
            'statusText' => $responseStatus,
            'message' => $responseMessage,
            'src' => $responseSrc,
        );
        echo json_encode($json_array, JSON_FORCE_OBJECT);
        exit;
    } else {
        $config->petResponse($config->formularioIncompleto());
    }
} else {
    foreach ($recursosResponse as $clave => $valor) {
        if ($valor['status'] == false) {
            $config->petResponse($valor);
            break;
        }
    }
}
