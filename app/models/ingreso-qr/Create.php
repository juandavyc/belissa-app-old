<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['placa']) &&
            isset($_POST['tipo_vehiculo']) &&
            isset($_POST['status']) &&
            count($_POST) == 3
        ) {
            $vigente = date('Y-m-d H:i:s', strtotime("+1 day"));
            $ingreso = new IngresoQr($__pdo);
            $__modelResponseApp = $ingreso->createQr(
                htmlspecialchars(strtoupper($_POST['placa'])),
                htmlspecialchars($_POST['tipo_vehiculo']),
                $vigente,
                $_SESSION['session_user'][1]
            );
            $__modelResponseApp['vigente'] = $vigente;

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
