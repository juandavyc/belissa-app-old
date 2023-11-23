<?php session_start();
header('Content-Type: application/json');
require $_SERVER["DOCUMENT_ROOT"] . '/app/config.php';
$app = new MyCallCenterApp();

$recursosResponse['session'] = $app->verificar->isVigenteSession('AJAX');
$recursosResponse['token'] = $app->verificar->isTokenAutorizado(apache_request_headers());

if (
    $recursosResponse['session']['status'] &&
    $recursosResponse['token']['status']
) {

    require $app->ruta->getDatabase();
    $database = new MyDatabase();

    if ($database->getEstado()['status']) {

        $arrayResponse = array();

        $arrayResponse["tipo_vehiculo"] = getOptions($database, 'tipo_vehiculo', 'id > 1');
        $arrayResponse["servicio_vehiculo"] = getOptions($database, 'servicio_vehiculo', 'id > 1');
        $arrayResponse["combustible"] = getOptions($database, 'combustible', 'id > 0');
        $arrayResponse["tipo_caja"] = getOptions($database, 'tipo_caja', 'id > 0');
        $arrayResponse["tipo_documento"] = getOptions($database, 'tipo_documento', 'id > 0');
        $arrayResponse["criterio"]['moto'] = getRadioCriterio($database, 'id_tipo_vehiculo = 4');
        $arrayResponse["criterio"]['liviano'] = getRadioCriterio($database, 'id_tipo_vehiculo != 4');
        
        $app->mensaje->petResponse(
            array(
                'statusCode' => 200,
                'statusText' => 'bien',
                'elementos' => $arrayResponse,
            )
        );
        $database->close();
    } else {
        $app->mensaje->petResponse($database->getEstado());
    }
} else {
    foreach ($recursosResponse as $clave => $valor) {
        if ($valor['status'] == false) {
            $app->mensaje->petResponse($valor);
            break;
        }
    }
}


function getOptions($database, $_tabla, $_condicional)
{
    $arrayReturn = array();

    $mysqlQuery = "SELECT id,nombre ";
    $mysqlQuery .= "FROM " . $_tabla . " ";
    $mysqlQuery .= "WHERE " . $_condicional . " ";
    $mysqlQuery .= "ORDER BY nombre ASC;";

    $mysqlStmt = $database->getPDO()->prepare($mysqlQuery);

    if ($mysqlStmt->execute()) {
        if (intval($mysqlStmt->rowCount()) > 0) {
            while ($row = $mysqlStmt->fetch(PDO::FETCH_NUM)) {
                array_push($arrayReturn, array('id' => ($row[0]), 'nombre' => htmlspecialchars($row[1])));
            }
        }
        $mysqlStmt->closeCursor();
    }

    return $arrayReturn;
}

function getRadioCriterio($database, $_condicional)
{
    $arrayReturn = array();

    $mysqlQuery = "SELECT id,titulo,respuesta,por_defecto,por_rapido ";
    $mysqlQuery .= "FROM criterio_ingreso ";
    $mysqlQuery .= "WHERE " . $_condicional . " ";
    $mysqlQuery .= "ORDER BY id ASC;";

    $mysqlStmt = $database->getPDO()->prepare($mysqlQuery);

    if ($mysqlStmt->execute()) {
        if (intval($mysqlStmt->rowCount()) > 0) {
            while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {
                array_push($arrayReturn,
                    array(
                        'id' => ($row['id']),
                        'titulo' => htmlspecialchars($row['titulo']),
                        'respuesta' => json_decode($row['respuesta'], true),
                        'defecto' => htmlspecialchars($row['por_defecto']),
                        'rapido' => htmlspecialchars($row['por_rapido']),
                    )
                );
            }
        }
        $mysqlStmt->closeCursor();
    }

    return $arrayReturn;
}