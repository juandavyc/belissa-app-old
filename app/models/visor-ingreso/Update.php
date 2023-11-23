<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['id_vehiculo']) &&
            isset($_POST['id_ingreso']) &&
            isset($_POST['fecha_certificado']) &&
            isset($_POST['resultado']) &&
            isset($_POST['acepto_responsabilidad']) &&
            isset($_POST['status']) &&
            count($_POST) == 6
        ) {

            $certificado = new IngresoClass($__pdo);
            $__modelResponseApp = $certificado->createCertificado(
                ($_POST['id_vehiculo']),
                ($_POST['id_ingreso']),
                getSpecialDateDatabase($_POST['fecha_certificado']),
                $_POST['resultado'],
                $_SESSION['session_user'][1]
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
