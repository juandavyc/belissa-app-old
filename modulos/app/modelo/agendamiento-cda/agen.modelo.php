<?php session_start();
header('Content-Type: application/json');
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_database.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/php/call_resources.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/clases/agendamiento/agendamiento.class.php';

// require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/clases/vehiculo/vehiculo.class.php';
// require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/clases/cliente/cliente.class.php';

/*
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/clases/rtm/rtm.class.php';

require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/clases/nota/nota.class.php';
 */
// cambiar la comprobacion de la sesion para devolver el error
$config = new RecursosApp();
$method = isset($_GET['m']) ? $_GET['m'] . 'agen' : 'error';

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
        $rtmModelo = new RtmModelo($database->getPDO(), $config);

        $rtmModelo->$method();
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

class RtmModelo
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

    public function Createagen()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/agendamiento-cda/agen.agregar.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }

    public function Listadoagen()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/agendamiento-cda/agen.listado.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
    public function Infoagen()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/agendamiento-cda/agen.informacion.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
    public function Vehiculoagen()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/agendamiento-cda/agen.vehiculo.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }

    public function Deleteagen()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/agendamiento-cda/agen.eliminar.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
    public function Updateagen()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/agendamiento-cda/agen.actualizar.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
    public function Cupoagen()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/agendamiento-cda/agen.cupo.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
    public function CupoEditagen()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/agendamiento-cda/agen.cupo.actualizar.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }

}