<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['id']) &&
            isset($_POST['status']) &&
            count($_POST) == 2
        ) {
            $rangoClass = new RangoClass($__pdo);
            $__modelResponseApp = $rangoClass->InformacionRango(
                getDesencriptado($_POST['id'])
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
