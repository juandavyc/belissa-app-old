<?php
class MyAppVerificar
{

    private $modulos = [];
    private $session = [];
    private $root = null;
    private $sesion_count = 0;

    public function __construct($session = null, $count = 0, $root = null)
    {
        $this->session = $session;
        $this->modulos = ($session == null) ? [] :  json_decode($session[5], true);
        $this->root = $root;
        $this->sesion_count = $count;
        $this->setToken();
    }

    public function setToken()
    {
        return $_SESSION['csrf_token'] = empty($_SESSION['csrf_token']) ? bin2hex(random_bytes(32)) : $_SESSION['csrf_token'];
    }
    public function getToken()
    {
        return empty($_SESSION['csrf_token']) ? bin2hex(random_bytes(32)) : $_SESSION['csrf_token'];
    }

    function isTokenAutorizado($_headers = 'token')
    {
        if (
            isset($_headers['csrf-token']) &&
            strcmp($_headers['csrf-token'], $_SESSION['csrf_token']) == 0
        ) {
            return array('statusCode' => 400, 'status' => true, 'message' => 'Token autorizado');
        } else {
            return array('statusCode' => 400, 'status' => false, 'message' => 'Token no autorizado', 'statusText' => 'no_token');
        }
    }
    public function isAutorizado($index, $exit = false)
    {

        if ($this->modulos != null && in_array($index, $this->modulos)) {
            return true;
        } else {
            if ($exit == true) {
                session_unset();
                session_destroy();
                echo "<script> window.location = '" . $this->root . "/';</script>";
            }
            return false;
        }
    }


    public function isVigenteSession($modulo = 'no')
    {
        if ($modulo === 'AJAX') {
            // peticion tipo ajax
            if (
                isset($this->session) &&
                count($this->session) == $this->sesion_count
            ) {
                return array('status' => true, 'message' => 'La session esta activa');
            } else {
                return array('statusCode' => 200, 'status' => false, 'message' => 'La session fue finalizada', 'statusText' => 'no_session');
            }
        } else if ($modulo === 'HTML') {
            if (!isset($this->session) || count($this->session) != $this->sesion_count) {
                echo "<script> window.location = '" . $this->root . "/';</script>";
            }
        } else if ($modulo === 'LOGIN') {
            if (
                isset($this->session) &&
                count($this->session) == $this->sesion_count
            ) {
                echo "<script> window.location = '" . $this->root . "/web/';</script>";
            }
        } else {
            session_unset();
            session_destroy();
            echo "<script> window.location = '" . $this->root . "/';</script>";
        }
    }
    function isPeticionAtorizado($_peticion = 'error')
    {
        $peticion = array(
            "Create",
            "Cupo",
            "CupoListado",
            "CupoUpdate",
            "Read",
            "Update",
            "Listado",
            "Delete",
            "Contrasenia",
            "Tab",
            "Detalles",
            // nota
            "NotaListado",
            "NotaCreate",
            "NotaDelete",
            // soat
            "SoatListado",
            "SoatCreate",
            // rtm
            "RtmListado",
            "RtmCreate",
            "RtmCheck",
            // cliente
            "ClienteInformacion",
            "ClienteUpdate",
            // vehiculo
            "VehiculoInformacion",
            "VehiculoUpdate",
            "PlacaUpdate",
            "Informacion",
            //
            "IngresoListado",
            "AgendamientoListado"
        );
        if (in_array($_peticion, $peticion)) {
            return array('statusCode' => 200, 'status' => true, 'message' => 'ok');
        } else {
            return array('statusCode' => 400, 'status' => false, 'message' => 'Bad request');
        }
    }
    public function getModulos()
    {
        return $this->modulos;
    }
    public function getSession()
    {
        return $this->session;
    }
}
