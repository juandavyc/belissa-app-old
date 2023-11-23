<?php
echo json_encode(
    array(
        'statusCode' => 200,
        'statusText' => 'No se puede crear',
        'options' => 'Sin privilegios para crear elementos nuevos',
        'count' => 0,
    ),
    JSON_FORCE_OBJECT
);