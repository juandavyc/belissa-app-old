<?php

class RtmClass
{

    private $pdo = null;
    private $arrayResponse = array();

    public function __construct($_pdo)
    {
        $this->pdo = $_pdo;
    }

    public function getListado(
        $_tabla_columna = 'veh.placa',
        $_contenido = 'abc123'
    ) {

        $mysqlArray = array();
        $contadorArray = 1;
        try {

            $mysqlQuery = "SELECT ";
            // columnas
            $mysqlQuery .= "rtm_1.id, rtm_1.fecha_expedicion, ";
            $mysqlQuery .= "veh.id AS id_vehiculo,veh.placa AS placa_vehiculo, ";
            $mysqlQuery .= "tip.nombre AS tipo_vehiculo, ";
            # Gestion 22/11/2022
            $mysqlQuery .= "IFNULL(ges_1.id, 0) AS gestion_id,IFNULL(ges_1.revisado, 0) As revisado ";
            // tabla
            $mysqlQuery .= "FROM tecnicomecanica rtm_1 ";
            $mysqlQuery .= "LEFT JOIN tecnicomecanica rtm_2 ON (rtm_1.id_vehiculo = rtm_2.id_vehiculo AND rtm_1.id < rtm_2.id) ";
            $mysqlQuery .= "LEFT JOIN vehiculo veh ON veh.id = rtm_1.id_vehiculo ";
            # Gestion
            $mysqlQuery .= "LEFT JOIN gestion_vehiculo ges_1 ON veh.id = ges_1.id_vehiculo ";
            $mysqlQuery .= "LEFT JOIN gestion_vehiculo ges_2 ON (ges_1.id_vehiculo = ges_2.id_vehiculo AND ges_1.id < ges_2.id) ";

            $mysqlQuery .= "LEFT JOIN tipo_vehiculo tip ON veh.id_tipo_vehiculo = tip.id ";
            $mysqlQuery .= "LEFT JOIN cliente prop ON veh.id_propietario = prop.id ";
            $mysqlQuery .= "LEFT JOIN cliente cond ON veh.id_conductor = cond.id ";
            // condicional
            $mysqlQuery .= "WHERE rtm_2.id_vehiculo IS NULL ";
            $mysqlQuery .= "AND ges_2.id_vehiculo IS NULL ";
            $mysqlQuery .= "AND " . $_tabla_columna . " LIKE :contenido ";
            $mysqlQuery .= "ORDER BY placa_vehiculo ASC LIMIT 0,400; ";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);
            $mysqlStmt->bindParam(':contenido', $_contenido, PDO::PARAM_STR);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {
                        array_push(
                            $mysqlArray, array(
                                'nro' => ($contadorArray++),
                                'placa' => htmlspecialchars($row['placa_vehiculo']),
                                'tipo' => htmlspecialchars($row['tipo_vehiculo']),
                                'revisado' => array(
                                    'id' => $row['revisado'],
                                    'icono' => $row['revisado'] == 2 ? 'check' : 'minus',
                                    'texto' => $row['revisado'] == 2 ? 'REVISADO' : 'NO REVISADO',
                                ),
                                'opciones' => ($row['id_vehiculo']),
                            )
                        );
                    }
                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'bien',
                        'message' => 'Revisiones encontradas ( ' . $mysqlStmt->rowCount() . ' )',
                        'rtm' => $mysqlArray,
                    );
                    $mysqlStmt->closeCursor();
                } else {
                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'sin_resultados',
                        'message' => 'La búsqueda no arrojo ningún resultado, por favor inténtelo de nuevo o más tarde',
                    );
                }
            } else {
                $this->arrayResponse = array(
                    'statusCode' => 400,
                    'statusText' => 'error',
                    'message' => 'Error en la consulta ',
                );
            }
        } catch (Throwable $th) {
            $this->arrayResponse = array(
                'statusCode' => 500,
                'statusText' => 'error',
                'message' => 'Error en la comunicación: ' . $th->getMessage(),
            );
        }
        return $this->arrayResponse;
    }

    // rtm por vehiculo

    public function getHistorialVehiculo(
        $_column = 'ID',
        $_value = 0
    ) {

        $arrayColumna = array(
            'ID' => 'veh.id',
            'PLACA' => 'veh.placa',
        );
        $estadoRtm = array(
            1 => 'Aprobada',
            2 => "Rechazada",
            3 => "- No",
            4 => "Se retiro del CDA",
            5 => "No pudo completar pruebas",
        );
        $vencimiento = '';
        $mysqlArray = array();
        $contadorArray = 1;
        try {

            $mysqlQuery = "SELECT ";
            // columnas
            $mysqlQuery .= "rtm.id,cda.nombre,rtm.fecha_expedicion,rtm.id_estado, ";
            $mysqlQuery .= "DATE_ADD(rtm.fecha_expedicion, INTERVAL 1 YEAR) As fecha_vencimiento, ";
            $mysqlQuery .= "CONCAT(usu.nombre,' ',usu.apellido) As responsable ";
            // tabla
            $mysqlQuery .= "FROM tecnicomecanica rtm ";
            // joins
            $mysqlQuery .= "LEFT JOIN cda ON cda.id = rtm.id_cda ";
            $mysqlQuery .= "LEFT JOIN vehiculo veh ON veh.id = rtm.id_vehiculo ";
            $mysqlQuery .= "LEFT JOIN usuario usu ON usu.id = rtm.id_usuario ";

            // condicional
            $mysqlQuery .= "WHERE " . $arrayColumna[$_column] . " LIKE :contenido ";
            $mysqlQuery .= "ORDER BY rtm.id DESC; ";
            //echo $mysqlQuery;

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);
            $mysqlStmt->bindParam(':contenido', $_value, PDO::PARAM_STR);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {
                        if ($row['id_estado'] > 1 ) {
                            $vencimiento = '--/--/----';
                        }
                        else{
                            $vencimiento = getSpecialDate($row['fecha_vencimiento']);
                        }
                        array_push(
                            $mysqlArray,
                            array(
                                'nro' => ($contadorArray++),
                                'cda' => htmlspecialchars($row['nombre']),
                                'expedicion' => getSpecialDate($row['fecha_expedicion']),
                                'vencimiento' => $vencimiento,
                                'resultado' => ($estadoRtm[$row['id_estado']]),
                                'usuario' => htmlspecialchars($row['responsable']),
                            )
                        );
                    }
                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'bien',
                        'message' => 'Revisiones encontradas ( ' . $mysqlStmt->rowCount() . ' )',
                        'rtm' => $mysqlArray,
                    );
                    $mysqlStmt->closeCursor();
                } else {
                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'sin_resultados',
                        'message' => 'La búsqueda no arrojo ningún resultado, por favor inténtelo de nuevo o más tarde',
                    );
                }
            } else {
                $this->arrayResponse = array(
                    'statusCode' => 400,
                    'statusText' => 'error',
                    'message' => 'Error en la consulta ',
                );
            }
        } catch (Throwable $th) {
            $this->arrayResponse = array(
                'statusCode' => 500,
                'statusText' => 'error',
                'message' => 'Error en la comunicación: ' . $th->getMessage(),
            );
        }
        return $this->arrayResponse;
    }

    public function createRtm(
        $_cda = 1,
        $_expedicion = '2000-01-01',
        $_vehiculo = 1,
        $_usuario = 1
    ) {
        try {
            $mysqlQuery = "INSERT INTO ";
            $mysqlQuery .= "tecnicomecanica";
            $mysqlQuery .= "(id_cda,id_vehiculo,fecha_expedicion,";
            $mysqlQuery .= "id_usuario) ";
            $mysqlQuery .= "VALUES ";
            $mysqlQuery .= "(:cda,:vehiculo,:expedicion,";
            $mysqlQuery .= ":usuario); ";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':cda', $_cda, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':vehiculo', $_vehiculo, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':expedicion', $_expedicion, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':usuario', $_usuario, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {

                $this->arrayResponse = array(
                    'statusCode' => 200,
                    'statusText' => 'bien',
                    'message' => 'La revisión técnico mecánica fue guardada correctamente',
                    'id' => $this->pdo->lastInsertId(),
                );

                $mysqlStmt->closeCursor();
            } else {
                $this->arrayResponse = array(
                    'statusCode' => 500,
                    'statusText' => 'error',
                    'message' => 'Error en la consulta',
                );
            }
        } catch (Throwable $th) {
            $this->arrayResponse = array(
                'statusCode' => 500,
                'statusText' => 'error',
                'message' => 'Error en la comunicación: ' . $th->getMessage(),
            );
        }

        return $this->arrayResponse;

    }
    public function setRevisado(
        $_vehiculo = 1,
        $_usuario = 1
    ) {

        $mysqlArray = array();
        try {
            $mysqlQuery = "CALL proc_gestionar_vehiculo(";
            $mysqlQuery .= ":vehiculo, ";
            $mysqlQuery .= ":usuario, ";
            $mysqlQuery .= " @response)";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':vehiculo', $_vehiculo, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':usuario', $_usuario, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {
                $mysqlStmt->closeCursor();

                $mysqlQuery = "SELECT @response As response_procedure; ";
                $mysqlStmt = $this->pdo->prepare($mysqlQuery);

                if ($mysqlStmt->execute()) {

                    $responseArray = $mysqlStmt->fetch(PDO::FETCH_ASSOC);
                    $responseArray = json_decode($responseArray['response_procedure']);

                    $mysqlStmt->closeCursor();

                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => $responseArray[0],
                        'message' => $responseArray[1],
                    );
                } else {
                    $this->arrayResponse = array(
                        'statusCode' => 500,
                        'statusText' => 'error',
                        'message' => 'Error en la consulta # 2 ',
                    );
                }
            } else {
                $this->arrayResponse = array(
                    'statusCode' => 500,
                    'statusText' => 'error',
                    'message' => 'Error en la consulta # 1 ',
                );
            }
        } catch (Throwable $th) {
            $this->arrayResponse = array(
                'statusCode' => 500,
                'statusText' => 'error',
                'message' => 'Error en la comunicación: ' . $th->getMessage(),
            );
        }

        return $this->arrayResponse;
    }

}