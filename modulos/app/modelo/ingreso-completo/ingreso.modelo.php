<?php session_start();
header('Content-Type: application/json');
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_database.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/php/call_resources.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/clases/ingreso/ingreso.class.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/clases/vehiculo/vehiculo.class.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/clases/cliente/cliente.class.php';

// cambiar la comprobacion de la sesion para devolver el error
$config = new RecursosApp();
$method = isset($_GET['m']) ? $_GET['m'] . 'ingreso' : 'error';

$recursosResponse['session'] = $config->verificarSession('AJAX');
$recursosResponse['token'] = $config->verificarToken(apache_request_headers());
// $recursosResponse['peticion'] = $config->verificarPeticion(isset($_GET['m']) ? $_GET['m'] : 'error');

if (
    $recursosResponse['session']['status'] &&
    $recursosResponse['token']['status']
) {
    $database = new databaseConnection($_SESSION['session_user'][RecursosApp::DATABASE_SESSION_POS]);

    if ($database->estadoConexion()['status']) {

        $ingresoModelo = new IngresoModelo($database->getPDO(), $config);
        // var_dump($method);
        $ingresoModelo->$method();
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

class IngresoModelo
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

    public function Agregaringreso()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/ingreso-completo/ingreso.agregar.php';
        if (!empty($this->arrayResponse)) {
            $this->configuracion->petResponse($this->arrayResponse);
        }
    }

    public function ConsultarVehiculoingreso()
    {

        require_once DOCUMENT_ROOT . '/modulos/app/modelo/ingreso-completo/ingreso.listado.php';
        if (!empty($this->arrayResponse)) {
            $this->configuracion->petResponse($this->arrayResponse);
        }
    }
    public function EditarDatosingreso()
    {

        require_once DOCUMENT_ROOT . '/modulos/app/modelo/ingreso-completo/ingreso.editar.php';
        if (!empty($this->arrayResponse)) {
            $this->configuracion->petResponse($this->arrayResponse);
        }
    }

    public function getDataingreso()
    {

        require_once DOCUMENT_ROOT . '/modulos/app/modelo/ingreso_rtm/ingreso.getdata.php';
        if (!empty($this->arrayResponse)) {
            $this->configuracion->petResponse($this->arrayResponse);
        }
    }
}