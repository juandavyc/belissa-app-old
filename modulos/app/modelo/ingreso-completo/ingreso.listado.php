<?php

if (
    isset($_POST["status"]) &&
    isset($_POST["placa"]) &&
    count($_POST) == 2
) {

    $placa = htmlspecialchars($_POST["placa"]);


    # consulta del vehiculo antes de ver si tiene ingresos 

    $vehiculoClass = new VehiculoClass($this->pdo);
    $arrayVehiculo = $vehiculoClass->getInformacion(
        'PLACA',
        $placa
    );

    // var_dump($arrayVehiculo);

    if (isset($arrayVehiculo['vehiculo'][0]['id']) && $arrayVehiculo['vehiculo'][0]['id'] > 0) {
        # mirar cuantos ingresos tiene y devolverlos

        $ingresoClass = new IngresoClass($this->pdo);
        $arrayIngreso = $ingresoClass->getIngreso(
            'ID_VEHICULO',
            $arrayVehiculo['vehiculo'][0]['id'],
            '0,3'
        );

        # si no tiene resultados

        // var_dump($arrayIngreso['statusText']);

        if ($arrayIngreso['statusText'] == 'sin_resultados') {

            $this->arrayResponse = array(
                'statusCode' => 200,
                'statusText' => 'bien',
                'vehiculo' => $arrayVehiculo['vehiculo'],
                'ingreso' => $arrayIngreso,
                'contador' => 0,
            );
        } else {

            $this->arrayResponse = array(
                'statusCode' => 200,
                'statusText' => 'bien',
                'vehiculo' => $arrayVehiculo['vehiculo'],
                'ingreso' => $arrayIngreso,
                'contador' => count($arrayIngreso['message']),
            );
        }
    } else {

        # el ejemplo chimbo
        $this->arrayResponse = array(
            'statusCode' => 200,
            'statusText' => 'sin_resultados',
            'vehiculo' => array(),
            'ingreso' => array(),
            'contador' => 0,
        );
    }



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
