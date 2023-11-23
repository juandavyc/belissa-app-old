<?php session_start();
header('Content-Type: application/json');
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_database.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/php/call_resources.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/clases/tarifa/tarifa.class.php';
// cambiar la comprobacion de la sesion para devolver el error
// var_dump($method);
$config = new RecursosApp();
$method = isset($_GET['m']) ? $_GET['m'] . 'tarifa' : 'error';


$recursosResponse['session'] = $config->verificarSession('AJAX');
$recursosResponse['token'] = $config->verificarToken(apache_request_headers());
$recursosResponse['peticion'] = $config->verificarPeticion(isset($_GET['m']) ? $_GET['m'] : 'error');

if (
    $recursosResponse['session']['status'] &&
    $recursosResponse['token']['status'] &&
    $recursosResponse['peticion']['status']
) {
    $database = new databaseConnection($_SESSION['session_user'][6]);

    if ($database->estadoConexion()['status']) {

        $tarifaModelo = new TarifaModelo($database->getPDO(), $config);
        // var_dump($method);
        $tarifaModelo->$method();
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

class TarifaModelo
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

    public function Createtarifa()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/tarifa/tarifa.create.php';
        
        $this->configuracion->petResponse($this->arrayResponse);
    }

    public function Listadotarifa()
    {

        require_once DOCUMENT_ROOT . '/modulos/app/modelo/tarifa/tarifa.listado.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }

    public function Deletetarifa()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/tarifa/tarifa.eliminar.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }

    public function Infotarifa()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/tarifa/tarifa.informacion.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }

    public function Updatetarifa()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/tarifa/tarifa.actualizar.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
    
    public function Tabtarifa()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/tarifa/tarifa.tabla.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
   
}