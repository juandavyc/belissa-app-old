<?php
// var_dump($_POST);

if (
    isset($_POST['guardar']) &&
    isset($_POST['nota']) &&
    isset($_POST['acepto_terminos_condiciones']) &&
    isset($_POST['vehiculo']) &&
    isset($_POST['propietario']) &&
    isset($_POST['conductor']) &&
    isset($_POST['status']) &&
    count($_POST) == 7
) {

    $_tabla_sql = array("vehiculo", "propietario", "conductor");

    $tabla = htmlspecialchars(strtolower($_POST['guardar']));

    if (in_array($tabla, $_tabla_sql)) {

        $objetivo = 1;
        $nota = ($_POST['nota']);

        if ($tabla == 'vehiculo') {
            $objetivo = htmlspecialchars($_POST["vehiculo"]);
        } else if ($tabla == 'propietario') {
            $objetivo = htmlspecialchars($_POST["propietario"]);
        } else {
            $objetivo = htmlspecialchars($_POST["conductor"]);
        }

        $notaClass = new NotaClass($this->pdo);
        $this->arrayResponse = $notaClass->createNota(
            $tabla,
            $objetivo,
            $nota,
            $_SESSION['session_user'][1]
        );

    } else {
        $this->arrayResponse = array('statusCode' => 400, 'statusText' => 'error', 'message' => 'Formulario no valido');
    }

    $this->pdo = null;

} else if (!isset($_POST['status'])) {
    $this->arrayResponse = $this->configuracion->sinPermisosParaAcceder();
} else {
    $this->arrayResponse = $this->configuracion->formularioIncompleto();
}