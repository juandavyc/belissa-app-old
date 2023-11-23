<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['id']) &&
            isset($_POST['table']) &&
            isset($_POST['status']) &&
            count($_POST) == 3
        ) {
            $notaClass = new NotaClass($__pdo);
            $__modelResponseApp = $notaClass->eliminarNota(
                $_POST['id'],
                ($_POST['table']),
                $_SESSION['session_user'][1]
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
