<?php

if (
    isset($_POST['target']) &&
    isset($_POST['task']) &&
    isset($_POST['rol']) &&
    isset($_POST['status']) &&
    count($_POST) == 4
) {

    $notaClass = new NotaClass($this->pdo);
    $this->arrayResponse = $notaClass->getNota(
        htmlspecialchars($_POST['task']), // veh pro con
        htmlspecialchars($_POST['target']), // 1, abc123 1110563
        htmlspecialchars(strtolower($_POST['rol'])) // id, placa, documen
    );

    $this->pdo = null;
} else if (!isset($_POST['status'])) {
    $this->arrayResponse = $this->configuracion->sinPermisosParaAcceder();
} else {
    $this->arrayResponse = $this->configuracion->formularioIncompleto();
}