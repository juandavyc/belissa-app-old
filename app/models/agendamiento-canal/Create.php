<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['id_agendamiento']) &&
            isset($_POST['fecha']) &&
            isset($_POST['horario']) &&
            isset($_POST['placa']) &&
            isset($_POST['tipo_vehiculo']) &&
            isset($_POST['id_vehiculo']) &&
            isset($_POST['tipo_documento']) &&
            isset($_POST['documento']) &&
            isset($_POST['id_documento']) &&
            isset($_POST['nombre']) &&
            isset($_POST['apellido']) &&
            isset($_POST['telefono']) &&
            isset($_POST['correo']) &&
            isset($_POST['enviar']) &&
            isset($_POST['acepto_terminos_condiciones']) &&
            isset($_POST['status']) &&
            count($_POST) == 16
        ) {

            $cupo = '';

            if (htmlspecialchars($_POST['tipo_vehiculo']) == 2) {
                $cupo = 1;
            } else {
                $cupo = 2;
            }

            $agendamiento = new AgendamientoCanalClass($__pdo);
            $__modelResponseApp = $agendamiento->gestionarAgendamiento(
                $_POST['id_agendamiento'],
                getSpecialDateDatabase($_POST['fecha']),
                htmlspecialchars($_POST['horario']),
                htmlspecialchars(strtoupper($_POST['placa'])),
                htmlspecialchars($_POST['id_vehiculo'] == 'create_vehiculo' ? 0 : $_POST['id_vehiculo']),
                htmlspecialchars($_POST['tipo_vehiculo']),
                htmlspecialchars($_POST['tipo_documento']),
                htmlspecialchars($_POST['documento']),
                htmlspecialchars($_POST['id_documento'] == 'create_vehiculo' ? 0 : $_POST['id_documento']),
                htmlspecialchars($_POST['nombre']),
                htmlspecialchars($_POST['apellido']),
                htmlspecialchars($_POST['telefono']),
                htmlspecialchars($_POST['correo']),
                htmlspecialchars($_POST['enviar']),
                $cupo,
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
