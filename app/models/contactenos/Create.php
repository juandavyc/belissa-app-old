<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['nombre']) &&
            isset($_POST['correo']) &&
            isset($_POST['telefono']) &&
            isset($_POST['placa']) &&
            isset($_POST['mensaje']) &&
            isset($_POST['notificacion']) &&
            isset($_POST['terminos']) &&
            isset($_POST['status']) &&
            count($_POST) == 8
        ) {
       
            $pqrs = new PQRS($__pdo);
            $__modelResponseApp = $pqrs->create(
                5,
                htmlspecialchars($_POST['notificacion']),
                htmlspecialchars(strtoupper($_POST['nombre'])),
                htmlspecialchars(strtoupper($_POST['correo'])),
                htmlspecialchars($_POST['telefono']),
                htmlspecialchars(strtoupper($_POST['placa'])),
                htmlspecialchars($_POST['mensaje']),
                getSpecialDateDatabase(date("d-m-Y")),
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
