<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['status']) &&
            isset($_POST['id_elemento']) &&
            count($_POST) == 2
        ) {
            $ingresoClass = new IngresoClass($__pdo);
            $__modelResponseApp = $ingresoClass->InfoIngreso(
                getDesencriptado($_POST['id_elemento'])
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