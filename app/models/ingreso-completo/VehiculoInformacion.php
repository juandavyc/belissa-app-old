<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST["status"]) &&
            isset($_POST["placa"]) &&
            count($_POST) == 2
        ) {

            $placa = htmlspecialchars($_POST["placa"]);

            $vehiculoClass = new VehiculoClass($__pdo);
            $arrayVehiculo = $vehiculoClass->getInformacion(
                'PLACA',
                $placa
            );

            if (isset($arrayVehiculo['vehiculo'][0]['id']) && $arrayVehiculo['vehiculo'][0]['id'] > 0) {
                # mirar cuantos ingresos tiene y devolverlos

                $ingresoClass = new IngresoClass($__pdo);
                $arrayIngreso = $ingresoClass->getIngreso(
                    'ID_VEHICULO',
                    $arrayVehiculo['vehiculo'][0]['id'],
                    '0,3'
                );

                if ($arrayIngreso['statusText'] == 'sin_resultados') {

                    $__modelResponseApp = array(
                        'statusCode' => 200,
                        'statusText' => 'bien',
                        'vehiculo' => $arrayVehiculo['vehiculo'],
                        'ingreso' => $arrayIngreso,
                        'contador' => 0,
                    );
                } else {

                    $__modelResponseApp = array(
                        'statusCode' => 200,
                        'statusText' => 'bien',
                        'vehiculo' => $arrayVehiculo['vehiculo'],
                        'ingreso' => $arrayIngreso,
                        'contador' => count($arrayIngreso['message']),
                    );
                }
            } else {
                $__modelResponseApp = array(
                    'statusCode' => 200,
                    'statusText' => 'sin_resultados',
                    'vehiculo' => array(),
                    'ingreso' => array(),
                    'contador' => 0,
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
