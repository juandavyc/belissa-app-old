<?php

if (
    isset($_POST['id']) &&
    isset($_POST['placa']) &&
    isset($_POST['tipo']) &&
    isset($_POST['servicio']) &&
    isset($_POST['modelo']) &&
    isset($_POST['ensenanza']) &&
    isset($_POST['marca']) &&
    isset($_POST['linea']) &&
    isset($_POST['color']) &&
    isset($_POST['vin']) &&
    isset($_POST['acepto_terminos_condiciones']) &&
    isset($_POST['propietario']) &&
    isset($_POST['conductor']) &&
    isset($_POST['status']) &&
    count($_POST) == 14
) {

    $vehiculoDetalles = new VehiculoClass($this->pdo);

    $this->arrayResponse = $vehiculoDetalles->updateInformacion(
        htmlspecialchars($_POST['id']),
        htmlspecialchars($_POST['placa']),
        htmlspecialchars($_POST['tipo']),
        htmlspecialchars($_POST['servicio']),
        htmlspecialchars($_POST['modelo']),
        htmlspecialchars($_POST['ensenanza']),
        htmlspecialchars($_POST['linea']),
        htmlspecialchars($_POST['color']),
        htmlspecialchars($_POST['vin']),
        htmlspecialchars($_POST['propietario']),
        htmlspecialchars($_POST['conductor']),
        $_SESSION['session_user'][1]
    );

    $this->pdo = null;
} else if (!isset($_POST['status'])) {
    $this->arrayResponse = $this->configuracion->sinPermisosParaAcceder();
} else {
    $this->arrayResponse = $this->configuracion->formularioIncompleto();
}