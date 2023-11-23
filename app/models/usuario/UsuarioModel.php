<?php session_start();
header('Content-Type: application/json');
require $_SERVER["DOCUMENT_ROOT"] . '/app/config.php';
$app = new MyCallCenterApp();

$recursosResponse['session'] = $app->verificar->isVigenteSession('AJAX');
$recursosResponse['token'] = $app->verificar->isTokenAutorizado(apache_request_headers());
$recursosResponse['peticion'] = $app->verificar->isPeticionAtorizado(isset($_GET['m']) ? $_GET['m'] : 'error');

if (
    $recursosResponse['token']['status'] &&
    $recursosResponse['session']['status'] &&
    $recursosResponse['peticion']['status']
) {
    require $app->ruta->getDatabase();
    require $app->ruta->getClass('usuario/usuario');
    $database = new MyDatabase();
    if ($database->getEstado()['status']) {        
        $method = isset($_GET['m']) ? $_GET['m'] : 'error';
        $app->modelo->ejecutarTarea('usuario',$database->getPDO(), $app, $method);
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
