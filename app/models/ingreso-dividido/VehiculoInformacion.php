<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['status']) &&
            isset($_POST['placa']) &&
            count($_POST) == 2
        ) {
            $vehiculoClass = new VehiculoClass($__pdo);
            $__modelResponseApp = $vehiculoClass->getInformacion(
                'PLACA',
                htmlspecialchars($_POST['placa'])
            );
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
