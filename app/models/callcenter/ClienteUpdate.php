<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['id']) &&
            isset($_POST['tipo']) &&
            isset($_POST['documento']) &&
            isset($_POST['nombre']) &&
            isset($_POST['apellido']) &&
            isset($_POST['telefono_1']) &&
            isset($_POST['telefono_2']) &&
            isset($_POST['telefono_3']) &&
            isset($_POST['email']) &&
            isset($_POST['direccion']) &&
            isset($_POST['acepto_terminos_condiciones']) &&
            isset($_POST['vehiculo']) &&
            isset($_POST['rol']) &&
            isset($_POST['status']) &&
            count($_POST) == 14
        ) {
            $clienteDetalles = new ClienteClass($__pdo);

            if (
                strcmp(($_POST['id']), 'create_propietario') == 0 ||
                strcmp(($_POST['id']), 'create_conductor') == 0
            ) {

                $__modelResponseApp = $clienteDetalles->createInformacion(
                    htmlspecialchars($_POST['vehiculo']),
                    htmlspecialchars($_POST['tipo']),
                    htmlspecialchars($_POST['documento']),
                    htmlspecialchars($_POST['nombre']),
                    htmlspecialchars($_POST['apellido']),
                    htmlspecialchars($_POST['telefono_1']),
                    htmlspecialchars($_POST['telefono_2']),
                    htmlspecialchars($_POST['telefono_3']),
                    htmlspecialchars($_POST['email']),
                    htmlspecialchars($_POST['direccion']),
                    (strcmp($_POST['rol'], 'propietario') == 0) ? 1 : 2,
                    $_SESSION['session_user'][1] // responsable
                );
            } else {

                $__modelResponseApp = $clienteDetalles->updateInformacion(
                    htmlspecialchars($_POST['id']),
                    htmlspecialchars($_POST['vehiculo']),
                    htmlspecialchars($_POST['tipo']),
                    htmlspecialchars($_POST['documento']),
                    htmlspecialchars($_POST['nombre']),
                    htmlspecialchars($_POST['apellido']),
                    htmlspecialchars($_POST['telefono_1']),
                    htmlspecialchars($_POST['telefono_2']),
                    htmlspecialchars($_POST['telefono_3']),
                    htmlspecialchars($_POST['email']),
                    htmlspecialchars($_POST['direccion']),
                    (strcmp($_POST['rol'], 'propietario') == 0) ? 1 : 2,
                    $_SESSION['session_user'][1] // responsable
                );
            }
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
