<?php
require 'call_seguridad.php';
class RecursosApp extends dXhLn
{

    const MODULOS_SESSION_POS = 5; # array de los [0,1,2,4,5,6]
    const DATABASE_SESSION_POS = 6; # base de datos
    const COUNT_SESSION = 8; # numero de sessiones

    const GET_MODULOS = array("Create", "Update", "Listado", "Delete", "Info", "Tab", "Informacion");

    const MODULOS_APP = array(
        'inicio' => array(
            'nombre' => 'Inicio',
            'icono' => 'icon solid fa-home',
            'url' => '/modulos/',
        ),
        'ingreso-rapido' => array(
            'nombre' => 'ingreso-rapido',
            'icono' => 'icon solid fa-gauge-simple-high',
            'url' => '/modulos/ingreso-rapido/',
        ),
        'ingreso-completo' => array(
            'nombre' => 'ingreso-completo',
            'icono' => 'icon solid fa-gauge-simple',
            'url' => '/modulos/ingreso-completo/',
        ),
        // 'ingreso_basico' => array(
        //     'nombre' => 'Ingreso_callcenter',
        //     'icono' => 'icon solid fa-car',
        //     'url' => '/modulos/ingreso_callcenter/',
        // ),
        'test' => array(
            'nombre' => 'Test',
            'icono' => 'icon solid fa-car',
            'url' => '/modulos/test/index.php',
        ),
        'callcenter' => array(
            'nombre' => 'callcenter',
            'icono' => 'icon solid fa-phone',
            'url' => '/modulos/callcenter/',
        ),
        'agendamiento-cda' => array(
            'nombre' => 'Agendamiento-CDA',
            'icono' => 'icon solid fa-calendar-day',
            'url' => '/modulos/agendamiento-cda/',
        ),
        'agendamiento' => array(
            'nombre' => 'Agendamiento',
            'icono' => 'icon solid fa-calendar',
            'url' => '/modulos/agendamiento/',
        ),
        'visor-ingreso' => array(
            'nombre' => 'Visor-Ingreso',
            'icono' => 'icon solid fa-table-list',
            'url' => '/modulos/visor-ingreso/',
        ),
        'visor-psi' => array(
            'nombre' => 'Visor-Psi',
            'icono' => 'icon solid fa-bomb',
            'url' => '/modulos/visor-psi/',
        ),
        'visor-pdf' => array(
            'nombre' => 'Visor-Pdf',
            'icono' => 'icon solid fa-file-pdf',
            'url' => '/modulos/visor-pdf/',
        ),
        //'mensajes' => array(
        //    'nombre' => 'Mensajes',
        //    'icono' => 'icon solid fa-comment-sms',
        //    'url' => '/modulos/mensajes/',
        //),
          
        'visor-reportes' => array(
            'nombre' => 'Visor-Reportes',
            'icono' => 'icon solid fa-clock',
            'url' => '/modulos/visor-reportes/',
        ),
        'gestion' => array(
            'nombre' => 'Gestión',
            'sub-menu' => array(
                0 => array(
                    'nombre' => 'Novedades',
                    'icono' => 'icon solid fa-newspaper',
                    'url' => '/modulos/gestion/novedades',
                ),
                1 => array(
                    'nombre' => 'Rango',
                    'icono' => 'icon solid fa-users-line',
                    'url' => '/modulos/gestion/rango',
                ),
                2 => array(
                    'nombre' => 'Archivos',
                    'icono' => 'icon solid fa-file-shield',
                    'url' => '/modulos/gestion/archivo',
                ),
                3 => array(
                    'nombre' => 'Usuarios',
                    'icono' => 'icon solid fa-users-line',
                    'url' => '/modulos/gestion/usuario',
                ),
                4 => array(
                    'nombre' => 'Encriptar',
                    'icono' => 'icon solid fa-shield',
                    'url' => '/modulos/gestion/encriptar',
                ),
                5 => array(
                    'nombre' => 'Canales de mercadeo',
                    'icono' => 'icon solid fa-repeat',
                    'url' => '/modulos/gestion/canal',
                ),
                6 => array(
                    'nombre' => 'Tipo de gestion',
                    'icono' => 'icon solid fa-phone-volume',
                    'url' => '/modulos/gestion/tipo_gestion',
                ),
                7 => array(
                    'nombre' => 'Vehiculos',
                    'icono' => 'icon solid fa-car-side',
                    'url' => '/modulos/gestion/vehiculo',
                ),
                8 => array(
                    'nombre' => 'Clientes',
                    'icono' => 'icon solid fa-user-tie',
                    'url' => '/modulos/gestion/cliente',
                ),
                 9 => array(
                    'nombre' => 'Tarifas',
                    'icono' => 'icon solid fa-money-check-alt', 
                    'url' => '/modulos/gestion/tarifa',
                ),
            ),
        ),
        'documentacion' => array(
            'nombre' => 'Documentación',
            'icono' => 'icon solid fa-video',
            'url' => '/modulos/documentacion/',
        ),
        'legal' => array(
            'nombre' => 'Legal',
            'icono' => 'icon solid fa-gavel',
            'url' => '/modulos/legal/',
        ),

        'mi_cuenta' => array(
            'nombre' => 'mi_cuenta',
            'icono' => 'icon solid fa-user-cog',
            'url' => '/modulos/mi_cuenta/',
        ),
    );

