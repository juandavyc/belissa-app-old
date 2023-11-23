<?php

if (isset($__configuracionApp)) {

    if (
        isset($_POST['status']) &&
        isset($_POST['id']) &&
        count($_POST) == 2
    ) {

        $usuarioClass = new UsuarioClass($__pdo);
        $tempResponse =  $usuarioClass->InformacionUsuario(
            getDesencriptado($_POST['id'])
        );

        $__modelResponseApp = array(
            'statusCode' => $tempResponse['statusCode'],
            'statusText' => $tempResponse['statusText'],
            'message' => $tempResponse['message'],
            'usuario' => array(
                'id'  => $tempResponse['usuario']['id'],
                'nombre'  => $tempResponse['usuario']['nombre'],
                'apellido'  => $tempResponse['usuario']['apellido'],
            )
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
