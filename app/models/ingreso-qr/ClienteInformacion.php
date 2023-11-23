<?php

 //var_dump($_POST);
if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['id']) &&
            isset($_POST['placa']) &&
            isset($_POST['tipo_vehiculo']) &&
            isset($_POST['propietario_documento']) &&
            isset($_POST['propietario_tipo_documento']) &&
            isset($_POST['propietario_nombres']) &&
            isset($_POST['propietario_apellidos']) &&
            isset($_POST['propietario_telefono']) &&
            isset($_POST['propietario_correo']) &&
            isset($_POST['propietario_direccion']) &&
            isset($_POST['propietario_rut']) &&
            isset($_POST['soy_el_propietario']) && // IMPORTANTE
            isset($_POST['conductor_documento']) &&
            isset($_POST['conductor_tipo_documento']) &&
            isset($_POST['conductor_nombres']) &&
            isset($_POST['conductor_apellidos']) &&
            isset($_POST['conductor_telefono']) &&
            isset($_POST['conductor_correo']) &&
            isset($_POST['conductor_direccion']) &&
            isset($_POST['conductor_rut']) &&
            isset($_POST['a_quien_facturar']) && // IMPORTANTE
            isset($_POST['factura_documento']) &&
            isset($_POST['factura_tipo_documento']) &&
            isset($_POST['factura_nombres']) &&
            isset($_POST['factura_apellidos']) &&
            isset($_POST['factura_telefono']) &&
            isset($_POST['factura_correo']) &&
            isset($_POST['factura_direccion']) &&
            isset($_POST['factura_rut']) && //
            isset($_POST['tarjeta_delantera']) &&
            isset($_POST['tarjeta_trasera']) &&
            isset($_POST['ofertas_comerciales']) &&
            isset($_POST['terminos_condiciones']) &&
            count($_POST) == 34
        ) {
            $ingreso = new IngresoQr($__pdo);
            $id = getDesencriptado($_POST['id']);
            $_verificar = $ingreso->isVigenteQR($id);

            if ($_verificar['statusText'] == 'bien') {
                //$__modelResponseApp = ($__configuracionApp->mensaje->getFormularioIcompleto()));

                $placa = htmlspecialchars(strtoupper(trim($_POST['placa'])));
                $tipo = htmlspecialchars($_POST['tipo_vehiculo']);

                $propietario_documento = htmlspecialchars(strtoupper(trim($_POST['propietario_documento'])));
                $propietario_tipo_documento = htmlspecialchars($_POST['propietario_tipo_documento']);
                $propietario_nombres = htmlspecialchars(strtoupper(trim($_POST['propietario_nombres'])));
                $propietario_apellidos = htmlspecialchars(strtoupper(trim($_POST['propietario_apellidos'])));
                $propietario_telefono = htmlspecialchars(strtoupper(trim($_POST['propietario_telefono'])));
                $propietario_correo = htmlspecialchars(strtoupper(trim($_POST['propietario_correo'])));
                $propietario_direccion =  htmlspecialchars(strtoupper(trim($_POST['propietario_direccion'])));
                $propietario_rut = htmlspecialchars(strtoupper(trim($_POST['propietario_rut'])));
                $soy_el_propietario = htmlspecialchars(strtoupper(trim($_POST['soy_el_propietario'])));
                $conductor_documento = htmlspecialchars(strtoupper(trim($_POST['conductor_documento'])));
                $conductor_tipo_documento = htmlspecialchars($_POST['conductor_tipo_documento']);
                $conductor_nombres = htmlspecialchars(strtoupper(trim($_POST['conductor_nombres'])));
                $conductor_apellidos = htmlspecialchars(strtoupper(trim($_POST['conductor_apellidos'])));
                $conductor_telefono = htmlspecialchars(strtoupper(trim($_POST['conductor_telefono'])));
                $conductor_correo = htmlspecialchars(strtoupper(trim($_POST['conductor_correo'])));
                $conductor_direccion = htmlspecialchars(strtoupper(trim($_POST['conductor_direccion'])));
                $conductor_rut = htmlspecialchars(strtoupper(trim($_POST['conductor_rut'])));
                $a_quien_facturar = htmlspecialchars(strtoupper(trim($_POST['a_quien_facturar'])));
                $factura_documento = htmlspecialchars(strtoupper(trim($_POST['factura_documento'])));
                $factura_tipo_documento =  htmlspecialchars($_POST['factura_tipo_documento']);
                $factura_nombres = htmlspecialchars(strtoupper(trim($_POST['factura_nombres'])));
                $factura_apellidos = htmlspecialchars(strtoupper(trim($_POST['factura_apellidos'])));
                $factura_telefono = htmlspecialchars(strtoupper(trim($_POST['factura_telefono'])));
                $factura_correo = htmlspecialchars(strtoupper(trim($_POST['factura_correo'])));
                $factura_direccion = htmlspecialchars(strtoupper(trim($_POST['factura_direccion'])));
                $factura_rut = htmlspecialchars(strtoupper(trim($_POST['factura_rut'])));
                $tarjeta_delantera = htmlspecialchars(strtoupper(trim($_POST['tarjeta_delantera'])));
                $tarjeta_trasera = htmlspecialchars(strtoupper(trim($_POST['tarjeta_trasera'])));
                $ofertas_comerciales = htmlspecialchars(strtoupper(trim($_POST['ofertas_comerciales'])));

                if ($soy_el_propietario == "si") {
                    $conductor_documento = $propietario_documento;
                    $conductor_tipo_documento = $propietario_tipo_documento;
                    $conductor_nombres = $propietario_nombres;
                    $conductor_apellidos = $propietario_apellidos;
                    $conductor_telefono = $propietario_telefono;
                    $conductor_correo = $propietario_correo;
                    $conductor_direccion = $propietario_direccion;
                    $conductor_rut = $propietario_rut;
                }
                // facturar
                if ($a_quien_facturar == "propietario") {
                    $factura_documento = $propietario_documento;
                    $factura_tipo_documento = $propietario_tipo_documento;
                    $factura_nombres = $propietario_nombres;
                    $factura_apellidos = $propietario_apellidos;
                    $factura_telefono = $propietario_telefono;
                    $factura_correo = $propietario_correo;
                    $factura_direccion = $propietario_direccion;
                    $factura_rut = $propietario_rut;
                }
                if ($a_quien_facturar == "conductor") {
                    $factura_documento = $conductor_documento;
                    $factura_tipo_documento = $conductor_tipo_documento;
                    $factura_nombres = $conductor_nombres;
                    $factura_apellidos = $conductor_apellidos;
                    $factura_telefono = $conductor_telefono;
                    $factura_correo = $conductor_correo;
                    $factura_direccion = $conductor_direccion;
                    $factura_rut = $conductor_rut;
                }
                $__modelResponseApp = $ingreso->guardarInformacion(
                    $id,
                    $placa,
                    $tipo,
                    $propietario_documento,
                    $propietario_tipo_documento,
                    $propietario_nombres,
                    $propietario_apellidos,
                    $propietario_telefono,
                    $propietario_correo,
                    $propietario_direccion,
                    $propietario_rut,
                    $conductor_documento,
                    $conductor_tipo_documento,
                    $conductor_nombres,
                    $conductor_apellidos,
                    $conductor_telefono,
                    $conductor_correo,
                    $conductor_direccion,
                    $conductor_rut,
                    $factura_documento,
                    $factura_tipo_documento,
                    $factura_nombres,
                    $factura_apellidos,
                    $factura_telefono,
                    $factura_correo,
                    $factura_direccion,
                    $factura_rut,
                    $tarjeta_delantera,
                    $tarjeta_trasera
                );
            } else {
                $__modelResponseApp = $_verificar;
            }
            // $__modelResponseApp['vigente'] = $vigente;
            // $__modelResponseApp 
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
