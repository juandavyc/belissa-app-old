<?php session_start();
header('Content-Type: application/json');

require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_database.php';
require $_SERVER["DOCUMENT_ROOT"] . '/modulos/app/php/call_resources.php';

$config = new RecursosApp();

$recursosResponse['session'] = $config->verificarSession('AJAX');
$recursosResponse['token'] = $config->verificarToken(apache_request_headers());

// esto es para testeo, no use este modelo
if (
    $recursosResponse['session']['status'] &&
    $recursosResponse['token']['status']
) {

    if (
        isset($_POST['placa']) &&
        count($_POST) == 1
    ) {
        $placa = htmlspecialchars(strtoupper($_POST['placa']));
        $response = array();
        $mysqlArray = array();

        if ($placa == 'LIV111') {
            // Crea o actualiza el vehiculo
            // Retorna el ID
            $response = array(
                'statusCode' => 200,
                'statusText' => 'bien',
                'vehiculo' => array(
                    'id' => 1,
                    'placa' => $placa,
                ),
                'ingreso' => array(
                    0 => array(
                        'id' => 2,
                        'fecha' => '10/10/2022',
                        'vez' => 2,
                    ),
                    1 => array(
                        'id' => 2,
                        'fecha' => '05/10/2022',
                        'vez' => 1,
                    ),
                ),
                'contador' => 2,
            );
        } else if ($placa == 'MOT111') {
            // Crea o actualiza el vehiculo
            // Retorna el ID
            $response = array(
                'statusCode' => 200,
                'statusText' => 'bien',
                'vehiculo' => array(
                    'id' => 2,
                    'placa' => $placa,
                ),
                'ingreso' => array(
                    0 => array(
                        'id' => 2,
                        'fecha' => '10/10/2022',
                        'vez' => 2,
                    ),
                    1 => array(
                        'id' => 2,
                        'fecha' => '05/10/2022',
                        'vez' => 1,
                    ),
                ),
                'contador' => 2,
            );

        } else if ($placa == 'SIN123') {
            $response = array(
                'statusCode' => 200,
                'statusText' => 'sin_resultados',
                'vehiculo' => array(),
                'ingreso' => array(),
                'contador' => 0,
            );
        } else {
            $response = array(
                'statusCode' => 200,
                'statusText' => 'bien',
                'vehiculo' => array(
                    'id' => 3,
                    'placa' => strtoupper($placa),
                ),
                'ingreso' => array(),
                'contador' => 0,
            );
        }
        $config->petResponse($response);
    } else {
        $config->petResponse($this->configuracion->formularioIncompleto());
    }

} else {
    foreach ($recursosResponse as $clave => $valor) {
        if ($valor['status'] == false) {
            $config->petResponse($valor);
            break;
        }
    }
}