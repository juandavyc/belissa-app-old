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
        isset($_POST["image_base64"]) &&
        isset($_POST['image_folder']) &&
        isset($_POST['image_rotate']) &&
        count($_POST) == 3
    ) {

        $responseStatus = 'error';
        $responseStatus = 'sin_iniciar_modulo';
        $responseSrc = 'upload_image_src';

        $srcImage = $_POST['image_base64'];
        $srcFolder = htmlspecialchars($_POST['image_folder']);
        $idUser = $_SESSION['session_user'][1];

        $rotateNumber = htmlspecialchars($_POST['image_rotate']);

        $srcFolderDate = date("d-m-Y");
        $srcImage = str_replace('data:image/png;base64,', '', $srcImage);
        $srcImage = str_replace(' ', '+', $srcImage);
        $srcName = $idUser . "_" . time();

        $source = imagecreatefromstring(base64_decode($srcImage));
        $rotate = imagerotate($source, $rotateNumber, 0);

        if (!file_exists(DOCUMENT_ROOT . '/archivos/' . $srcFolder . '/' . $srcFolderDate)) {
            mkdir(DOCUMENT_ROOT . '/archivos/' . $srcFolder . '/' . $srcFolderDate, 0777, true);
        }
        $uploadSuccess = imagepng($rotate, DOCUMENT_ROOT . '/archivos/' . $srcFolder . '/' . $srcFolderDate . '/' . $srcName . '.png');

        if ($uploadSuccess) {
            $responseStatus = 'bien';
            $responseMessage = 'Imagen guardada';
            $responseSrc = '/archivos/' . $srcFolder . '/' . $srcFolderDate . '/' . $srcName . '.png';
            imagedestroy($source);
        } else {
            $responseStatus = 'error';
            $responseMessage = 'No se pudo guardar la imagen';
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
