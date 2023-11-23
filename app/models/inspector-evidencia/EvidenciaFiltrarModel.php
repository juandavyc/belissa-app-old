<?php session_start();
header('Content-Type: application/json');
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';

$config = new RecursosApp();
$recursosResponse['session'] = $config->verificarSession('AJAX');
$recursosResponse['token'] = $config->verificarToken(apache_request_headers());

if (
    $recursosResponse['session']['status'] &&
    $recursosResponse['token']['status']
) {
    if (
        isset($_POST["placa"]) &&
        count($_POST) == 1
    ) {

        $raiz = $_SERVER["DOCUMENT_ROOT"] . '/archivos/inspectores/';
        $responseStatus = 'error';
        $responseMessage = 'sin_iniciar_modulo';
        $responseSrc = array();

        $directorio = htmlspecialchars($_POST["placa"]);

        if (is_dir($raiz . $directorio)) {
            $elementos = scandir($raiz . $directorio);

            $indexIterator = 0;

            foreach ($elementos as $elemento) {
                if ($elemento != "." && $elemento != "..") {
                    $ruta = $raiz . $directorio . '/' . $elemento;
                    if (is_dir($ruta)) {
                        // Es una carpeta              
                        array_push(
                            $responseSrc,
                            array(
                                'name' => htmlspecialchars($elemento),
                                'type' => 'folder',
                                'subfolder' => array()
                            )
                        );
                        $archivos = scandir($ruta);
                        // es un archivo ?
                        foreach ($archivos as $archivo) {
                            if ($archivo != "." && $archivo != "..") {
                                array_push(
                                    $responseSrc[$indexIterator]['subfolder'],
                                    array(
                                        'type' => 'file',
                                        'name' => htmlspecialchars($archivo),
                                        'url' => "/archivos/inspectores/{$directorio}/" . htmlspecialchars($elemento) . "/" . htmlspecialchars($archivo)
                                    )
                                );
                            }
                        }
                    } else {
                        array_push(
                            $responseSrc,
                            array(
                                'type' => 'file',
                                'name' => htmlspecialchars($elemento),
                                'url' => "/archivos/inspectores/{$directorio}/" . htmlspecialchars($elemento)
                            )
                        );
                    }
                    $indexIterator++;
                }
            }
            // si encontro carpetas
            if (count($responseSrc) > 0) {
                $responseStatus = "bien";
                $responseMessage = "Elementos encontrados";
            }
        } else {
            $responseMessage = "Sin registros para esta placa";
        }
        echo json_encode(
            array(
                'statusText' => $responseStatus,
                'message' => $responseMessage,
                'src' => $responseSrc,
            ),
            JSON_FORCE_OBJECT
        );
        exit;
    } else {
        $config->petResponse($config->formularioIncompleto());
    }
} else {
    foreach ($recursosResponse as $clave => $valor) {
        if ($valor['status'] == false) {
            $config->petResponse($valor);
            break;
        }
    }
}
