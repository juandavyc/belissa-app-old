<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['id']) &&
            isset($_POST['foto']) &&
            isset($_POST['nombre']) &&
            isset($_POST['apellido']) &&
            isset($_POST['tipo_documento']) &&
            isset($_POST['documento']) &&
            isset($_POST['correo']) &&
            isset($_POST['rango']) &&
            isset($_POST['nacimiento']) &&
            isset($_POST['canal']) &&
            isset($_POST['tipo_canal']) &&
            isset($_POST['acepto_responsabilidad']) &&
            isset($_POST['firma']) &&
            isset($_POST['status']) &&
            count($_POST) == 14
        ) {

            $id = $_POST['id'];
            $foto = htmlspecialchars($_POST['foto']);
            $nombre = htmlspecialchars(trim(strtoupper($_POST['nombre'])));
            $apellido = htmlspecialchars(trim(strtoupper($_POST['apellido'])));
            $tipoDocumento = htmlspecialchars($_POST['tipo_documento']);
            $documento = htmlspecialchars(trim($_POST['documento']));

            $correo = htmlspecialchars($_POST['correo']);
            $rango = htmlspecialchars($_POST['rango']);
            $contrasenia = $documento;

            $nacimiento = getSpecialDateDatabase($_POST['nacimiento']);
            $canal = htmlspecialchars($_POST['canal']);
            $tipoCanal = htmlspecialchars($_POST['tipo_canal']);

            $firma = getSRCImage64($_POST['firma'], '/archivos/usuario/firma', time());
            $usuario = ($_SESSION['session_user'][1]);

            $Usuario = new UsuarioClass($__pdo);
            $__modelResponseApp = $Usuario->gestionarUsuario(
                $id,
                $foto,
                $nombre,
                $apellido,
                $tipoDocumento,
                $documento,
                $correo,
                $rango,
                $nacimiento,
                $contrasenia,
                $firma,
                $canal,
                $tipoCanal,
                1, // (Activo, suspendido)
                $usuario,
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
