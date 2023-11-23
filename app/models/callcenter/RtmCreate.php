<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['entidad']) &&
            isset($_POST['fecha']) &&
            isset($_POST['acepto_terminos_condiciones']) &&
            isset($_POST['vehiculo']) &&
            isset($_POST['tipo']) &&
            isset($_POST['status']) &&
            count($_POST) == 6
        ) {

            if (strcmp($_POST['tipo'], 'RTM') == 0) {
                $detalles = new RtmClass($__pdo);
                $__modelResponseApp = $detalles->createRtm(
                    htmlspecialchars($_POST['entidad']),
                    getSpecialDateDatabase($_POST['fecha']),
                    htmlspecialchars($_POST['vehiculo']),
                    $_SESSION['session_user'][1]
                );
            } else if (strcmp($_POST['tipo'], 'SOAT') == 0) {
                $detalles = new SoatClass($__pdo);
                $__modelResponseApp = $detalles->createSoat(
                    htmlspecialchars($_POST['entidad']),
                    getSpecialDateDatabase($_POST['fecha']),
                    htmlspecialchars($_POST['vehiculo']),
                    $_SESSION['session_user'][1]
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
