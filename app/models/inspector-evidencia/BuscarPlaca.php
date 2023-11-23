<?php session_start();
header('Content-Type: application/json');
require $_SERVER["DOCUMENT_ROOT"] . '/app/config.php';
$app = new MyCallCenterApp();

$recursosResponse['session'] = $app->verificar->isVigenteSession('AJAX');

if (
    $recursosResponse['session']['status']
) {
    if (
        isset($_POST["value"]) &&
        isset($_POST["id"]) &&
        isset($_POST["column"]) &&
        isset($_POST["table"]) &&
        isset($_POST["parent_id"]) &&
        isset($_POST["parent_column"]) &&
        count($_POST) == 6
    ) {

        $responseStatus = 'error';
        $responseMessage = 'sin_iniciar_modulo';
        $responsePlacas = array();

        require $app->ruta->getDatabase();

        $database = new MyDatabase();

        $recursosResponse['database'] = $database->getEstado();

        if ($recursosResponse['database']['status'] === true) {

            try {

                $placa = htmlspecialchars($_POST["value"]).'%';
                
                $mysqlQuery = "
                SELECT 
                    ing.id, veh.placa
                FROM
                    ingreso ing
                        INNER JOIN
                    vehiculo veh ON ing.id_vehiculo = veh.id
                WHERE
                        veh.placa LIKE :value 
                        LIMIT 0,5;";
                /*
                WHERE
                    DATE(ing.fecha_formulario) = NOW()
                    AND
                        veh.placa LIKE :value 
                        LIMIT 0,5;";
                */
                
                     
                $mysqlStmt = $database->getPDO()->prepare($mysqlQuery);

                $mysqlStmt->bindParam(':value', $placa, PDO::PARAM_STR);

                $contador = 0;
                if ($mysqlStmt->execute()) {
                    if (intval($mysqlStmt->rowCount()) > 0) {
                        while ($row = $mysqlStmt->fetch(PDO::FETCH_NUM)) {
                            $responsePlacas[$contador] = array(
                                'id' => htmlspecialchars($row[1]),
                                'nombre' => htmlspecialchars($row[1]),
                            );
                            $contador++;
                        }
                        $responseStatus = 'bien';
                        $responseMessage = 'Placas encontradas';
                        $mysqlStmt->closeCursor();
                    } else {
                        $responseStatus = 'sin_resultados';
                        $responseMessage = 'Sin resultados';
                    }
                } else {
                    $responseMessage = 'Error en la consulta';
                }
                // $this->pdo = null;
            } catch (Throwable $th) {
                $responseMessage = 'Error en la consulta';
            }
        } else {
            $responseMessage = 'no_conectado';
        }

        $app->mensaje->petResponse(
            array(            
                'statusText' => $responseStatus,
                'message' => $responseMessage,
                'items' => $responsePlacas,
                'count' => $contador,
            )
        );
        exit;
    } else {
        $app->mensaje->petResponse($app->mensaje->getFormularioIcompleto());
    }
} else {
    foreach ($recursosResponse as $clave => $valor) {
        if ($valor['status'] == false) {
            $app->mensaje->petResponse($valor);
            break;
        }
    }
}
