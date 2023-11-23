<?php session_start();
header('Content-Type: application/json');
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_database.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/php/call_resources.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/clases/novedades/class.php';
// cambiar la comprobacion de la sesion para devolver el error
$config = new RecursosApp();
$method = isset($_GET['m']) ? $_GET['m'] . 'novedad' : 'error';

$recursosResponse['session'] = $config->verificarSession('AJAX');
$recursosResponse['token'] = $config->verificarToken(apache_request_headers());
$recursosResponse['peticion'] = $config->verificarPeticion(isset($_GET['m']) ? $_GET['m'] : 'error');

if (
    $recursosResponse['session']['status'] &&
    $recursosResponse['token']['status'] &&
    $recursosResponse['peticion']['status']
) {
    $database = new databaseConnection($_SESSION['session_user'][RecursosApp::DATABASE_SESSION_POS]);

    if ($database->estadoConexion()['status']) {

        $novedadModelo = new NovedadModelo($database->getPDO(), $config);

        $novedadModelo->$method();
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

class NovedadModelo
{

    private $configuracion = null;
    private $arrayResponse = array();
    private $pdo = null;
    private $statusClass = false;

    public function __construct($_pdo = null, $_config = null)
    {
        $this->statusClass = true;
        //db
        $this->pdo = $_pdo;
        // instancia de recursos
        $this->configuracion = $_config;
        $_POST += array('status' => true);
    }

    public function Readnovedad()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/novedades/novedad.read.php';

        $this->configuracion->petResponse($this->arrayResponse);
    }
    public function Updatenovedad()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/novedades/novedad.update.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
}