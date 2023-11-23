<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['fecha_inicial']) &&
            isset($_POST['fecha_final']) &&
            isset($_POST['status']) &&
            count($_POST) == 3
        ) {
            $ingresoClass = new IngresoClass($__pdo);
            $__modelResponseApp = $ingresoClass->getEstadoPlacas(
                getSpecialDateDatabase($_POST['fecha_inicial']),
                getSpecialDateDatabase($_POST['fecha_final'])
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
