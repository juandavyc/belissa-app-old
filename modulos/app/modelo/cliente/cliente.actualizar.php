<?php
// var_dump($_POST);

if (

    isset($_POST['status']) &&
    isset($_POST['form_id_cliente']) &&
    isset($_POST['nombre']) &&
    isset($_POST['apellido']) &&
    isset($_POST['documento']) &&
    isset($_POST['tipo_documento']) &&
    isset($_POST['telefono_1']) &&
    isset($_POST['telefono_2']) &&
    isset($_POST['telefono_3']) &&
    isset($_POST['correo']) &&
    isset($_POST['direccion']) &&
    isset($_POST['acepto_responsabilidad']) &&
    count($_POST) == 12
) {

  
    $_id = htmlspecialchars($_POST['form_id_cliente']);
    $nombre = htmlspecialchars(strtoupper($_POST['nombre']));
    $apellido = htmlspecialchars(strtoupper($_POST['apellido']));
    $documento = htmlspecialchars($_POST['documento']);
    $tipo_documento = htmlspecialchars($_POST['tipo_documento']);
    $telefono_1 = htmlspecialchars($_POST['telefono_1']);
    $telefono_2 = htmlspecialchars($_POST['telefono_2']);
    $telefono_3 = htmlspecialchars($_POST['telefono_3']);
    $correo = htmlspecialchars($_POST['correo']);
    $direccion = htmlspecialchars($_POST['direccion']);
    $id_usuario = htmlspecialchars($_SESSION['session_user'][1]);

    


        $clienteClass = new ClienteClass($this->pdo);
        $this->arrayResponse = $clienteClass->UpdateCliente(
         
            $_id,
            $nombre,
            $apellido ,
            $documento ,
            $tipo_documento ,
            $telefono_1 ,
            $telefono_2 ,
            $telefono_3 ,
            $correo ,
            $direccion ,
            $id_usuario 
  
            
        );
        $this->pdo = null;
    
} else if (!isset($_POST['status'])) {

    $json = array('statusCode' => 400, 'status' => false, 'message' => 'No tiene permisos para acceder');
    echo json_encode($json, http_response_code($json["statusCode"]), JSON_FORCE_OBJECT);
} else {

    $json = array('statusCode' => 400, 'status' => false, 'message' => 'Formulario incompleto');
    echo json_encode($json, http_response_code($json["statusCode"]), JSON_FORCE_OBJECT);
}