<?php session_start();
header('Content-Type: application/json');
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_database.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/php/call_resources.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/clases/tipo_gestion/tipo_gestion.class.php';
// cambiar la comprobacion de la sesion para devolver el error
// var_dump($method);
$config = new RecursosApp();
$method = isset($_GET['m']) ? $_GET['m'] . 'tipogestion' : 'error';


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

        $tipogestionModelo = new TipoGestionModelo($database->getPDO(), $config);
        // var_dump($method);
        $tipogestionModelo->$method();
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

class TipoGestionModelo
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

    public function Createtipogestion()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/tipo_gestion/tipo_gestion.create.php';
        
        $this->configuracion->petResponse($this->arrayResponse);
    }

    public function Listadotipogestion()
    {

        require_once DOCUMENT_ROOT . '/modulos/app/modelo/tipo_gestion/tipo_gestion.listado.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }

    public function Deletetipogestion()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/tipo_gestion/tipo_gestion.eliminar.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }

    public function Infotipogestion()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/tipo_gestion/tipo_gestion.informacion.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }

    public function Updatetipogestion()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/tipo_gestion/tipo_gestion.actualizar.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
    
    public function Tabtipogestion()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/tipo_gestion/tipo_gestion.tabla.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
   
}