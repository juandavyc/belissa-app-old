<?php session_start();
header('Content-Type: application/json');
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_database.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/php/call_resources.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/clases/agendamiento_canal/agendamiento_canal.class.php';



// cambiar la comprobacion de la sesion para devolver el error
$config = new RecursosApp();
$method = isset($_GET['m']) ? $_GET['m'] . 'agenda' : 'error';

$recursosResponse['session'] = $config->verificarSession('AJAX');
$recursosResponse['token'] = $config->verificarToken(apache_request_headers());
//$recursosResponse['peticion'] = $config->verificarPeticion(isset($_GET['m']) ? $_GET['m'] : 'error');

if (
    $recursosResponse['session']['status'] &&
    $recursosResponse['token']['status']// &&
    //$recursosResponse['peticion']['status']
) {
    $database = new databaseConnection($_SESSION['session_user'][RecursosApp::DATABASE_SESSION_POS]);

    if ($database->estadoConexion()['status']) {
        $agendamientoCanalModelo = new AgendamientoCanalModelo($database->getPDO(), $config);

        $agendamientoCanalModelo->$method();
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

class AgendamientoCanalModelo
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

    public function Createagenda()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/agendamiento/agendamiento.agregar.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }

    public function Listadoagenda()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/agendamiento/agendamiento.listado.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
    public function Infoagenda()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/agendamiento/agendamiento.informacion.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }

    public function Deleteagenda()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/agendamiento/agendamiento.eliminar.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
    public function Updateagenda()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/agendamiento/agendamiento.actualizar.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
    public function Cupoagenda()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/agendamiento/agendamiento.cupo.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }

}