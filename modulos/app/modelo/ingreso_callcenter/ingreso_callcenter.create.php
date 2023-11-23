<?php

// var_dump($_POST);
if (
    isset($_POST["id_conductor"]) &&
    isset($_POST["documento"]) &&
    isset($_POST["nombre"]) &&
    isset($_POST["apellido"]) &&
    isset($_POST["telefono_1"]) &&
    isset($_POST["telefono_2"]) &&
    isset($_POST["telefono_3"]) &&
    isset($_POST["email"]) &&
    isset($_POST["direccion"]) &&
    isset($_POST["id_vehiculo"]) &&
    isset($_POST["placa"]) &&
    isset($_POST["tipo"]) &&
    isset($_POST["servicio"]) &&
    isset($_POST["modelo"]) &&
    isset($_POST["ensenanza"]) &&
    isset($_POST["marca"]) &&
    isset($_POST["linea"]) &&
    isset($_POST["color"]) &&
    isset($_POST["id_propietario"]) &&
    isset($_POST["documento_propietario"]) &&
    isset($_POST["nombre_propietario"]) &&
    isset($_POST["apellido_propietario"]) &&
    isset($_POST["telefono_1_propietario"]) &&
    isset($_POST["telefono_2_propietario"]) &&
    isset($_POST["telefono_3_propietario"]) &&
    isset($_POST["email_propietario"]) &&
    isset($_POST["direccion_propietario"]) &&
    isset($_POST["acepto_terminos_condiciones"]) &&
    isset($_POST["status"]) &&
    count($_POST) == 29
) {


    //conductor
    $id_conductor = htmlspecialchars($_POST["id_conductor"]);
    $documento = htmlspecialchars($_POST["documento"]);
    $nombre = htmlspecialchars($_POST["nombre"]);
    $apellido = htmlspecialchars($_POST["apellido"]);
    $telefono_1 = htmlspecialchars($_POST["telefono_1"]);
    $telefono_2 = htmlspecialchars($_POST["telefono_2"]);
    $telefono_3 = htmlspecialchars($_POST["telefono_3"]);
    $email = htmlspecialchars($_POST["email"]);
    $direccion = htmlspecialchars($_POST["direccion"]);
    //Vehiculo
    $id_vehiculo = htmlspecialchars($_POST["id_vehiculo"]);
    $placa = htmlspecialchars($_POST["placa"]);
    $tipo = htmlspecialchars($_POST["tipo"]);
    $servicio = htmlspecialchars($_POST["servicio"]);
    $modelo = htmlspecialchars($_POST["modelo"]);
    $ensenanza = htmlspecialchars($_POST["ensenanza"]);
    $marca = htmlspecialchars($_POST["marca"]);
    $linea = htmlspecialchars($_POST["linea"]);
    $color = htmlspecialchars($_POST["color"]);
    //Propietario
    $id_propietario = htmlspecialchars($_POST["id_propietario"]);
    $documento_propietario = htmlspecialchars($_POST["documento_propietario"]);
    $nombre_propietario = htmlspecialchars($_POST["nombre_propietario"]);
    $apellido_propietario = htmlspecialchars($_POST["apellido_propietario"]);
    $telefono_1_propietario = htmlspecialchars($_POST["telefono_1_propietario"]);
    $telefono_2_propietario = htmlspecialchars($_POST["telefono_2_propietario"]);
    $telefono_3_propietario = htmlspecialchars($_POST["telefono_3_propietario"]);
    $email_propietario = htmlspecialchars($_POST["email_propietario"]);
    $direccion_propietario = htmlspecialchars($_POST["direccion_propietario"]);
  
    $ingreso = new IngresoClass($this->pdo);
    $this->arrayResponse = $ingreso->CreateIngresoBasico(
        array(
           "ID_CONDUCTOR" => $id_conductor,
           "DOCUMENTO" => $documento,
           "NOMBRE" => $nombre,
           "APELLIDO" => $apellido,
           "TELEFONO_1" => $telefono_1,
           "TELEFONO_2" => $telefono_2,
           "TELEFONO_3" => $telefono_3,
           "EMAIL" => $email,
           "DIRECCION" => $direccion,
           "ID_VEHICULO" => $id_vehiculo,
           "PLACA" => $placa,
           "TIPO" => $tipo,
           "SERVICIO" => $servicio,
           "MODELO" => $modelo,
           "ENSENANZA" => $ensenanza,
           "MARCA" => $marca,
           "LINEA" => $linea,
           "COLOR" => $color,
           "ID_PROPIETARIO" => $id_propietario,
           "DOCUMENTO_PROPIETARIO" => $documento_propietario,
           "NOMBRE_PROPIETARIO" => $nombre_propietario,
           "APELLIDO_PROPIETARIO" => $apellido_propietario,
           "TELEFONO_1_PROPIETARIO" => $telefono_1_propietario,
           "TELEFONO_2_PROPIETARIO" => $telefono_2_propietario,
           "TELEFONO_3_PROPIETARIO" => $telefono_3_propietario,
           "EMAIL_PROPIETARIO" => $email_propietario,
           "DIRECCION_PROPIETARIO" => $direccion_propietario,
           "ID_USUARIO" => $_SESSION['session_user'][1]
        )
    );




} else if (!isset($_config)) {
    if (!isset($_POST['status'])) {
        echo json_encode(array('statusCode' => 400, 'statusText' => false, 'message' => 'Bad request'), http_response_code(400), JSON_FORCE_OBJECT);
        exit;
    } else { 
        echo json_encode(array('statusCode' => 400, 'statusText' => 'error', 'message' => 'Formulario incompleto'), JSON_FORCE_OBJECT);
        exit;
    }
}