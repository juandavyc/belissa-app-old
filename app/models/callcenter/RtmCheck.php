<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['vehiculo']) &&
            isset($_POST['status']) &&
            count($_POST) == 2
        ) {
            $detalles = new RtmClass($__pdo);
            $__modelResponseApp = $detalles->setRevisado(
                htmlspecialchars($_POST['vehiculo']),
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
