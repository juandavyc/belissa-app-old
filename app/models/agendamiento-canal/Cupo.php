<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['status']) &&
            count($_POST) == 1
        ) {

            $response = array(
                'cupo' => array(),
                'listado' => array(),
            );

            $agendamiento = new AgendamientoCanalClass($__pdo);
            $tempResponse = $agendamiento->getCupos();
            if ($tempResponse['statusText'] == 'bien') {                 
                $response['listado'] = $agendamiento->getCupoUsados();          
            }
            else{
                $response['cupo'] = $tempResponse;
            }

            $response['statusText'] = $tempResponse['statusText'];
            $response['cupo'] = $tempResponse;

            $__modelResponseApp =$response;
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
