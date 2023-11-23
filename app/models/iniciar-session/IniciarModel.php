<?php session_start();
header('Content-Type: application/json');
require $_SERVER["DOCUMENT_ROOT"] . '/app/config.php';
$app = new MyCallCenterApp();

$recursosResponse['csrf-token'] = $app->verificar->isTokenAutorizado(apache_request_headers());
$recursosResponse['database'] = array();
$recursosResponse['modulo'] = array();
$recursosResponse['sql'] = array();

if ($recursosResponse['csrf-token']['status'] === true) {

    if (
        isset($_POST['usuario']) &&
        isset($_POST['contrasenia']) &&
        count($_POST) == 2
    ) {

        require $app->ruta->getDatabase();
        require $app->ruta->getClass('iniciar-session/iniciar');

        // respuestas del servidor
        $responseStatus = 'error';
        $responseMessage = 'sin iniciar';

        $database = new MyDatabase(); 

        $recursosResponse['database'] = $database->getEstado();

        if ($recursosResponse['database']['status'] === true) {
             
            $iniciar = new IniciarSesion($database->getPDO());
            $recursosResponse['sql'] = $iniciar->inicioTradicional(
                htmlspecialchars($_POST['usuario']),
                htmlspecialchars($_POST['contrasenia'])
            );

            if ($recursosResponse['sql']['status'] === true) {
                $recursosResponse['modulo'] = $recursosResponse['sql'];

                $_SESSION['session_user'] = $recursosResponse['sql']['message'];
                $_SESSION['user_status'] = array(
                    "timepo_activo" => time(),
                );             
                $recursosResponse['modulo']['message'] = '/web/';
                
            } else {
                $recursosResponse['modulo'] = $recursosResponse['sql'];
            }

            $database->close();
        } else {
            $recursosResponse['modulo'] = $recursosResponse['database'];
        }

        echo json_encode($recursosResponse['modulo'], JSON_FORCE_OBJECT);
        exit;
    } else {
        echo json_encode($app->mensaje->getFormularioIcompleto(), JSON_FORCE_OBJECT);
        exit;
    }
} else {
    echo json_encode($recursosResponse['csrf-token'], JSON_FORCE_OBJECT);
    exit;
}