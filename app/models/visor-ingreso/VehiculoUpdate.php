<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['id']) &&
            isset($_POST['vin']) &&
            isset($_POST['status']) &&
            count($_POST) == 3
        ) {

            $actualizar = new IngresoClass($__pdo);
            $__modelResponseApp = $actualizar->setIngresoVin(
                ($_POST['id']),
                htmlspecialchars($_POST['vin']),
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
