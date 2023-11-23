<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['id_ingreso']) &&
            isset($_POST['id_vehiculo']) &&
            isset($_POST['placa_original']) &&
            isset($_POST['placa_nueva']) &&
            isset($_POST['razon']) &&
            isset($_POST['acepto_responsabilidad']) &&
            isset($_POST['status']) &&
            count($_POST) == 7
        ) {

            $ingreso = new IngresoClass($__pdo);
            $__modelResponseApp = $ingreso->updatePlaca(
                htmlspecialchars($_POST['id_ingreso']),
                htmlspecialchars($_POST['id_vehiculo']),
                htmlspecialchars(strtoupper($_POST['placa_original'])),
                htmlspecialchars(strtoupper($_POST['placa_nueva'])),
                htmlspecialchars($_POST['razon']),
                $_SESSION['session_user'][1]
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
