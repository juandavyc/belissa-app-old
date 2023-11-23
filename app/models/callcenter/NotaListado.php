<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['target']) &&
            isset($_POST['task']) &&
            isset($_POST['rol']) &&
            isset($_POST['status']) &&
            count($_POST) == 4
        ) {

            $notaClass = new NotaClass($__pdo);
            $__modelResponseApp = $notaClass->getNota(
                htmlspecialchars($_POST['task']), // veh pro con
                htmlspecialchars($_POST['target']), // 1, abc123 1110563
                htmlspecialchars(strtolower($_POST['rol'])) // id, placa, documen
            );

            $__pdo = null;
        } else {
            $__modelResponseApp = ($__configuracionApp->mensaje->getFormularioIcompleto());
        }
    } else {
        $__modelResponseApp = ($__configuracionApp->mensaje->getSinPermisos());
    }
} else {
    echo "<h1>404 Not Found</h1>";
    echo "The page that you have requested could not be found.";
}
