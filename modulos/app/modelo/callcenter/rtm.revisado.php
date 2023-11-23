<?php

if (
    isset($_POST['vehiculo']) &&
    isset($_POST['status']) &&
    count($_POST) == 2
) {

    $detalles = new RtmClass($this->pdo);

    $this->arrayResponse = $detalles->setRevisado(
        htmlspecialchars($_POST['vehiculo']),
        $_SESSION['session_user'][1]
    );

    $this->pdo = null;
} else if (!isset($_POST['status'])) {
    $this->arrayResponse = $this->configuracion->sinPermisosParaAcceder();
} else {
    $this->arrayResponse = $this->configuracion->formularioIncompleto();
}