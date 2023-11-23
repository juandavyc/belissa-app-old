<?php
// var_dump($_POST);

if (

    isset($_POST['status']) &&
    isset($_POST['form_id_vehiculo']) &&
    isset($_POST['placa']) &&
    isset($_POST['tipo_vehiculo']) &&
    isset($_POST['servicio_vehiculo']) &&
    isset($_POST['modelo']) &&
    isset($_POST['ensenanza_vehiculo']) &&
    isset($_POST['editar_marca']) &&
    isset($_POST['editar_linea']) &&
    isset($_POST['editar_color']) &&
    isset($_POST['acepto_responsabilidad']) &&
    count($_POST) == 11
) {

    $_id = htmlspecialchars($_POST['form_id_vehiculo']);
    $placa = htmlspecialchars(strtoupper($_POST['placa']));
    $tipo_vehiculo = htmlspecialchars($_POST['tipo_vehiculo']);
    $servicio_vehiculo = htmlspecialchars($_POST['servicio_vehiculo']);
    $modelo = htmlspecialchars(strtoupper($_POST['modelo']));
    $ensenanza_vehiculo = htmlspecialchars($_POST['ensenanza_vehiculo']);
    $editar_marca = htmlspecialchars($_POST['editar_marca']);
    $editar_linea = htmlspecialchars(strtoupper($_POST['editar_linea']));
    $editar_color = htmlspecialchars($_POST['editar_color']);

    $vehiculoClass = new VehiculoClass($this->pdo);
    $this->arrayResponse = $vehiculoClass->EditVehiculo(

        $_id,
        $placa,
        $tipo_vehiculo,
        $servicio_vehiculo,
        $modelo,
        $ensenanza_vehiculo,
        $editar_marca,
        $editar_linea,
        $editar_color

    );
    $this->pdo = null;

} else if (!isset($_POST['status'])) {
    $this->arrayResponse = $this->configuracion->sinPermisosParaAcceder();
} else {
    $this->arrayResponse = $this->configuracion->formularioIncompleto();
}