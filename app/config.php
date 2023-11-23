<?php
// imports 
require 'verificar.php';
require 'ruta.php';
require 'menu.php';
require 'mensaje.php';
require 'modelo.php';
require 'recursos.php';

class MyCallCenterApp
{

    const NAME = "Belissa, Call Center";
    const VERSION = "v1.2";    
    const BUSINESS = "CDA AUTOMOTOS S.A.S";
    const MODULOS_POS = 5;
    const DATABASE_POS = 6;
    const COUNT_SESSION = 8;
  
    public $session = null;
    public $ruta = null;
    public $verificar = null;
    public $menu  = null;
    public $mensaje = null;
    public $recursos = null;
    public $modelo = null;



    public function __construct()
    {
        $this->session = empty($_SESSION['session_user']) ? null : $_SESSION['session_user'];
        $this->ruta = new MyAppRutas();
        $this->verificar = new MyAppVerificar($this->session, self::COUNT_SESSION, $this->ruta->getRoot());
        $this->menu = new MyAppMenu($this->verificar);
        $this->mensaje = new MyAppMensaje();
        $this->modelo = new MyAppModelo();

    }

    public function getCurrentDate(){
        return date("d/m/Y");
    }

    // /*function getResponse($array = null){
    //     return json_encode($array, http_response_code($array["statusCode"]), JSON_FORCE_OBJECT);
    // }*/
    
}
