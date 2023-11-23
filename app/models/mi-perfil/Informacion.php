<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['data_dev']) &&
            isset($_POST['status']) &&
            count($_POST) == 2
        ) {

            $id = $_SESSION['session_user'][1];
            $micuentaClass = new MiCuentaClass($__pdo);
            $__modelResponseApp = $micuentaClass->getMiCuenta(
                $id
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
