<?php

class AgendamientoCanalClass
{

    private $pdo = null;
    private $arrayResponse = array();

    public function __construct($_pdo)
    {
        $this->pdo = $_pdo;
    }
    public function gestionarAgendamiento(
        $_id_agendamiento = 0,
        $_fecha = '2022-01-01',
        $_horario = 1,
        $_placa = 'ABC123',
        $_id_vehiculo = 1,
        $_tipo_vehiculo = 1,
        $_tipo_documento = 1,
        $_documento = 1110,
        $_id_documento = 1,
        $_nombre = 'SIN NOMBRE',
        $_apellido = 'SIN APELLIDO',
        $_telefono = 00000000,
        $_correo = 'email@email.com',
        $_enviar = 2,
        $_cupo = 1,
        $_id_usuario = 1
    ) {

        $mysqlArray = array();
        try {

            $mysqlQuery = "CALL proc_agendamiento_canal(";
            $mysqlQuery .= ":id_agendamiento, ";
            $mysqlQuery .= ":fecha, ";
            $mysqlQuery .= ":horario, ";
            $mysqlQuery .= ":placa, ";
            $mysqlQuery .= ":id_vehiculo, ";
            $mysqlQuery .= ":tipo_vehiculo, ";
            $mysqlQuery .= ":tipo_documento, ";
            $mysqlQuery .= ":documento, ";
            $mysqlQuery .= ":id_documento, ";
            $mysqlQuery .= ":nombre, ";
            $mysqlQuery .= ":apellido, ";
            $mysqlQuery .= ":telefono, ";
            $mysqlQuery .= ":correo, ";
            $mysqlQuery .= ":enviar, ";
            $mysqlQuery .= ":cupo, ";
            $mysqlQuery .= ":id_usuario, ";
            $mysqlQuery .= " @response)";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':id_agendamiento', $_id_agendamiento, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':fecha', $_fecha, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':horario', $_horario, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':placa', $_placa, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':id_vehiculo', $_id_vehiculo, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':tipo_vehiculo', $_tipo_vehiculo, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':tipo_documento', $_tipo_documento, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':documento', $_documento, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':id_documento', $_id_documento, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':nombre', $_nombre, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':apellido', $_apellido, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':telefono', $_telefono, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':correo', $_correo, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':enviar', $_enviar, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':cupo', $_cupo, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':id_usuario', $_id_usuario, PDO::PARAM_INT);

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
                        'id' => isset($responseArray[2]) ? getEncriptado($responseArray[2]) : 0,
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
                'message' => 'Error en la comunicación: dd' . $th->getMessage(),
            );
        }

        return $this->arrayResponse;

    }

    public function getBuscador(
        $_condicional_ = array(
            'ORDER' => 'agen.id',
            'BY' => 'DESC',
            'PAGE' => '1',
            'ROWS' => '25',
            'COLUMN' => 'agen.id',
            'CONTENT' => '%%',
            'TIPO' => '%%',
            'TIPO_FECHA' => 0,
            'FINICIAL' => '2022-01-01',
            'FFINAL' => '2030-01-01',
            'CANAL' => 0,
        )
    ) {


        // return;
        $mysqlArray = array();

        $tipoFecha = array(
            'agen.fecha',
            'DATE(agen.fecha_formulario)',
        );
        try {

            #Contador
            $mysqlQueryCount = "SELECT COUNT(agen.id) AS MY_TOTAL_ROWS ";
            $mysqlQueryColumns = "SELECT ";
            #Columnas
            $mysqlQueryColumns .= "agen.id, veh.placa,esagen.id AS id_estado, ";
            $mysqlQueryColumns .= "agen.fecha, hor.nombre AS horario, ";
            $mysqlQueryColumns .= "can.nombre AS canal,esagen.nombre AS estado, ";
            $mysqlQueryColumns .= "agen.fecha_formulario ";
            #Tabla
            $mysqlQuery = "FROM ";
            $mysqlQuery .= "agendamiento agen ";
            $mysqlQuery .= "LEFT JOIN vehiculo veh ON agen.id_vehiculo = veh.id ";
            $mysqlQuery .= "LEFT JOIN cliente cli ON agen.id_cliente = cli.id ";
            $mysqlQuery .= "LEFT JOIN horario hor ON agen.id_horario = hor.id ";
            $mysqlQuery .= "LEFT JOIN canal can ON agen.id_canal = can.id ";
            $mysqlQuery .= "LEFT JOIN estado_agendamiento esagen ON agen.id_estado_agendamiento = esagen.id ";
            #Condicion
            $mysqlQuery .= "WHERE ";
            $mysqlQuery .= $_condicional_['COLUMN'] . " LIKE :contenido ";
            $mysqlQuery .= "AND esagen.id LIKE :tipo ";
            $mysqlQuery .= "AND can.id_usuario_asignado LIKE :canal ";
            $mysqlQuery .= "AND DATE(" . $tipoFecha[$_condicional_['TIPO_FECHA']] . ") BETWEEN :finicial AND :ffinal ";
            #Ordenamiento
            $mysqlQuery .= "ORDER BY " . $_condicional_['ORDER'] . " " . $_condicional_['BY'] . " ";
            #Une las consultas
            $mysqlQueryCount .= $mysqlQuery;
            $mysqlQueryColumns .= $mysqlQuery;

        echo $mysqlQueryColumns;

            $mysqlStmt = $this->pdo->prepare($mysqlQueryCount);

            $mysqlStmt->bindParam(':contenido', $_condicional_['CONTENT'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':tipo', $_condicional_['TIPO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':finicial', $_condicional_['FINICIAL'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':ffinal', $_condicional_['FFINAL'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':canal', $_condicional_['CANAL'], PDO::PARAM_INT);

            # Se ejecuta
            if ($mysqlStmt->execute()) {
                $mysqlArrayElements['SQL_ROWS'] = intval($mysqlStmt->fetch(PDO::FETCH_ASSOC)['MY_TOTAL_ROWS']);
                if (intval($mysqlArrayElements['SQL_ROWS']) > 0) {
                    $mysqlStmt->closeCursor();
                    $mysqlArrayElements['SQL_TOTAL_PAGES'] = ceil($mysqlArrayElements['SQL_ROWS'] / $_condicional_['ROWS']);
                    $mysqlArrayElements['SQL_PAGE'] = ($_condicional_['PAGE']);
                    $mysqlArrayElements['SQL_LIMIT'] = (($mysqlArrayElements['SQL_PAGE'] - 1) * $_condicional_['ROWS']);
                    $mysqlArrayElements['SQL_COUNT'] = (strtolower($_condicional_['BY']) == 'asc') ? ($mysqlArrayElements['SQL_ROWS'] - $mysqlArrayElements['SQL_LIMIT']) : ($mysqlArrayElements['SQL_LIMIT'] + 1);
                    #SQL LIMITE
                    $mysqlQueryColumns .= "LIMIT " . $mysqlArrayElements['SQL_LIMIT'] . "," . $_condicional_['ROWS'] . ";";

                    $mysqlStmt = $this->pdo->prepare($mysqlQueryColumns);

                    $mysqlStmt->bindParam(':contenido', $_condicional_['CONTENT'], PDO::PARAM_STR);
                    $mysqlStmt->bindParam(':tipo', $_condicional_['TIPO'], PDO::PARAM_INT);
                    $mysqlStmt->bindParam(':finicial', $_condicional_['FINICIAL'], PDO::PARAM_STR);
                    $mysqlStmt->bindParam(':ffinal', $_condicional_['FFINAL'], PDO::PARAM_STR);
                    $mysqlStmt->bindParam(':canal', $_condicional_['CANAL'], PDO::PARAM_INT);

                    if ($mysqlStmt->execute()) {

                        while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {

                            array_push(
                                $mysqlArray,
                                array(
                                    "nro" => htmlspecialchars(
                                        (strtolower($_condicional_['BY']) == 'asc') ? $mysqlArrayElements['SQL_COUNT']-- : $mysqlArrayElements['SQL_COUNT']++
                                    ),

                                    "placa" => htmlspecialchars($row['placa']),
                                    #"nombre_cliente" => htmlspecialchars($row['nombre_cliente']),
                                    "asistir" => getSpecialDate($row['fecha']),
                                    "horario" => htmlspecialchars($row['horario']),
                                    "canal" => htmlspecialchars($row['canal']),
                                    "estado" => array(
                                        'id' => ($row['id_estado']),
                                        'nombre' => htmlspecialchars($row['estado']),
                                    ),
                                    "creado" => getSpecialDateTime($row['fecha_formulario']),
                                    "opciones" => getEncriptado($row['id']),
                                )
                            );
                        }
                        $this->arrayResponse = array(
                            'statusCode' => 200,
                            'statusText' => 'bien',
                            'message' => 'Resultados encontrados',
                            'elements' => $mysqlArrayElements,
                            'agendamiento' => $mysqlArray,
                        );
                        $mysqlStmt->closeCursor();
                    } else {
                        $this->arrayResponse = array(
                            'statusText' => 'error',
                            'message' => 'Error en la consulta # 2 ',
                        );
                    }
                } else {
                    $this->arrayResponse = array(
                        'statusCode' => 400,
                        'statusText' => 'sin_resultados',
                        'message' => 'La búsqueda no arrojo ningún resultado, por favor inténtelo de nuevo más tarde',
                    );
                }
            } else {
                $this->arrayResponse = array(
                    'statusCode' => 400,
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

        // var_dump($this->arrayResponse);

        return $this->arrayResponse;
    }

    public function getInformacion(
        $_id = 1
    ) {

        $mysqlArray = array();

        try {
            $mysqlQuery = "SELECT ";
            $mysqlQuery .= "agen.id, agen.fecha,agen.razon_anular, ";
            $mysqlQuery .= "veh.id AS id_vehiculo, veh.placa AS placa_vehiculo, ";
            $mysqlQuery .= "cli.id AS cliente_id, cli.nombre AS nombre_cliente, cli.apellido AS apellido_cliente,";
            $mysqlQuery .= "cli.telefono_2,cli.email, ";
            $mysqlQuery .= "hor.id AS id_horario,hor.nombre AS nombre_horario, ";
            $mysqlQuery .= "esagen.id AS id_estado,esagen.nombre AS nombre_estado, ";
            $mysqlQuery .= "can.id AS id_canal,can.nombre AS nombre_canal, ";
            $mysqlQuery .= "CONCAT(usu.nombre,' ',usu.apellido) AS nombre_usuario, ";
            $mysqlQuery .= "agen.fecha_formulario ";
            $mysqlQuery .= "FROM ";
            $mysqlQuery .= "agendamiento agen ";
            $mysqlQuery .= "LEFT JOIN vehiculo veh ON agen.id_vehiculo = veh.id ";
            $mysqlQuery .= "LEFT JOIN cliente cli ON agen.id_cliente = cli.id ";
            $mysqlQuery .= "LEFT JOIN horario hor ON agen.id_horario = hor.id ";
            $mysqlQuery .= "LEFT JOIN canal can ON agen.id_canal = can.id ";
            $mysqlQuery .= "LEFT JOIN estado_agendamiento esagen ON agen.id_estado_agendamiento = esagen.id ";
            $mysqlQuery .= "LEFT JOIN usuario usu ON agen.id_usuario = usu.id ";
            $mysqlQuery .= "WHERE ";
            $mysqlQuery .= "agen.id = :id ";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':id', $_id, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {
                        $mysqlArray = array(
                            'id' => ($row['id']),
                            'vehiculo' => array(
                                'id' => ($row['id_vehiculo']),
                                'placa' => htmlspecialchars($row['placa_vehiculo']),
                            ),
                            'cliente' => array(
                                'id' => ($row['id_vehiculo']),
                                'nombre' => htmlspecialchars($row['nombre_cliente']),
                                'apellido' => htmlspecialchars($row['apellido_cliente']),
                                'telefono' => htmlspecialchars($row['telefono_2']),
                                'correo' => htmlspecialchars($row['email']),
                            ),
                            'canal' => array(
                                'id' => ($row['id_canal']),
                                'nombre' => htmlspecialchars($row['nombre_canal']),
                            ),
                            'horario' => array(
                                'id' => ($row['id_horario']),
                                'nombre' => htmlspecialchars($row['nombre_horario']),
                            ),
                            'estado' => array(
                                'id' => ($row['id_estado']),
                                'nombre' => htmlspecialchars($row['nombre_estado']),
                            ),
                            'fecha' => getSpecialDate($row['fecha']),
                            'usuario' => htmlspecialchars($row['nombre_usuario']),
                            'fecha_agendo' => getSpecialDate($row['fecha_formulario']),
                            'razon' => htmlspecialchars($row['razon_anular']),

                        );
                    }
                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'bien',
                        'message' => $mysqlArray,
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
    public function SetAgen(
        $_id = 1,
        $razon = 1,
        $id_usuario = 1
    ) {

        try {
            $mysqlQuery = "UPDATE agendamiento ";
            $mysqlQuery .= "SET id_estado_agendamiento = 4, ";
            $mysqlQuery .= "razon_anular = :razon, ";
            $mysqlQuery .= "id_usuario = :usuario ";
            $mysqlQuery .= "WHERE id = :id; ";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':usuario', $id_usuario, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':id', $_id, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':razon', $razon, PDO::PARAM_STR);

            if ($mysqlStmt->execute()) {
                $this->arrayResponse = array(
                    'statusCode' => 200,
                    'statusText' => 'bien',
                    'message' => 'El Agendamiento se a anulado ',
                    'id' => $this->pdo->lastInsertId(),
                );

                $mysqlStmt->closeCursor();
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

    public function EditAgendamiento(
        $_id = 1,
        $fecha,
        $horario,
        $id_usuario = 1
    ) {
        try {
            $mysqlQuery = "UPDATE agendamiento ";
            $mysqlQuery .= "SET fecha = :fecha, id_horario = :horario, id_estado_agendamiento = 6, ";
            $mysqlQuery .= "fecha_formulario = now(), ";
            $mysqlQuery .= "id_usuario = :usuario ";
            $mysqlQuery .= "WHERE id = :id; ";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':usuario', $id_usuario, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':id', $_id, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':fecha', $fecha, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':horario', $horario, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {
                $this->arrayResponse = array(
                    'statusCode' => 200,
                    'statusText' => 'bien',
                    'message' => 'El agendamiento se a actualizado ',
                );

                $mysqlStmt->closeCursor();
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
    public function setCupos(
        $_id = 1,
        $_cupo = 1,
        $id_usuario = 1
    ) {
        try {
            $mysqlQuery = "UPDATE cupo_agendamiento SET cupo = :cupo, id_usuario = :usuario WHERE id = :id;";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':cupo', $_cupo, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':usuario', $id_usuario, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':id', $_id, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {
                $this->arrayResponse = array(
                    'statusCode' => 200,
                    'statusText' => 'bien',
                    'message' => 'Cupo actualizado ',
                );

                $mysqlStmt->closeCursor();
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

    public function getCupos()
    {
        $mysqlArray = array();

        try {
            $mysqlQuery = "SELECT ";
            $mysqlQuery .= "id,nombre,cupo ";
            $mysqlQuery .= "FROM ";
            $mysqlQuery .= "cupo_agendamiento ";
            $mysqlQuery .= "ORDER BY ";
            $mysqlQuery .= "id DESC;";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {

                        $mysqlArray[(strtolower($row['nombre']))] = array(
                            'id' => ($row['id']),
                            'nombre' => htmlspecialchars($row['nombre']),
                            'cupo' => ($row['cupo']),
                        );

                    }
                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'bien',
                        'message' => $mysqlArray,
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

    public function getCupoUsados()
    {
        $mysqlArray = array();

        try {
            $mysqlQuery = "SELECT ";
            $mysqlQuery .= "age.fecha,";
            $mysqlQuery .= "cup.nombre, ";
            $mysqlQuery .= "COUNT(age.id) AS usado, ";
            $mysqlQuery .= "(cup.cupo - COUNT(age.id)) AS libre ";
            $mysqlQuery .= "FROM ";
            $mysqlQuery .= "agendamiento age ";
            $mysqlQuery .= "INNER JOIN ";
            $mysqlQuery .= "vehiculo veh ON age.id_vehiculo = veh.id ";
            $mysqlQuery .= "INNER JOIN ";
            $mysqlQuery .= "cupo_agendamiento cup ON age.id_cupo_agendamiento = cup.id ";
            $mysqlQuery .= "WHERE ";
            $mysqlQuery .= "age.id_estado_agendamiento <> 4 ";
            $mysqlQuery .= "AND age.fecha BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 29 DAY) ";
            $mysqlQuery .= "GROUP BY cup.nombre,age.fecha ";
            $mysqlQuery .= "ORDER BY age.fecha ASC; ";
            $arrayDefault = 'default';

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);
            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {

                        if (!isset($mysqlArray[getSpecialDate($row['fecha'])]['MOTO'])) {
                            $mysqlArray[getSpecialDate($row['fecha'])]['MOTO'] = $arrayDefault;
                        }
                        if (!isset($mysqlArray[getSpecialDate($row['fecha'])]['LIVIANO'])) {
                            $mysqlArray[getSpecialDate($row['fecha'])]['LIVIANO'] = $arrayDefault;
                        }
                        $mysqlArray[getSpecialDate($row['fecha'])][$row['nombre']] = array(
                            "usado" => ($row['usado']),
                            "libre" => ($row['libre']),
                        );
                    }
                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'bien',
                        'message' => $mysqlArray,
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

}