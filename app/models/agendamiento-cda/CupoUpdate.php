<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
        isset($_POST['moto']) &&
        isset($_POST['liviano']) &&
        isset($_POST['acepto_terminos_condiciones']) &&
        isset($_POST['status']) &&
        count($_POST) == 4
    ) {

        $response = array(
            'liviano' => array(),
            'moto' => array(),
        );

        $agendamiento = new AgendamientoClass($__pdo);
        $response['liviano'] = $agendamiento->setCupos(
            1,
            htmlspecialchars($_POST['liviano']),
            $_SESSION['session_user'][1]
        );
        $response['moto'] = $agendamiento->setCupos(
            2,
            htmlspecialchars($_POST['moto']),
            $_SESSION['session_user'][1]
        );

        $__modelResponseApp = $response;

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
