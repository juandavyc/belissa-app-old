<?php
// var_dump($_POST);
if (
    isset($_POST['vehiculo']) &&
    isset($_POST['rol']) &&
    isset($_POST['tipo']) &&
    isset($_POST['status']) &&
    count($_POST) == 4
) {

    if (strcmp($_POST['tipo'], 'RTM') == 0) {
        $detalles = new RtmClass($this->pdo);

        $this->arrayResponse = $detalles->getHistorialVehiculo(
            htmlspecialchars($_POST['rol']),
            htmlspecialchars($_POST['vehiculo'])
        );
    } else if (strcmp($_POST['tipo'], 'SOAT') == 0) {
        $detalles = new SoatClass($this->pdo);
        $this->arrayResponse = $detalles->getHistorialVehiculo(
            htmlspecialchars($_POST['rol']),
            htmlspecialchars($_POST['vehiculo'])
        );
    }

    $this->pdo = null;
} else if (!isset($_POST['status'])) {
    $this->arrayResponse = $this->configuracion->sinPermisosParaAcceder();
} else {
    $this->arrayResponse = $this->configuracion->formularioIncompleto();
}