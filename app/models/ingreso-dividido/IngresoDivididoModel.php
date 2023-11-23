<?php session_start();
header('Content-Type: application/json');
require $_SERVER["DOCUMENT_ROOT"] . '/app/config.php';
$app = new MyCallCenterApp();

$method = isset($_GET['m']) ? $_GET['m'] : 'error';
$recursosResponse['session'] = $app->verificar->isVigenteSession('AJAX');
$recursosResponse['token'] = $app->verificar->isTokenAutorizado(apache_request_headers());
$recursosResponse['peticion'] = $app->verificar->isPeticionAtorizado($method);

if (
    $recursosResponse['session']['status'] &&
    $recursosResponse['token']['status'] &&
    $recursosResponse['peticion']['status']
) {

    require $app->ruta->getDatabase();
    $database = new MyDatabase();

    if ($database->getEstado()['status']) {

        $ruta = null;
        switch ($method) {
            case 'VehiculoInformacion':
                require $app->ruta->getClass('vehiculo/vehiculo');
                break;
            case 'VehiculoUpdate':
                require $app->ruta->getClass('ingreso-dividido/ingreso.dividido');
                break;
            case 'Create':
                require $app->ruta->getClass('ingreso/ingreso');
                break;
        }
        $app->modelo->ejecutarTarea('ingreso-dividido', $database->getPDO(), $app, $method);
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
