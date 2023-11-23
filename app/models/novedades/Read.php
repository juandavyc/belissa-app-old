<?php
if (isset($__configuracionApp)) {

    if (
        isset($_POST['id']) &&
        isset($_POST['status']) &&
        count($_POST) == 2
    ) {

        $novedadClass = new NovedadClass($__pdo);
        $__modelResponseApp = $novedadClass->ReadNovedad(
            htmlspecialchars($_POST['id'])
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
