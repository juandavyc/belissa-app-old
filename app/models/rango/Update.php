<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['id']) &&
            isset($_POST['nombre']) &&
            isset($_POST['tipo_conexion']) &&
            isset($_POST['modulo']) &&
            isset($_POST['acepto_responsabilidad']) &&
            isset($_POST['status']) &&
            count($_POST) == 6
        ) {

            //$nombre = htmlspecialchars($_POST['nombre']);
            $modu = '';
            foreach ($_POST['modulo'] as $key => $value) {
                $modu .= '"' . $value . '",';
            }
            $modulos = '["inicio","documentacion","legal","mi-perfil",' . substr_replace($modu, "", -1) . ']';
            $rangoClass = new RangoClass($__pdo);
            $__modelResponseApp = $rangoClass->UpdateRango(
                getDesencriptado($_POST['id']),
                htmlspecialchars($_POST['tipo_conexion']),
                htmlspecialchars(($_POST['nombre'])),
                ($modulos),
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
