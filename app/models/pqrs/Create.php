<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {

        if (
            isset($_POST['fecha']) &&
            isset($_POST['asunto']) &&
            isset($_POST['nombre']) &&
            isset($_POST['correo']) &&
            isset($_POST['telefono']) &&
            isset($_POST['descripcion']) &&
            isset($_POST['notificacion']) &&
            isset($_POST['terminos']) &&
            isset($_POST['status']) &&
            count($_POST) == 10
        ) {
       
            $pqrs = new PQRS($__pdo);
            $__modelResponseApp = $pqrs->create(
                htmlspecialchars($_POST['asunto']),
                htmlspecialchars($_POST['notificacion']),
                htmlspecialchars(strtoupper($_POST['nombre'])),
                htmlspecialchars(strtoupper($_POST['correo'])),
                htmlspecialchars($_POST['telefono']),
                htmlspecialchars(strtoupper($_POST['placa'])),
                htmlspecialchars($_POST['descripcion']),
                htmlspecialchars(getSpecialDateDatabase($_POST['fecha'])),
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
