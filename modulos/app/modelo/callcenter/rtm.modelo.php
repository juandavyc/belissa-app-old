<?php session_start();
header('Content-Type: application/json');
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_database.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/php/call_resources.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/clases/rtm/rtm.class.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/clases/soat/soat.class.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/clases/vehiculo/vehiculo.class.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/clases/cliente/cliente.class.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/clases/nota/nota.class.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/clases/ingreso/ingreso.class.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/clases/agendamiento/agendamiento.class.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/modelo/api-sms/api.sms.modelo.php';

// cambiar la comprobacion de la sesion para devolver el error
$config = new RecursosApp();
$method = isset($_GET['m']) ? $_GET['m'] . 'rtm' : 'error';

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

    public function Listadortm()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/callcenter/rtm.listado.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
    public function Detallesrtm()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/callcenter/rtm.detalles.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
    public function RtmHistorialrtm()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/callcenter/rtm.historial.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
    public function RtmAgregarrtm()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/callcenter/rtm.agregar.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }

    public function ClienteInfortm()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/callcenter/rtm.cliente.info.php';
        if (!empty($this->arrayResponse)) {
            $this->configuracion->petResponse($this->arrayResponse);
        }
    }
    public function ClienteUpdatertm()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/callcenter/rtm.cliente.update.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
    public function VehiculoInfortm()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/callcenter/rtm.vehiculo.info.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
    public function VehiculoUpdatertm()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/callcenter/rtm.vehiculo.update.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
    public function NotaCreateRtm()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/callcenter/rtm.nota.create.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }

    public function NotaHistorialrtm()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/callcenter/rtm.nota.historial.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
    public function NotaDeleteRtm()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/callcenter/rtm.nota.delete.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
    public function SendSmsRtm()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/callcenter/rtm.sms.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
    public function IngreAgendHistorialRtm()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/callcenter/rtm.ingr.agen.historial.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
    public function RevisadoRtm()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/callcenter/rtm.revisado.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
}