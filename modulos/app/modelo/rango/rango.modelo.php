<?php session_start();
header('Content-Type: application/json');
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_database.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/php/call_resources.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/clases/rango/rango.class.php';
// cambiar la comprobacion de la sesion para devolver el error
$config = new RecursosApp();
$method = isset($_GET['m']) ? $_GET['m'] . 'rango' : 'error';

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

        $rangoModelo = new RangoModelo($database->getPDO(), $config);
        // var_dump($method);
        $rangoModelo->$method();
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

class RangoModelo
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

    public function Createrango()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/rango/rango.create.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }

    public function Listadorango()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/rango/rango.listado.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }

    public function Inforango()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/rango/rango.informacion.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
    public function Updaterango()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/rango/rango.update.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
}