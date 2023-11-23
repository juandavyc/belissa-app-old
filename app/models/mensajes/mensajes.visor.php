<?php

if (
    isset($_POST['filtro']) &&
    isset($_POST['contenido']) &&
    isset($_POST['resultados']) &&
    isset($_POST['status']) &&
    count($_POST) == 4
) {

    $Mensaje = new MensajeClass($this->pdo);

    $_array_sql = array(
        'id',
        'titulo',
    );
    $_columna_sql = $_array_sql[htmlspecialchars($_POST['filtro'])];
    $_contenido = ($_POST['contenido'] == 'Todo') ? '%%' : htmlspecialchars($_POST['contenido']);


    $this->arrayResponse = $Mensaje->getListado(
        $_columna_sql,
        $_contenido
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
