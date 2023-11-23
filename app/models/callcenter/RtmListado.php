<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['vehiculo']) &&
            isset($_POST['rol']) &&
            isset($_POST['tipo']) &&
            isset($_POST['status']) &&
            count($_POST) == 4
        ) {
            if (strcmp($_POST['tipo'], 'RTM') == 0) {
                $detalles = new RtmClass($__pdo);
                $__modelResponseApp = $detalles->getHistorialVehiculo(
                    htmlspecialchars($_POST['rol']),
                    htmlspecialchars($_POST['vehiculo'])
                );
            } else if (strcmp($_POST['tipo'], 'SOAT') == 0) {
                $detalles = new SoatClass($__pdo);
                $__modelResponseApp = $detalles->getHistorialVehiculo(
                    htmlspecialchars($_POST['rol']),
                    htmlspecialchars($_POST['vehiculo'])
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
