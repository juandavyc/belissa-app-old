<?php

if (isset($__configuracionApp)) {
    if (
        isset($_POST['id']) &&
        isset($_POST['editor']) &&
        isset($_POST['acepto_responsabilidad']) &&
        isset($_POST['status']) &&
        count($_POST) == 4
    ) {
        $novedadClass = new NovedadClass($__pdo);

        $__modelResponseApp = $novedadClass->UpdateNovedad(
            htmlspecialchars($_POST['id']),
            ($_POST['editor']),
            $_SESSION['session_user'][1],
        );

        $__pdo = null;
    } else if (!isset($_POST['status'])) {
        $__configuracionApp->mensaje->petResponse($__configuracionApp->mensaje->getSinPermisos());
    } else {
        $__configuracionApp->mensaje->petResponse($__configuracionApp->mensaje->getFormularioIcompleto());
    }
} else {
    echo "<h1>404 Not Found</h1>";
    echo "The page that you have requested could not be found.";
}
