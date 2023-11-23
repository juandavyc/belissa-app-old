<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['status']) &&
            isset($_POST['id_elemento']) &&
            isset($_POST['razon']) &&
            count($_POST) == 3
        ) {

            $razon = htmlspecialchars(strtoupper($_POST['razon']));
            $id_usuario = htmlspecialchars($_SESSION['session_user'][1]);
            $agenClass = new AgendamientoClass($__pdo);
            $__modelResponseApp = $agenClass->SetAgen(
                getDesencriptado($_POST['id_elemento']),
                $razon,
                $id_usuario
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
