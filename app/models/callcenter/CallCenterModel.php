<?php session_start();
header('Content-Type: application/json');
require $_SERVER["DOCUMENT_ROOT"] . '/app/config.php';
$app = new MyCallCenterApp();

$recursosResponse['session'] = $app->verificar->isVigenteSession('AJAX');
$recursosResponse['token'] = $app->verificar->isTokenAutorizado(apache_request_headers());
$recursosResponse['peticion'] = $app->verificar->isPeticionAtorizado(isset($_GET['m']) ? $_GET['m'] : 'error');

if (
    $recursosResponse['session']['status'] &&
    $recursosResponse['token']['status'] &&
    $recursosResponse['peticion']['status']
) {
    require $app->ruta->getDatabase();
    $database = new MyDatabase();
    if ($database->getEstado()['status']) {
        $method = isset($_GET['m']) ? $_GET['m'] : 'error';
        $ruta = null;
        switch ($method) {
            case 'VehiculoInformacion':
            case 'VehiculoUpdate':
                $ruta = 'vehiculo/vehiculo';
                break;
            case 'ClienteInformacion':
            case 'ClienteUpdate':
                $ruta = 'cliente/cliente';
                break;
            case 'Listado':
            case 'RtmCreate':
            case 'RtmListado':
            case 'RtmCheck':
                $ruta = 'rtm/rtm';
                break;
            case 'SoatCreate':
            case 'SoatListado':
                $method = str_replace("Soat", "Rtm", $method);
                $ruta = 'soat/soat';
                break;
            case 'NotaListado':
            case 'NotaCreate':
            case 'NotaDelete':
                $ruta = 'nota/nota';
                break;
            case 'IngresoListado':
                $ruta = 'ingreso/ingreso';
                break;
            case 'AgendamientoListado':
                $ruta = 'agendamiento-cda/agendamiento-cda';
                break;
            case 'Detalles':
                $ruta = 'vehiculo/vehiculo';
                break;
        }
        require $app->ruta->getClass($ruta);
        $app->modelo->ejecutarTarea('callcenter', $database->getPDO(), $app, $method);
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
