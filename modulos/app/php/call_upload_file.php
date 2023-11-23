<?php session_start();
header('Content-Type: application/json');
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';

if (isset($_FILES['file']) &&
    isset($_POST['folder'])) {

    $json_status = 'error';
    $json_message = 'Archivo sin subir';

    include $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/php/call_resources.php';

    $folder = $_POST['folder'];
    $name = htmlspecialchars(time() . '_' . clean_file_name($_FILES['file']['name']));
    $size = $_FILES['file']['size'];
    $src = '/archivos/' . $folder . "/" . $name;

    // var_dump($name);

    try {
        if (move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER["DOCUMENT_ROOT"] . '/archivos/' . $folder . '/' . $name)) {
            $json_status = 'bien';
            $json_message = 'Archivo subido';
        } else {
            throw new Exception('Could not move file');
        }

    } catch (Exception $e) {
        $json_message = 'Imposible subir: ' . $e->getMessage();
    }
    $json_array = array(
        'status' => $json_status,
        'message' => $json_message,
        'src' => $src,
        'name' => $name,
        'size' => $size,
    );

    echo json_encode($json_array, JSON_FORCE_OBJECT);
}