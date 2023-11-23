<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['status']) &&
            // cabecera
            isset($_POST['id_vehiculo']) &&
            isset($_POST['placa']) &&
            isset($_POST['id_propietario']) &&
            isset($_POST['id_conductor']) &&
            // vehiculo
            isset($_POST['tipo_vehiculo']) &&
            isset($_POST['servicio_vehiculo']) &&
            isset($_POST['modelo']) &&
            // documento
            isset($_POST['propietario_tipo_documento']) &&
            isset($_POST['propietario_documento']) &&
            isset($_POST['propietario_nombres']) &&
            isset($_POST['propietario_apellidos']) &&
            isset($_POST['propietario_telefono']) &&
            isset($_POST['propietario_correo_nombre']) &&
            isset($_POST['propietario_correo_dominio']) &&
            isset($_POST['propietario_direccion']) &&
            // conductor
            isset($_POST['conductor_tipo_documento']) &&
            isset($_POST['conductor_documento']) &&
            isset($_POST['conductor_nombres']) &&
            isset($_POST['conductor_apellidos']) &&
            isset($_POST['conductor_telefono']) &&
            isset($_POST['conductor_correo_nombre']) &&
            isset($_POST['conductor_correo_dominio']) &&
            isset($_POST['acepto_responsabilidad']) &&
            count($_POST) == 24
        ) {

            $id_vehiculo = htmlspecialchars($_POST["id_vehiculo"]);
            $placa = htmlspecialchars($_POST["placa"]);
            $id_propietario = htmlspecialchars($_POST["id_propietario"]);
            $id_conductor = htmlspecialchars($_POST["id_conductor"]);

            $tipo_vehiculo = htmlspecialchars($_POST["tipo_vehiculo"]);
            $servicio_vehiculo = htmlspecialchars($_POST["servicio_vehiculo"]);
            $modelo = htmlspecialchars($_POST["modelo"]);

            $propietario_tipo_documento = htmlspecialchars($_POST["propietario_tipo_documento"]);
            $propietario_documento = htmlspecialchars($_POST["propietario_documento"]);
            $propietario_nombres = htmlspecialchars($_POST["propietario_nombres"]);
            $propietario_apellidos = htmlspecialchars($_POST["propietario_apellidos"]);
            $propietario_telefono = htmlspecialchars($_POST["propietario_telefono"]);
            $propietario_correo = htmlspecialchars($_POST["propietario_correo_nombre"] . "@" . $_POST["propietario_correo_dominio"]);
            $propietario_direccion = htmlspecialchars($_POST["propietario_direccion"]);

            $conductor_tipo_documento = htmlspecialchars($_POST["conductor_tipo_documento"]);
            $conductor_documento = htmlspecialchars($_POST["conductor_documento"]);
            $conductor_nombres = htmlspecialchars($_POST["conductor_nombres"]);
            $conductor_apellidos = htmlspecialchars($_POST["conductor_apellidos"]);
            $conductor_telefono = htmlspecialchars($_POST["conductor_telefono"]);
            $conductor_correo = htmlspecialchars($_POST["conductor_correo_nombre"] . "@" . $_POST["conductor_correo_dominio"]);


            if (
                $propietario_documento == '1110' || strlen($propietario_documento) <= 4 ||
                $conductor_documento == '1110' || strlen($conductor_documento) <= 4 ||
                $id_propietario == 1 || $id_conductor == 1
            ) {
                echo json_encode(array('statusCode' => 400, 'statusText' => 'error', 'message' => 'Verifique los <b>documentos del propietario o conductor</b>'), JSON_FORCE_OBJECT);
                exit;
            } else {

                $ingresoDividido = new IngresoDivididoClass($__pdo);

                $__modelResponseApp = $ingresoDividido->guardarInformacion(
                    $id_vehiculo,
                    $placa,
                    $id_propietario,
                    $id_conductor,
                    $tipo_vehiculo,
                    $servicio_vehiculo,
                    $modelo,
                    $propietario_tipo_documento,
                    $propietario_documento,
                    $propietario_nombres,
                    $propietario_apellidos,
                    $propietario_telefono,
                    $propietario_correo,
                    $propietario_direccion,
                    $conductor_tipo_documento,
                    $conductor_documento,
                    $conductor_nombres,
                    $conductor_apellidos,
                    $conductor_telefono,
                    $conductor_correo,
                    $_SESSION['session_user'][1]
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
