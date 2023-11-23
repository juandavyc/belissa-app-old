<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {

        if (
            isset($_POST["form_1_antigua_contrasena"]) &&
            isset($_POST["form_1_nueva_contrasena"]) &&
            isset($_POST["form_1_confirmar_contrasena"]) &&
            isset($_POST["acepto_responsabilidad"]) &&
            isset($_POST['status']) &&
            count($_POST) == 5
        ) {

            $id = $_SESSION['session_user'][1];

            $contra_vieja = htmlspecialchars($_POST['form_1_antigua_contrasena']);
            $contra_nueva = htmlspecialchars($_POST['form_1_nueva_contrasena']);
            $contra_confirmada = htmlspecialchars($_POST['form_1_confirmar_contrasena']);


            $micuentaClass = new MiCuentaClass($__pdo);
            $__modelResponseApp = $micuentaClass->setCambioContrasena(
                $contra_vieja,
                $contra_nueva,
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
