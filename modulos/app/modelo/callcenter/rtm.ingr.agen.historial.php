<?php
// var_dump($_POST);
if (
    isset($_POST['vehiculo']) &&
    isset($_POST['rol']) &&
    isset($_POST['tipo']) &&
    isset($_POST['status']) &&
    count($_POST) == 4
) {
    if (strcmp($_POST['tipo'], 'INGR') == 0) {
        $Ingreso = new IngresoClass($this->pdo);

        $this->arrayResponse = $Ingreso->getIngresRtm(
            htmlspecialchars($_POST['rol']),
            htmlspecialchars($_POST['vehiculo']),
            '0,25'
        );
    } else if (strcmp($_POST['tipo'], 'AGEN') == 0) {
        $Agendamiento = new AgendamientoClass($this->pdo);

        $this->arrayResponse = $Agendamiento->getAgendamientRtm(
            htmlspecialchars($_POST['rol']),
            htmlspecialchars($_POST['vehiculo']),
            '0,25'
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