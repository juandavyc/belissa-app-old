<?php


if (
    isset($_POST['form_id_editar_usuario']) &&
    isset($_POST['foto_usuario']) &&   
    isset($_POST['nombre_usuario']) &&
    isset($_POST['apellido_usuario']) &&
    isset($_POST['documento_usuario']) &&
    isset($_POST['correo_usuario']) &&
    isset($_POST['rango_usuario_editar']) &&
    isset($_POST['fecha_usuario_editar']) &&
    isset($_POST['estado_usuario']) &&
    isset($_POST['form_firma']) &&
    isset($_POST['acepto_responsabilidad']) &&
    isset($_POST['status']) &&
    count($_POST) == 12
) {

    $foto = htmlspecialchars($_POST['foto_usuario']);
    $nombre = htmlspecialchars($_POST['nombre_usuario']);
    $apellido = htmlspecialchars($_POST['apellido_usuario']);
    $documento = htmlspecialchars($_POST['documento_usuario']);
    $rango = htmlspecialchars($_POST['rango_usuario_editar']);
    $fecha_usuario = getSpecialDateDatabase($_POST['fecha_usuario_editar']);
    $firma = getSRCImage64($_POST['form_firma'], '/archivos/usuario/firma', time());
    $correo = htmlspecialchars($_POST['correo_usuario']);
    $id = htmlspecialchars($_SESSION['session_user'][1]);
    $id_usuario = htmlspecialchars($_POST['form_id_editar_usuario']);
    $estado_usuario = htmlspecialchars($_POST['estado_usuario']);

    $EditarUsuarioClass = new EditarUsuarioClass($this->pdo);
    $this->arrayResponse = $EditarUsuarioClass->CreateEditarUsuario(
        array(
            'ID' => encrypt($id_usuario,2),
            'FOTO' => $foto,
            'NOMBRE' => $nombre,
            'APELLIDO' => $apellido,
            'DOCUMENTO' => $documento,
            'RANGO' => $rango,
            'FECHA_NACIMIENTO' => $fecha_usuario,
            'FIRMA' => $firma,
            'CORREO' => $correo,
            'USUARIO'=> $id,
            'ESTADO_USUARIO'=> $estado_usuario,       
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
