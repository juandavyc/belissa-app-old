
<?php 
// require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/clases/mensaje/mensaje.class.php';
// recibe los datos con los que va a ser consumida la api
class ApiSmsClass
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
    }

    public function SendMessage($_data)
    {
        // var_dump($_data);

        // return;
        // datos de comprobacion para saber que no se esta realizando la peticion a este archivo desde un servidor externo(config)
        require_once DOCUMENT_ROOT . '/modulos/app/modelo/api-sms/api.sendmessage.php';

        return $this->arrayResponse;
        // if (!empty($this->arrayResponse)) {
        //     $this->configuracion->petResponse($this->arrayResponse);
        // }


    }

    public function GetStatus()
    {

        require_once DOCUMENT_ROOT . '/modulos/app/modelo/api-sms/api.getstatus.php';
        if (!empty($this->arrayResponse)) {
            $this->configuracion->petResponse($this->arrayResponse);
        }
    }
}
