<?php
if (isset($__configuracionApp)) {

    if (
        isset($_POST['status']) &&
        isset($_POST['id_elemento']) &&
        count($_POST) == 2
    ) {
        $usuarioClass = new UsuarioClass($__pdo);
        $__modelResponseApp = $usuarioClass->InformacionUsuario(
            getDesencriptado($_POST['id_elemento'])
        );
        $__pdo = null;
    } else if (!isset($_POST['status'])) {
        $__modelResponseApp = ($__configuracionApp->mensaje->getSinPermisos());
    } else {
        $__modelResponseApp = ($__configuracionApp->mensaje->getFormularioIcompleto());
    }
} else {
    echo "<h1>404 Not Found</h1>";
    echo "The page that you have requested could not be found.";
}
