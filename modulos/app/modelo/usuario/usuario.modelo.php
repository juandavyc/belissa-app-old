<?php session_start();
header('Content-Type: application/json');
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_database.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/php/call_resources.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/clases/usuario/usuario.class.php';
// cambiar la comprobacion de la sesion para devolver el error
$config = new RecursosApp();
$method = isset($_GET['m']) ? $_GET['m'] . 'usuario' : 'error';

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

        $rangoModelo = new UsuarioModelo($database->getPDO(), $config);
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

class UsuarioModelo
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

    public function Createusuario()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/usuario/usuario.create.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }

    public function Listadousuario()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/usuario/usuario.listado.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
    public function Deleteusuario()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/usuario/usuario.eliminar.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
    public function Infousuario()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/usuario/usuario.informacion.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
    public function Informacionusuario()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/usuario/usuario.info.canal.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
    public function Updateusuario()
    {
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/usuario/usuario.canal.create.php';
        $this->configuracion->petResponse($this->arrayResponse);
    }
}
