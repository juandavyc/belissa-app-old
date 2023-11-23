<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['status']) &&
            isset($_POST['id_elemento']) &&
            count($_POST) == 2
        ) {
            $ingresoClass = new IngresoClass($__pdo);
            $tempResponse = $ingresoClass->InfoIngreso(
                getDesencriptado($_POST['id_elemento'])
            );

            
            if($tempResponse['statusText'] == "bien"){

                $__modelResponseApp = array(
                    'statusCode' =>  $tempResponse['statusCode'],
                    'statusText' =>  $tempResponse['statusText'],
                    'message' => array(
                        'placa' => $tempResponse['message']['placa'],
                        'tipo_vehiculo' => $tempResponse['message']['tipo_vehiculo'],
                        'carroceria' => $tempResponse['message']['carroceria'],
                        'linea' => $tempResponse['message']['linea'],
                        'vez' => $tempResponse['message']['vez'],
                        'pasajeros' => $tempResponse['message']['pasajeros'],
                        'psi' => array(
                            'moto_delantera' => $tempResponse['message']['psi']['moto_delantera'],
                            'moto_trasera' => $tempResponse['message']['psi']['moto_trasera'],
                            'liviano_delantera_derecha' => $tempResponse['message']['psi']['liviano_delantera_derecha'],
                            'liviano_trasera_derecha' => $tempResponse['message']['psi']['liviano_trasera_derecha'],
                            'liviano_delantera_izquierda' => $tempResponse['message']['psi']['liviano_delantera_izquierda'],
                            'liviano_trasera_izquierda' => $tempResponse['message']['psi']['liviano_trasera_izquierda'],
                            'repuesto' => $tempResponse['message']['psi']['repuesto']
                        )
                    )
                );

            }
            else{
                $__modelResponseApp = array(
                    'statusCode' =>  $tempResponse['statusCode'],
                    'statusText' =>  $tempResponse['statusText'],
                    'message' => $tempResponse['message']
                );
            }
            $__pdo = null;
        } else {
            $__modelResponseApp = ($__configuracionApp->mensaje->getFormularioIcompleto());
        }
    } else {
        $__modelResponseApp = ($__configuracionApp->mensaje->getSinPermisos());
    }
} else {
    echo "<h1>404 Not Found</h1>";
    echo "The page that you have requested could not be found.";
}
