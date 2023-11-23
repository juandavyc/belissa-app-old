<?php

if (
    isset($_data['numero']) &&
    isset($_data['mensaje'])
) {

    $numero = $_data['numero'];
    $mensaje = htmlspecialchars($_data['mensaje']);
    $url = "https://api.netelip.com/v1/sms/api.php";

    $response = array();
    $response_status = '';
    //$Mensajes = new MensajeClass($this->pdo);
    
    //var_dump($Mensajes);
    //return;


    foreach ($numero as $key => $value) {

        $post = array(
            "token"       => "0d5a98763262819147c4651e9a8e66a5693f69c8bc9565e251e50ae785aa6be6",
            "from"        => "PRUEBA BELISSA",
            "destination" => '0057' . $value,
            "message"     => $mensaje
        );

        $request = curl_init($url);
        curl_setopt($request, CURLOPT_POST, 1);
        curl_setopt($request, CURLOPT_POSTFIELDS, $post);
        curl_setopt($request, CURLOPT_TIMEOUT, 180);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);


        $api_resp = curl_exec($request);
        if ($astpi_resp !== false) {
            // Si se ejecuta correctamente 
            
            $response_status = curl_getinfo($request, CURLINFO_HTTP_CODE);
            $response[$value] = array(
                'status' =>  $response_status,
                'mensaje' => $api_resp
            );

            // $this->arrayResponse = $Mensajes->saveLogMessage(

            //     $response

            // );
            // guardar log en la db
        } else {
            // registro en la db con estado de no enviado
            // Manejar error de conexión
        }

        sleep(1);
    }

    curl_close($request);

    $this->arrayResponse = json_encode(
        array('statusCode' => $response_status, 'statusText' => true, 'message' => $response),
        http_response_code($response_status),
        JSON_FORCE_OBJECT
    );

    $this->pdo = null;
} else if (!isset($_config)) {
    if (!isset($_data['status'])) {
        echo json_encode(array('statusCode' => 400, 'statusText' => false, 'message' => 'Bad request'), http_response_code(400), JSON_FORCE_OBJECT);
        exit;
    } else {
        echo json_encode(array('statusCode' => 400, 'statusText' => 'error', 'message' => 'Formulario incompleto'), JSON_FORCE_OBJECT);
        exit;
    }
}
