<?php

// var_dump($_POST);

if (
    isset($_POST['form_1_foto']) &&   
    isset($_POST['nombre_usuario']) &&
    isset($_POST['apellido_usuario']) &&
    isset($_POST['tipo_documento']) &&
    isset($_POST['documento_usuario']) &&
    isset($_POST['correo_usuario']) &&
    isset($_POST['rango']) &&
    isset($_POST['fecha_usuario']) &&
    isset($_POST['contrasena_usuario']) &&
    isset($_POST['guardar_canal']) &&
    isset($_POST['tipo_canal']) &&
    isset($_POST['form_firma']) &&
    isset($_POST['acepto_responsabilidad']) &&
    isset($_POST['status']) &&
    count($_POST) == 14
) {

    $foto = htmlspecialchars($_POST['form_1_foto']);
    $nombre = htmlspecialchars($_POST['nombre_usuario']);
    $apellido = htmlspecialchars($_POST['apellido_usuario']);
    $documento = htmlspecialchars($_POST['documento_usuario']);
    $rango = htmlspecialchars($_POST['rango']);
    $fecha_usuario = getSpecialDateDatabase($_POST['fecha_usuario']);
    $contrasenia = htmlspecialchars($_POST['contrasena_usuario']);
    $firma = getSRCImage64($_POST['form_firma'], '/archivos/usuario/firma', time());
    $tipo_documento = htmlspecialchars($_POST['tipo_documento']);
    $correo = htmlspecialchars($_POST['correo_usuario']);
    $canal = htmlspecialchars($_POST['guardar_canal']);
    $tipo_canal = htmlspecialchars($_POST['tipo_canal']);
    $id = htmlspecialchars($_SESSION['session_user'][1]);

    $UsuarioClass = new UsuarioClass($this->pdo);
    $this->arrayResponse = $UsuarioClass->CreateUsuario(
        array(
            'ID' => 0,
            'FOTO' => $foto,
            'NOMBRE' => $nombre,
            'APELLIDO' => $apellido,
            'DOCUMENTO' => $documento,
            'RANGO' => $rango,
            'FECHA_NACIMIENTO' => $fecha_usuario,
            'CONTRASENIA_USUARIO' => $contrasenia,
            'FIRMA' => $firma,
            'TIPO_DOCUMENTO' => $tipo_documento,
            'CORREO' => $correo,
            'CANAL' => $canal,
            'TIPO_CANAL' => $tipo_canal,
            'USUARIO'=> $id,
       
        )
    );

    

    $this->pdo = null;
} else if (!isset($_config)) {
    if (!isset($_POST['status'])) {
        echo json_encode(array('statusCode' => 400, 'statusText' => false, 'message' => 'Bad request'), http_response_code(400), JSON_FORCE_OBJECT);
        exit;
    } else { 
        echo json_encode(array('statusCode' => 400, 'statusText' => 'error', 'message' => 'Formulario incompleto'), JSON_FORCE_OBJECT);
        exit;
    }
}
