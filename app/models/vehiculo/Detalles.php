<?php
// var_dump($_POST);

if (

    isset($_POST['status']) &&
    isset($_POST['id']) &&
    count($_POST) == 2
) {

    $_id = htmlspecialchars($_POST['id']);

    $vehiculoClass = new VehiculoClass($this->pdo);
    $this->arrayResponse = $vehiculoClass->getInformacion(
        'ID',
        encrypt($_id, 2)
    );
    $this->pdo = null;

} else if (!isset($_POST['status'])) {
    $this->arrayResponse = $this->configuracion->sinPermisosParaAcceder();
} else {
    $this->arrayResponse = $this->configuracion->formularioIncompleto();
}