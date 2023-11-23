<?php

if (
    isset($_POST['id']) &&
    isset($_POST['editor']) &&
    isset($_POST['acepto_responsabilidad']) &&
    isset($_POST['status']) &&
    count($_POST) == 4
) {

    $novedadClass = new NovedadClass($this->pdo);
    $this->arrayResponse = $novedadClass->UpdateNovedad(
        htmlspecialchars($_POST['id']),
        ($_POST['editor']),
        $_SESSION['session_user'][1],
    );

    $this->pdo = null;

} else if (!isset($_POST['status'])) {
    $config->petResponse($config->sinPermisosParaAcceder());
} else {
    $config->petResponse($config->formularioIncompleto());
}