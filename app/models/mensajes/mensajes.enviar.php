<?php
// var_dump($_POST);

if (
    isset($_POST['dias']) &&
    isset($_POST['mensaje_masivo']) &&
    // isset($_POST['acepto_responsabilidad']) &&
    isset($_POST['status']) &&
    count($_POST) == 3
) {

 
    // primero la consulta de los numeros y luego hace la peticion de los mensajes

    $dias = htmlspecialchars($_POST['dias']);
    $mensaje_predeterminado = htmlspecialchars($_POST['mensaje_masivo']);
    $id_usuario = $_SESSION['session_user'][1];


    $Mensajes = new MensajeClass($this->pdo);
    $this->arrayResponse = $Mensajes->GetMensajeMasivo(
        array(
            'dias' => $dias,
            'mensaje' => $mensaje_predeterminado,
        )
    );

    // var_dump($this->arrayResponse);
    // return;

    if ($this->arrayResponse['statusCode'] == 200) {
        $apiSms = new ApiSmsClass($this->pdo, $this->configuracion);
        // datos de sesion y token para comprobaciones

        $this->arrayResponse = $apiSms->SendMessage(
            array('numero' => $this->arrayResponse['mensaje_pred']['numeros'], 'mensaje' => $_POST['mensaje_masivo'])
        );
    }


    // $Mensajes = new MensajeClass($this->pdo);
    // $this->arrayResponse = $Mensajes->CreateMensaje(
    //     array(
    //         'TITULO' => $titulo,
    //         'MENSAJE' => $mensaje,
    //         'USUARIO' => $id_usuario,
    //     )
    // );
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
