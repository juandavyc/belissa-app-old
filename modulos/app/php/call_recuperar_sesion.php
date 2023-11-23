<?php session_start();
header('Content-Type: application/json');

require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';

$headers = apache_request_headers();
$recursosApp = new RecursosApp();

$recursosResponse['csrf-token'] = $recursosApp->verificarToken($headers);
$recursosResponse['database'] = array();
$recursosResponse['modulo'] = array();
$recursosResponse['sql'] = array();

if ($recursosResponse['csrf-token']['status'] === true) {

    if (
        isset($_POST['usuario']) &&
        isset($_POST['contrasenia']) &&
        count($_POST) == 2
    ) {
        // clase
        require DOCUMENT_ROOT . '/assets/php/call_database.php';
        require DOCUMENT_ROOT . "/assets/clases/iniciar_sesion/read.php";
        // respuestas del servidor
        $responseStatus = 'error';
        $responseMessage = 'sin iniciar';

        //CONECTA A LO WASABRO A LA BASE DE DATOS Y TRAE EL ROL DEL PERSONAJE
        /* $database = new databaseConnection('invitado');
        $recursosResponse['database'] = $database->estadoConexion();
        if ($recursosResponse['database']['status'] === true) {
        $databasePDO = $database->getPDO();
        $iniciar = new IniciarSesion($databasePDO);
        $recursosResponse['sql'] = $iniciar->comprobarSesion(
        htmlspecialchars($_POST['usuario']),
        htmlspecialchars($_POST['contrasenia'])
        );
        $database->close();
        } else {
        $recursosResponse['modulo'] = $recursosResponse['database'];
        }

        $rol = $recursosResponse['sql']["message"][4];*/

        //SE LE SAMPA EL ROL QUE VIENE DE LA CONSULTA WASABRA PARA QUE CONECTE A UN USUARIO DEPENDIENDO EL ROL
        //$database = new databaseConnection($rol);

        $database = new databaseConnection('TIPO_LOGIN'); // R de leer

        // respuestas de la base de datos
        $recursosResponse['database'] = $database->estadoConexion();

        if ($recursosResponse['database']['status'] === true) {
            $databasePDO = $database->getPDO();

            $iniciar = new IniciarSesion($databasePDO);

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
                // ruta privada
                $recursosResponse['modulo']['message'] = '/modulos/';
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
        echo json_encode($recursosApp->formularioIncompleto(), JSON_FORCE_OBJECT);
        exit;
    }
} else {
    echo json_encode($recursosResponse['csrf-token'], JSON_FORCE_OBJECT);
    exit;
}