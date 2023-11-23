<?php session_start();
header('Content-Type: application/json');
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_database.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/php/call_resources.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/clases/belissa/belissa.class.php';

$config = new RecursosApp();
$method = isset($_GET['m']) ? $_GET['m'] . 'Reporte' : 'error';

$recursosResponse['session'] = $config->verificarSession('AJAX');
$recursosResponse['token'] = $config->verificarToken(apache_request_headers());
if (
    $recursosResponse['session']['status'] &&
    $recursosResponse['token']['status']
) {
    $database = new databaseConnection($_SESSION['session_user'][RecursosApp::DATABASE_SESSION_POS]);

    if ($database->estadoConexion()['status']) {

        $mensajeModelo = new MensajeModelo($database->getPDO(), $config);
        $mensajeModelo->$method();
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

class MensajeModelo
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

    public function ListadoReporte()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/visor-reportes/visor.listado.php';
        if (!empty($this->arrayResponse)) {
            $this->configuracion->petResponse($this->arrayResponse);
        }
    }
    public function InfoReporte()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/visor-reportes/visor.info.php';
        if (!empty($this->arrayResponse)) {
            $this->configuracion->petResponse($this->arrayResponse);
        }
    }

}
