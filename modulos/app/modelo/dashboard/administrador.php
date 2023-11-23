<?php session_start();
header('Content-Type: application/json');
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_database.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/php/call_resources.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/clases/dashboard/dashboard.class.php';
// cambiar la comprobacion de la sesion para devolver el error
$config = new RecursosApp();

$recursosResponse['session'] = $config->verificarSession('AJAX');
$recursosResponse['token'] = $config->verificarToken(apache_request_headers());

if (
    $recursosResponse['session']['status'] &&
    $recursosResponse['token']['status']
) {
    $database = new databaseConnection($_SESSION['session_user'][RecursosApp::DATABASE_SESSION_POS]);

    if ($database->estadoConexion()['status']) {

        $arrayDefaultResponse = array(
            'statusText' => 'error',
            'message' => 'sin iniciar',
        );
        $arrayResponse = array(
            'mes' => array(
                'actual' => $arrayDefaultResponse,
                'anterior' => $arrayDefaultResponse,
            ),
            'ocho' => $arrayDefaultResponse,
        );

        $dashboard = new DashboardClass($database->getPDO());

        $arrayResponse['mes']['actual'] = $dashboard->getDatosMes('ACTUAL');
        $arrayResponse['mes']['anterior'] = $dashboard->getDatosMes('ANTERIOR');
        $arrayResponse['ocho'] = $dashboard->getDatosOchoDias();

        $config->petResponse(
            array(
                'statusCode' => 200,
                'statusText' => 'bien',
                'elementos' => $arrayResponse,
            )
        );

    } else {
        $config->petResponse($database->estadoConexion());
    }
} else {
    foreach ($recursosResponse as $clave => $valor) {
        if ($valor['status'] == false) {
            $config->petResponse($valor);
            break;
        }
    }
}