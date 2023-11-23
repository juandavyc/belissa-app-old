<?php
// var_dump($_POST);

if (
    isset($_POST['id']) &&
    isset($_POST['table']) &&
    isset($_POST['status']) &&
    count($_POST) == 3
) {

    $notaClass = new NotaClass($this->pdo);
    $this->arrayResponse = $notaClass->eliminarNota(
        $_POST['id'],
        ($_POST['table']),
        $_SESSION['session_user'][1]
    );

    $this->pdo = null;

} else if (!isset($_POST['status'])) {
    $this->arrayResponse = $this->configuracion->sinPermisosParaAcceder();
} else {
    $this->arrayResponse = $this->configuracion->formularioIncompleto();
}