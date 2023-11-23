<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['vehiculo']) &&
            isset($_POST['rol']) &&
            isset($_POST['status']) &&
            count($_POST) == 3
        ) {
            $Ingreso = new IngresoClass($__pdo);
            $__modelResponseApp = $Ingreso->getIngresRtm(
                htmlspecialchars($_POST['rol']),
                htmlspecialchars($_POST['vehiculo']),
                '0,25'
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
