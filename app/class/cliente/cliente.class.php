<?php

class ClienteClass
{

    private $pdo = null;
    private $arrayResponse = array();

    public function __construct($_pdo)
    {
        $this->pdo = $_pdo;
    }

    public function getInformacion(
        $_column = 'ID',
        $_value = 0
    ) {

        $arrayColumna = array(
            'ID' => 'cli.id',
            'DOCUMENTO' => 'cli.documento',
        );
        $mysqlArray = array();
        try {

            $mysqlQuery = "SELECT ";
            // columnas
            $mysqlQuery .= "cli.id,cli.documento,cli.nombre,cli.apellido, ";
            $mysqlQuery .= "cli.telefono_1,cli.telefono_2,cli.telefono_3, ";
            $mysqlQuery .= "cli.email,cli.direccion, ";

            $mysqlQuery .= "tip.id As id_documento, tip.nombre As nombre_documento ";
            // tabla
            $mysqlQuery .= "FROM cliente cli ";
            // joins
            $mysqlQuery .= "LEFT JOIN tipo_documento tip ON tip.id = cli.id_tipo_documento ";
            $mysqlQuery .= "WHERE " . $arrayColumna[$_column] . " LIKE :value ";
            $mysqlQuery .= "ORDER BY cli.id ASC LIMIT 0,1;";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);
            $mysqlStmt->bindParam(':value', $_value, PDO::PARAM_STR);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {
                        array_push(
                            $mysqlArray,
                            array(
                                'id' => ($row['id']),
                                'documento' => array(
                                    'id' => ($row['id_documento']),
                                    'nombre' => htmlspecialchars($row['nombre_documento']),
                                    'numero' => htmlspecialchars($row['documento']),
                                ),
                                'nombre' => htmlspecialchars(trim($row['nombre'])),
                                'apellido' => htmlspecialchars(trim($row['apellido'])),
                                'telefono' => array(
                                    'uno' => htmlspecialchars($row['telefono_1']),
                                    'dos' => htmlspecialchars($row['telefono_2']),
                                    'tres' => htmlspecialchars($row['telefono_3']),
                                ),
                                'email' => htmlspecialchars($row['email']),
                                'direccion' => htmlspecialchars($row['direccion']),
                            )
                        );
                    }
                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'bien',
                        'message' => 'Cliente(s) encontrado(s) ( ' . $mysqlStmt->rowCount() . ' )',
                        'cliente' => $mysqlArray,
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
    public function updateInformacion(
        $_id = 0,
        $_id_vehiculo = 0,
        $_tipo = 0,
        $_documento = 0,
        $_nombre = 'nombre',
        $_apellido = 'apellido',
        $_telefono_1 = 0,
        $_telefono_2 = 0,
        $_telefono_3 = 0,
        $_email = 'email@servicio.com',
        $_direccion = 'direccion',
        $_rol = 1,
        $_id_usuario = 1
    ) {

        $mysqlArray = array();
        try {

            $mysqlQuery = "CALL proc_cliente_vehiculo_update(";
            $mysqlQuery .= ":id, ";
            $mysqlQuery .= ":vehiculo, ";
            $mysqlQuery .= ":tipo, ";
            $mysqlQuery .= ":documento, ";
            $mysqlQuery .= ":nombre, ";
            $mysqlQuery .= ":apellido, ";
            $mysqlQuery .= ":telefono_1, ";
            $mysqlQuery .= ":telefono_2, ";
            $mysqlQuery .= ":telefono_3, ";
            $mysqlQuery .= ":email, ";
            $mysqlQuery .= ":direccion, ";
            $mysqlQuery .= ":usuario, ";
            $mysqlQuery .= ":rol, ";
            $mysqlQuery .= " @response)";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':id', $_id, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':vehiculo', $_id_vehiculo, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':tipo', $_tipo, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':documento', $_documento, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':nombre', $_nombre, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':apellido', $_apellido, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':telefono_1', $_telefono_1, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':telefono_2', $_telefono_2, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':telefono_3', $_telefono_3, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':email', $_email, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':direccion', $_direccion, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':usuario', $_id_usuario, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':rol', $_rol, PDO::PARAM_INT);

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

    public function createInformacion(
        $_id_vehiculo = 0,
        $_tipo = 0,
        $_documento = 0,
        $_nombre = 'nombre',
        $_apellido = 'apellido',
        $_telefono_1 = 0,
        $_telefono_2 = 0,
        $_telefono_3 = 0,
        $_email = 'email@servicio.com',
        $_direccion = 'direccion',
        $_rol = 1,
        $_id_usuario = 1
    ) {

        $mysqlArray = array();
        try {

            $mysqlQuery = "CALL proc_cliente_vehiculo_create(";
            $mysqlQuery .= ":vehiculo, ";
            $mysqlQuery .= ":tipo, ";
            $mysqlQuery .= ":documento, ";
            $mysqlQuery .= ":nombre, ";
            $mysqlQuery .= ":apellido, ";
            $mysqlQuery .= ":telefono_1, ";
            $mysqlQuery .= ":telefono_2, ";
            $mysqlQuery .= ":telefono_3, ";
            $mysqlQuery .= ":email, ";
            $mysqlQuery .= ":direccion, ";
            $mysqlQuery .= ":usuario, ";
            $mysqlQuery .= ":rol, ";
            $mysqlQuery .= " @response)";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':vehiculo', $_id_vehiculo, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':tipo', $_tipo, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':documento', $_documento, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':nombre', $_nombre, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':apellido', $_apellido, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':telefono_1', $_telefono_1, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':telefono_2', $_telefono_2, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':telefono_3', $_telefono_3, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':email', $_email, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':direccion', $_direccion, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':usuario', $_id_usuario, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':rol', $_rol, PDO::PARAM_INT);
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
                        'id' => isset($responseArray[2]) ? $responseArray[2] : 'NO_APLICA',
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

    public function ListadoCliente($_condicional_ = array(
        'ORDER' => 'cli.id',
        'BY' => 'DESC',
        'PAGE' => '1',
        'ROWS' => '25',
        'COLUMN' => 'cli.id',
        'CONTENT' => '%%',

    ))
    {

        // return;
        $mysqlArray = array();
        try {

            #Contador
            $mysqlQueryCount = "SELECT COUNT(cli.id) AS MY_TOTAL_ROWS ";
            $mysqlQueryColumns = "SELECT ";
            #Columnas
            $mysqlQueryColumns .= "cli.id, concat(cli.nombre,' ',cli.apellido) AS nombre_cliente, cli.documento, cli.telefono_1, ";
            $mysqlQueryColumns .= "cli.email, cli.direccion,cli.fecha_formulario ";
            #Tabla
            $mysqlQuery = "FROM ";
            $mysqlQuery .= "cliente cli ";

            #Condicion
            $mysqlQuery .= "WHERE ";
            $mysqlQuery .= $_condicional_['COLUMN'] . " LIKE :contenido ";

            #Ordenamiento
            $mysqlQuery .= "ORDER BY " . $_condicional_['ORDER'] . " " . $_condicional_['BY'] . " ";
            #Une las consultas

            $mysqlQueryCount .= $mysqlQuery;
            $mysqlQueryColumns .= $mysqlQuery;
            // echo $mysqlQueryColumns;

            $mysqlStmt = $this->pdo->prepare($mysqlQueryCount);

            $mysqlStmt->bindParam(':contenido', $_condicional_['CONTENT'], PDO::PARAM_STR);

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

                    if ($mysqlStmt->execute()) {

                        while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {

                            array_push(
                                $mysqlArray,
                                array(
                                    "nro" => htmlspecialchars(
                                        (strtolower($_condicional_['BY']) == 'asc') ? $mysqlArrayElements['SQL_COUNT']-- : $mysqlArrayElements['SQL_COUNT']++
                                    ),
                                    'nombre_cliente' => htmlspecialchars($row['nombre_cliente']),
                                    'documento' => htmlspecialchars($row['documento']),
                                    'telefono_1' => htmlspecialchars($row['telefono_1']),
                                    'correo' => htmlspecialchars($row['email']),
                                    'direccion' => htmlspecialchars($row['direccion']),
                                    'fecha_formulario' => htmlspecialchars($row['fecha_formulario']),
                                    "opciones" => getEncriptado($row['id']),
                                )
                            );
                        }
                        $this->arrayResponse = array(
                            'statusCode' => 200,
                            'statusText' => 'bien',
                            'message' => 'Resultados encontrados',
                            'elements' => $mysqlArrayElements,
                            'cliente' => $mysqlArray,
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

        return $this->arrayResponse;
    }

    public function InfoCliente(
        $_id = 1
    ) {

        $mysqlArray = array();
        try {

            $mysqlQuery = "SELECT ";
            // columnas
            $mysqlQuery .= "cli.id, cli.nombre,cli.apellido, cli.documento, cli.telefono_1,cli.telefono_2, ";
            $mysqlQuery .= "cli.telefono_3,cli.email, cli.direccion,cli.fecha_formulario, tido.nombre AS tipo_documento, tido.id AS id_tipo_documento ";

            // tabla
            $mysqlQuery .= "FROM cliente cli ";
            // joins
            $mysqlQuery .= "INNER JOIN tipo_documento tido ON tido.id = cli.id_tipo_documento ";

            $mysqlQuery .= "WHERE ";
            $mysqlQuery .= "cli.id = :id ";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);
            $mysqlStmt->bindParam(':id', $_id, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {
                        array_push(
                            $mysqlArray,
                            array(
                                'id' => ($row['id']),
                                'nombre' => htmlspecialchars($row['nombre']),
                                'apellido' => htmlspecialchars($row['apellido']),
                                'documento' => htmlspecialchars($row['documento']),
                                'telefono_1' => htmlspecialchars($row['telefono_1']),
                                'telefono_2' => htmlspecialchars($row['telefono_2']),
                                'telefono_3' => htmlspecialchars($row['telefono_3']),
                                'correo' => htmlspecialchars($row['email']),
                                'direccion' => htmlspecialchars($row['direccion']),
                                'tipo_documento' => htmlspecialchars($row['id_tipo_documento']),

                            )
                        );
                    }
                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'bien',
                        'message' => 'Cliente (s) encontrado(s) ( ' . $mysqlStmt->rowCount() . ' )',
                        'cliente' => $mysqlArray,
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

    public function UpdateCliente(

        $_id = 1,
        $nombre = '',
        $apellido = '',
        $documento = 1,
        $tipo_documento = 1,
        $telefono_1 = 1,
        $telefono_2 = 1,
        $telefono_3 = 1,
        $correo = '',
        $direccion = '',
        $usuario = 1
    ) {
        try {

            $mysqlQuery = "CALL proc_actualizar_cliente(";
            $mysqlQuery .= ":id, ";
            $mysqlQuery .= ":nombre, ";
            $mysqlQuery .= ":apellido, ";
            $mysqlQuery .= ":tipo_documento, ";
            $mysqlQuery .= ":documento, ";
            $mysqlQuery .= ":telefono_1, ";
            $mysqlQuery .= ":telefono_2, ";
            $mysqlQuery .= ":telefono_3, ";
            $mysqlQuery .= ":correo, ";
            $mysqlQuery .= ":direccion, ";
            $mysqlQuery .= ":usuario, ";
            $mysqlQuery .= " @response)";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':id', $_id, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':documento', $documento, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':tipo_documento', $tipo_documento, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':telefono_1', $telefono_1, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':telefono_2', $telefono_2, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':telefono_3', $telefono_3, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':usuario', $usuario, PDO::PARAM_INT);

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
