<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['status']) &&
            isset($_POST['id_agendamiento']) &&
            isset($_POST['fecha']) &&
            isset($_POST['horario']) &&
            isset($_POST['estado_agendamiento']) &&
            isset($_POST['acepto_responsabilidad']) &&
            count($_POST) == 6
        ) {

            $id = htmlspecialchars($_POST['id_agendamiento']);
            $fecha = getSpecialDateDatabase($_POST['fecha']);
            $horario = htmlspecialchars($_POST['horario']);
            $estado_agendamiento = htmlspecialchars($_POST['estado_agendamiento']);
            $id_usuario = htmlspecialchars($_SESSION['session_user'][1]);

            $agenClass = new AgendamientoClass($__pdo);
            $__modelResponseApp = $agenClass->EditAgendamiento(
                $id,
                $fecha,
                $horario,
                $estado_agendamiento,
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