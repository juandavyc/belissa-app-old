<?php session_start();
header('Content-Type: application/json');

require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_database.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/php/call_resources.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/clases/autocomplete/class.php';

$config = new RecursosApp();

$recursosResponse['session'] = $config->verificarSession('AJAX');
$recursosResponse['token'] = $config->verificarToken(apache_request_headers());
$recursosResponse['peticion'] = $config->verificarPeticion('Read');

if (
    $recursosResponse['session']['status'] &&
    $recursosResponse['token']['status'] &&
    $recursosResponse['peticion']['status']
) {
    // add status
    $_POST += array('status' => true);

    if (
        isset($_POST["palabra"]) &&
        isset($_POST["table"]) &&
        isset($_POST["index"]) &&
        isset($_POST["value"]) &&
        isset($_POST['status']) &&
        count($_POST) == 5

    ) {
        $database = new databaseConnection($_SESSION['session_user'][RecursosApp::DATABASE_SESSION_POS]);

        if ($database->estadoConexion()['status']) {
            $autocomplete = new AutoCompleteClass($database->getPDO());

            $config->petResponse($autocomplete->ReadFather(
                htmlspecialchars(encrypt($_POST["index"], 2)),
                htmlspecialchars(encrypt($_POST["value"], 2)),
                htmlspecialchars(encrypt($_POST["table"], 2)),
                strtoupper(htmlspecialchars($_POST["palabra"]) . "%")
            ));
            $database->close();
        } else {
            $config->petResponse($database->estadoConexion());
        }
    } else if (!isset($_POST['status'])) {
        $config->petResponse($config->sinPermisosParaAcceder());
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