<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (

            isset($_POST['id']) &&
            isset($_POST['nombre']) &&
            isset($_POST['tipo']) &&
            isset($_POST['acepto_responsabilidad']) &&
            isset($_POST['status']) &&
            count($_POST) == 5
        ) {

            $id_usuario = htmlspecialchars($_POST['id']);
            $nombre_canal = htmlspecialchars($_POST['nombre']);
            $tipo_canal = htmlspecialchars($_POST['tipo']);

            $id = htmlspecialchars($_SESSION['session_user'][1]);
            $UsuarioClass = new UsuarioClass($__pdo);

            $__modelResponseApp = $UsuarioClass->CreateCanalUsuario(
                $id_usuario,
                $tipo_canal,
                $nombre_canal,
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
