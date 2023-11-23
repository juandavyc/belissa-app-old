<?php

if (
    isset($_POST['cliente']) &&
    isset($_POST['rol']) &&
    isset($_POST['status']) &&
    count($_POST) == 3
) {

    $clienteDetalles = new ClienteClass($this->pdo);

    $this->arrayResponse = $clienteDetalles->getInformacion(
        htmlspecialchars($_POST['rol']),
        htmlspecialchars($_POST['cliente'])
    );
    /*$*/

    $this->pdo = null;
} else if (!isset($_POST['status'])) {
    $this->arrayResponse = $this->configuracion->sinPermisosParaAcceder();
} else {
    $this->arrayResponse = $this->configuracion->formularioIncompleto();
}