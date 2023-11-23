<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['vehiculo']) &&
            isset($_POST['rol']) &&
            isset($_POST['status']) &&
            count($_POST) == 3
        ) {

            $vehiculoDetalles = new VehiculoClass($__pdo);
            $__modelResponseApp = $vehiculoDetalles->getInformacion(
                htmlspecialchars($_POST['rol']),
                htmlspecialchars($_POST['vehiculo'])
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
