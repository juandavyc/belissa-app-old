<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {

        if (
            isset($_POST["foto_usuario"]) &&
            isset($_POST["nombre"]) &&
            isset($_POST["apellido"]) &&      
            isset($_POST["interfaz"]) &&
            isset($_POST['form_firma']) &&
            isset($_POST['acepto_responsabilidad']) &&            
            isset($_POST['status']) &&
            count($_POST) == 7
        ) {

            $id = ($_SESSION['session_user'][1]);
            $nombre = htmlspecialchars(strtoupper($_POST["nombre"]));
            $apellido = htmlspecialchars(strtoupper($_POST["apellido"]));
            $foto = htmlspecialchars($_POST["foto_usuario"]);
            $interfaz = htmlspecialchars($_POST["interfaz"]);
            $firma = getSRCImage64($_POST['form_firma'], '/archivos/usuario/firma', time());
            $_SESSION['session_user'][7] = ($interfaz == 1) ? 'white' : 'black';

            $micuentaClass = new MiCuentaClass($__pdo);
            $__modelResponseApp = $micuentaClass->setDatosInformacion(
                $nombre,
                $apellido,
                $foto,
                $firma,
                $interfaz,
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
