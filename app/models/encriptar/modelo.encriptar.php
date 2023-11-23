<?php
header('Content-Type: application/json');

require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_resources.php';

if ($_POST['tarea'] == 1) {
    echo json_encode(encrypt(trim($_POST['form_encriptar_1']), 1), JSON_FORCE_OBJECT);
    exit;
} else {
    echo json_encode(encrypt(trim($_POST['form_encriptar_1']), 2), JSON_FORCE_OBJECT);
    exit;
}