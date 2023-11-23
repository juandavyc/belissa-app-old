<?php
if (
    isset($_POST['vehiculo']) &&
    isset($_POST['status']) &&
    count($_POST) == 2
) {

    $vehiculoDetalles = new VehiculoClass($this->pdo);

    $responseVehiculo = $vehiculoDetalles->getInformacion(
        'ID',
        htmlspecialchars($_POST['vehiculo'])
    );
    $this->arrayResponse = $responseVehiculo;

    $this->pdo = null;
} else if (!isset($_POST['status'])) {
    $this->arrayResponse = $this->configuracion->sinPermisosParaAcceder();
} else {
    $this->arrayResponse = $this->configuracion->formularioIncompleto();
}