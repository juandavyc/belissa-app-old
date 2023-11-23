<?php

if (
    isset($_POST['id']) &&
    isset($_POST['status']) &&
    count($_POST) == 2
) {

    $novedadClass = new NovedadClass($this->pdo);
    $this->arrayResponse = $novedadClass->ReadNovedad(
        htmlspecialchars($_POST['id'])
    );

    // var_dump($this->arrayResponse);
    $this->pdo = null;
} else if (!isset($_POST['status'])) {
    $config->petResponse($config->sinPermisosParaAcceder());
} else {
    $config->petResponse($config->formularioIncompleto());
}