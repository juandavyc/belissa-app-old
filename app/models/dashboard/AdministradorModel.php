<?php session_start();
header('Content-Type: application/json');
require $_SERVER["DOCUMENT_ROOT"] . '/app/config.php';
$app = new MyCallCenterApp();



//require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/clases/dashboard/dashboard.class.php';

$recursosResponse['session'] = $app->verificar->isVigenteSession('AJAX');
$recursosResponse['token'] = $app->verificar->isTokenAutorizado(apache_request_headers());

if (
    $recursosResponse['session']['status'] &&
    $recursosResponse['token']['status']
) {

    require $app->ruta->getDatabase();
    require $app->ruta->getClass('dashboard/dashboard');

    $database = new MyDatabase(); 

    if ($database->getEstado()['status']) {

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
        $app->mensaje->petResponse(
            array(
                'statusCode' => 200,
                'statusText' => 'bien',
                'elementos' => $arrayResponse,
            )
        );
    } else {
        $app->mensaje->petResponse($database->getEstado());
    }
} else {
    foreach ($recursosResponse as $clave => $valor) {
        if ($valor['status'] == false) {
            $app->mensaje->petResponse($valor);
            break;
        }
    }
}
