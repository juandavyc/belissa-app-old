<?php session_set_cookie_params(['samesite' => 'None']);
session_start();
header('Content-Type: application/json');

require $_SERVER["DOCUMENT_ROOT"] . '/resources/database/connection.php';
require 'AutoCompleteClass.php';

if (
    isset($_POST["value"]) &&
    isset($_POST["column"]) &&
    isset($_POST["table"]) &&
    isset($_POST["parent_id"]) &&
    isset($_POST["parent_column"]) &&
    count($_POST) == 5

) {
    $database = new MyDatabase();

    if ($database->getEstado()['status']) {

        $autocomplete = new AutoCompleteClass($database->getPDO());

        if ($_POST["parent_id"] == 'parent') {
            petResponse(
                $autocomplete->CreateFather(
                    htmlspecialchars($_POST["table"]),
                    htmlspecialchars($_POST["column"]),
                    strtoupper(htmlspecialchars($_POST["value"])),
                    1 // id usuario
                )
            );
        } else {
            petResponse(
                $autocomplete->CreateSon(
                    htmlspecialchars($_POST["parent_column"]),
                    htmlspecialchars($_POST["parent_id"]),
                    htmlspecialchars($_POST["column"]),
                    htmlspecialchars($_POST["table"]),
                    strtoupper(htmlspecialchars($_POST["value"])),
                    1,
                )
            );
        }
        $database->close();
    } else {
        petResponse($database->getEstado());
    }
} else {
    petResponse($config->formularioIncompleto());
}
function petResponse(
    $_arrayResponse = array(
        'statusCode' => 500,
        'status' => false,
        'message' => 'Sin parametros'
    )
) {
    echo json_encode($_arrayResponse, JSON_FORCE_OBJECT);
}