    function __construct()
    {

        parent::init();
        @parent::p3poW($_SESSION['session_user'][self::MODULOS_SESSION_POS], self::MODULOS_SESSION_POS);
        parent::S8Lm0(self::MODULOS_APP, self::COUNT_SESSION);
        // descomentar para entrar en mantenimiento
        // parent::r2vYe($_SESSION['session_user'][4], 1);
        
    }

    function verificarPeticion($_peticion = 'error')
    {

        $aa = array("Create", "Read", "Update", "Listado", "Delete", "Info", "Tab", "Detalles", "Informacion");

        if (in_array($_peticion, $aa)) {
            return array('statusCode' => 200, 'status' => true, 'message' => 'ok');
        } else {
            return array('statusCode' => 400, 'status' => false, 'message' => 'Bad request');
        }
    }

    function verificarSession($_modulo = 'no')
    {
        if ($_modulo === 'AJAX') {
            // peticion tipo ajax
            if (
                isset($_SESSION['session_user']) &&
                count($_SESSION['session_user']) == self::COUNT_SESSION
            ) {
                return array('status' => true, 'message' => 'La session esta activa');
            } else {
                return array('statusCode' => 200, 'status' => false, 'message' => 'La session fue finalizada', 'statusText' => 'no_session');
            }
            return array('status' => false, 'message' => 'La session no fue verificada', 'statusText' => 'no_session');
        } else if ($_modulo === 'HTML') {
            // al inicio de la pagina
            if (
                !isset($_SESSION['session_user']) ||
                count($_SESSION['session_user']) != self::COUNT_SESSION
            ) {
                echo "<script> window.location = '" . ROOT . "/iniciar-sesion/';</script>";
            }
        } else if ($_modulo === 'LOGIN') {
            if (
                isset($_SESSION['session_user']) &&
                count($_SESSION['session_user']) == self::COUNT_SESSION
            ) {
                echo "<script> window.location = '" . ROOT . "/modulos/';</script>";
            }
        } else {
            session_unset();
            session_destroy();
            echo "<script> window.location = '" . ROOT . "/iniciar-sesion/';</script>";
        }
    }

    function verificarModulo($_id_modulo = 'no_module', $_expulsar = false)
    {
        $verificar = (parent::cM8aZ($_id_modulo));
        
        if ($verificar['status'] == true) {
            return array('status' => true, 'message' => 'Acceso autorizado');
        } else {
            // si no quiere capturar el mensaje
            if ($_expulsar === true) {
                session_unset();
                session_destroy();
                echo "<script> window.location = '" . ROOT . "/iniciar-sesion/';</script>";
            }
            return array('status' => false, 'message' => 'Acceso no autorizado a este modulo', 'statusText' => 'no_autorizado');
        }
        return array('status' => false, 'message' => 'Autorización no verificada, inténtelo de nuevo', 'statusText' => 'no_autorizado');
    }

    // crea el menu segun los modulos de la session
    function generarMenu()
    {
        return parent::Xr2L7(self::MODULOS_APP);
    }

    function verificarToken($_headers = 'token')
    {
        if (
            isset($_headers['csrf-token']) &&
            strcmp($_headers['csrf-token'], $_SESSION['csrf_token']) == 0
        ) {
            return array('statusCode' => 400, 'status' => true, 'message' => 'Token autorizado');
        } else {
            return array('statusCode' => 400, 'status' => false, 'message' => 'Token no autorizado', 'statusText' => 'no_token');
        }
        return array('statusCode' => 400, 'status' => false, 'message' => 'Token no veriricado', 'statusText' => 'no_token');
    }

    function formularioIncompleto()
    {
        return array('statusCode' => 400, 'status' => false, 'statusText' => 'error', 'message' => 'Formulario incompleto');
    }
    function sinPermisosParaAcceder()
    {
        return array('statusCode' => 400, 'status' => false, 'statusText' => 'error', 'message' => 'No tiene permisos para acceder');
    }

    function petResponse(
        $_arrayResponse = array('statusCode' => 500, 'status' => false, 'message' => 'Sin parametros')
    ) {

        echo json_encode($_arrayResponse, JSON_FORCE_OBJECT);
    }
}