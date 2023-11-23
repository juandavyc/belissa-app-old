<?php session_start();
header('Content-Type: application/json');
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';

$config = new RecursosApp();
$recursosResponse['session'] = $config->verificarSession('AJAX');
$recursosResponse['token'] = $config->verificarToken(apache_request_headers());

if (
    $recursosResponse['session']['status'] &&
    $recursosResponse['token']['status']
) {

    if (
        isset($_FILES["video"]) &&
        isset($_POST["placa"]) &&
        count($_FILES) == 1 &&
        count($_POST) == 1
    ) {

        $responseStatus = 'error';
        $responseMessage = 'sin_iniciar_modulo';
        $responseSrc = 'upload_file_src';

        $srcFolder = "/archivos/inspectores";
        $srcFolderDate = date("d-m-Y"); // carpeta por fecha
        $srcPlaca = htmlspecialchars($_POST["placa"]);
        // src final
        $srcFolderComplete = "{$srcFolder}/$srcPlaca/{$srcFolderDate}";

        $idUser = $_SESSION['session_user'][1];
        $srcFileName = $idUser . "_" . time() . ".webm";


        $tempFile = $_FILES['video']['tmp_name'];      

        if (!file_exists(DOCUMENT_ROOT . $srcFolderComplete)) {
            mkdir(DOCUMENT_ROOT . $srcFolderComplete, 0777, true);
        }
        try {
            if (move_uploaded_file($tempFile, $_SERVER["DOCUMENT_ROOT"] . $srcFolderComplete . '/' . $srcFileName)) {
                $responseStatus = 'bien';
                $responseMessage = 'El video se ha subido correctamente';
                $responseSrc = "{$srcFolderComplete}/{$srcFileName}";
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
