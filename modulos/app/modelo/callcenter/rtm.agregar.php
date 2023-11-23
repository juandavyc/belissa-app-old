<?php

if (
    isset($_POST['entidad']) &&
    isset($_POST['fecha']) &&
    isset($_POST['acepto_terminos_condiciones']) &&
    isset($_POST['vehiculo']) &&
    isset($_POST['tipo']) &&
    isset($_POST['status']) &&
    count($_POST) == 6
) {

    if (strcmp($_POST['tipo'], 'RTM') == 0) {
        $detalles = new RtmClass($this->pdo);
        $this->arrayResponse = $detalles->createRtm(
            htmlspecialchars($_POST['entidad']),
            getSpecialDateDatabase($_POST['fecha']),
            htmlspecialchars($_POST['vehiculo']),
            $_SESSION['session_user'][1]
        );
    } else if (strcmp($_POST['tipo'], 'SOAT') == 0) {
        $detalles = new SoatClass($this->pdo);
        $this->arrayResponse = $detalles->createSoat(
            htmlspecialchars($_POST['entidad']),
            getSpecialDateDatabase($_POST['fecha']),
            htmlspecialchars($_POST['vehiculo']),
            $_SESSION['session_user'][1]
        );
    }
    $this->pdo = null;
} else if (!isset($_POST['status'])) {
    $this->arrayResponse = $this->configuracion->sinPermisosParaAcceder();
} else {
    $this->arrayResponse = $this->configuracion->formularioIncompleto();
}