<?php

class VehiculoClass
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
        // inflabergas
        //var_dump( $_column);
        $arrayColumna = array(
            'ID' => 'veh.id',
            'PLACA' => 'veh.placa',
        );
        $mysqlArray = array();
        try {

            $mysqlQuery = "SELECT ";
            // columnas
            $mysqlQuery .= "veh.id, veh.placa, veh.modelo, veh.id_ensenanza,  ";
            $mysqlQuery .= "veh.fecha_formulario, veh.vin, veh.numero_puertas, ";
            $mysqlQuery .= "veh.pasajeros, veh.blindado, veh.polarizado, ";
            $mysqlQuery .= "veh.vin, ";
            $mysqlQuery .= "tve.id AS id_tipo, tve.nombre As tipo_nombre, ";
            $mysqlQuery .= "ser.id AS id_servicio, ser.nombre As servicio_nombre, ";
            $mysqlQuery .= "lin.id As id_linea, lin.nombre As linea_nombre, ";
            $mysqlQuery .= "mar.id As id_marca, mar.nombre As marca_nombre, ";
            $mysqlQuery .= "col.id As id_color, col.nombre As color_nombre, ";
            $mysqlQuery .= "usu.id AS id_usuario, usu.nombre AS nombre_usuario, ";
            $mysqlQuery .= "tmot.id AS id_tiempos_motor, tmot.nombre AS nombre_tiempos_motor, ";
            $mysqlQuery .= "tcaj.id AS id_tipo_caja, tcaj.nombre AS nombre_tipo_caja, ";
            $mysqlQuery .= "com.id AS id_combustible, com.nombre AS nombre_combustible, ";
            $mysqlQuery .= "tcar.id AS id_tipo_carroceria, tcar.nombre AS nombre_tipo_carroceria, ";
            $mysqlQuery .= "dise.id AS id_disenio, dise.nombre AS nombre_disenio, ";
            //propietario
            $mysqlQuery .= "prop.id As id_propietario, prop.nombre As nombre_propietario, prop.apellido As apellido_propietario,";
            $mysqlQuery .= "prop.documento As documento_propietario,prop.id_tipo_documento As tipo_doc_prop, ";
            $mysqlQuery .= "prop.telefono_3 As telefono_propietario, ";
            $mysqlQuery .= "prop.telefono_2 As telefono_propietario_2, prop.telefono_1 As telefono_propietario_1,";
            $mysqlQuery .= "prop.email As correo_propietario, prop.direccion As direccion_propietario,";
            // conductor
            $mysqlQuery .= "cond.id As id_conductor, cond.nombre As nombre_conductor, cond.apellido As apellido_conductor,";
            $mysqlQuery .= "cond.documento As documento_conductor, cond.id_tipo_documento As tipo_doc_cond, ";
            $mysqlQuery .= "cond.telefono_3 As telefono_conductor, ";
            $mysqlQuery .= "cond.telefono_2 As telefono_conductor_2, cond.telefono_1 As telefono_conductor_1,";
            $mysqlQuery .= "cond.email As correo_conductor, cond.direccion As direccion_conductor ";
            // tabla
            $mysqlQuery .= "FROM vehiculo veh ";
            // joins
            $mysqlQuery .= "LEFT JOIN tipo_vehiculo tve ON tve.id = veh.id_tipo_vehiculo ";
            $mysqlQuery .= "LEFT JOIN servicio_vehiculo ser ON ser.id = veh.id_servicio_vehiculo ";
            $mysqlQuery .= "LEFT JOIN linea lin ON lin.id = veh.id_linea ";
            $mysqlQuery .= "LEFT JOIN cliente prop ON prop.id = veh.id_propietario  ";
            $mysqlQuery .= "LEFT JOIN cliente cond ON cond.id = veh.id_conductor ";
            $mysqlQuery .= "LEFT JOIN marca mar ON mar.id = lin.id_marca ";
            $mysqlQuery .= "LEFT JOIN color col ON col.id = veh.id_color ";
            $mysqlQuery .= "LEFT JOIN tipo_carroceria tcar ON tcar.id = veh.id_tipo_carroceria ";
            $mysqlQuery .= "LEFT JOIN disenio dise ON dise.id = veh.id_disenio ";
            $mysqlQuery .= "LEFT JOIN usuario usu ON usu.id = usu.id  ";
            $mysqlQuery .= "LEFT JOIN tiempos_motor tmot ON tmot.id = veh.id_tiempos_motor ";
            $mysqlQuery .= "LEFT JOIN tipo_caja tcaj ON tcaj.id = veh.id_tipo_caja ";
            $mysqlQuery .= "LEFT JOIN combustible com ON com.id = veh.id_combustible ";
            $mysqlQuery .= "WHERE " . $arrayColumna[$_column] . " = :value ";
            $mysqlQuery .= "ORDER BY veh.id ASC LIMIT 0,1; ";

            // var_dump($mysqlQuery);

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);
            $mysqlStmt->bindParam(':value', $_value, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {
                        array_push(
                            $mysqlArray,
                            array(
                                'id' => ($row['id']),
                                'placa' => htmlspecialchars($row['placa']),
                                'modelo' => ($row['modelo']),
                                'ensenanza' => ($row['id_ensenanza']),
                                'numero_puertas' => ($row['numero_puertas']),
                                'pasajeros' => ($row['pasajeros']),
                                'blindado' => ($row['blindado']),
                                'polarizado' => ($row['polarizado']),
                                'vin' => htmlspecialchars($row['vin']),
                                'tipo' => array(
                                    'id' => ($row['id_tipo']),
                                    'nombre' => htmlspecialchars($row['tipo_nombre']),
                                ),
                                'linea' => array(
                                    'id' => ($row['id_linea']),
                                    'nombre' => htmlspecialchars($row['linea_nombre']),
                                ),
                                'marca' => array(
                                    'id' => ($row['id_marca']),
                                    'nombre' => htmlspecialchars($row['marca_nombre']),
                                ),

                                'color' => array(
                                    'id' => ($row['id_color']),
                                    'nombre' => htmlspecialchars($row['color_nombre']),
                                ),
                                'servicio' => array(
                                    'id' => ($row['id_servicio']),
                                    'nombre' => htmlspecialchars($row['servicio_nombre']),
                                ),
                                'propietario' => array(
                                    'id' => ($row['id_propietario']),
                                    'documento' => htmlspecialchars($row['documento_propietario']),
                                    'tipo_documento' => ($row['tipo_doc_prop']),
                                    'nombre' => htmlspecialchars($row['nombre_propietario']),
                                    'apellido' => htmlspecialchars($row['apellido_propietario']),
                                    'telefono' => htmlspecialchars($row['telefono_propietario']),
                                    'telefono_2' => htmlspecialchars($row['telefono_propietario_2']),
                                    'telefono_1' => htmlspecialchars($row['telefono_propietario_1']),
                                    'correo' => htmlspecialchars($row['correo_propietario']),
                                    'direccion' => htmlspecialchars($row['direccion_propietario']),
                                ),
                                'conductor' => array(
                                    'id' => ($row['id_conductor']),
                                    'documento' => htmlspecialchars($row['documento_conductor']),
                                    'tipo_documento' => ($row['tipo_doc_cond']),
                                    'nombre' => htmlspecialchars($row['nombre_conductor']),
                                    'apellido' => htmlspecialchars($row['apellido_conductor']),
                                    'telefono' => htmlspecialchars($row['telefono_conductor']),
                                    'telefono_2' => htmlspecialchars($row['telefono_conductor_2']),
                                    'telefono_1' => htmlspecialchars($row['telefono_conductor_1']),
                                    'correo' => htmlspecialchars($row['correo_conductor']),
                                    'direccion' => htmlspecialchars($row['direccion_conductor']),
                                ),
                                'usuario' => array(
                                    'id' => ($row['id_usuario']),
                                    'nombre' => ($row['nombre_usuario']),
                                ),
                                'tiempos_motor' => array(
                                    'id' => ($row['id_tiempos_motor']),
                                    'nombre' => ($row['nombre_tiempos_motor']),
                                ),
                                'tipo_caja' => array(
                                    'id' => ($row['id_tipo_caja']),
                                    'nombre' => ($row['nombre_tipo_caja']),
                                ),
                                'combustible' => array(
                                    'id' => ($row['id_combustible']),
                                    'nombre' => ($row['nombre_combustible']),
                                ),
                                'disenio' => array(
                                    'id' => ($row['id_disenio']),
                                    'nombre' => ($row['nombre_disenio']),
                                ),
                                'tipo_carroceria' => array(
                                    'id' => ($row['id_tipo_carroceria']),
                                    'nombre' => ($row['nombre_tipo_carroceria']),
                                ),
                            )
                        );
                    }
                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'bien',
                        'message' => 'Vehiculo (s) encontrado(s) ( ' . $mysqlStmt->rowCount() . ' )',
                        'vehiculo' => $mysqlArray,
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
        $_placa = 'aaa000',
        $_tipo = 1,
        $_servicio = 1,
        $_modelo = 1800,
        $_ensenanza = 1,
        $_linea = 1,
        $_color = 1,
        $_vin = 1,
        $_propietario = 1,
        $_conductor = 1,
        $_id_usuario = 1
    ) {

        $mysqlArray = array();
        try {

            $mysqlQuery = "CALL proc_vehiculo_update(";
            $mysqlQuery .= ":id, ";
            $mysqlQuery .= ":placa, ";
            $mysqlQuery .= ":tipo, ";
            $mysqlQuery .= ":servicio, ";
            $mysqlQuery .= ":modelo, ";
            $mysqlQuery .= ":ensenanza, ";
            $mysqlQuery .= ":linea, ";
            $mysqlQuery .= ":color, ";
            $mysqlQuery .= ":vin, ";
            $mysqlQuery .= ":propietario, ";
            $mysqlQuery .= ":conductor, ";
            $mysqlQuery .= ":usuario, ";
            $mysqlQuery .= " @response)";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':id', $_id, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':placa', $_placa, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':tipo', $_tipo, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':servicio', $_servicio, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':modelo', $_modelo, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':ensenanza', $_ensenanza, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':linea', $_linea, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':color', $_color, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':vin', $_vin, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':propietario', $_propietario, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':conductor', $_conductor, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':usuario', $_id_usuario, PDO::PARAM_INT);

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

    public function ListadoVehiculo($_condicional_ = array(
        'ORDER' => 'veh.id',
        'BY' => 'DESC',
        'PAGE' => '1',
        'ROWS' => '25',
        'COLUMN' => 'veh.id',
        'CONTENT' => '%%',

    )) {

        // return;
        $mysqlArray = array();
        try {

            #Contador
            $mysqlQueryCount = "SELECT COUNT(veh.id) AS MY_TOTAL_ROWS ";
            $mysqlQueryColumns = "SELECT ";
            #Columnas
            $mysqlQueryColumns .= "veh.id, veh.placa, ";
            $mysqlQueryColumns .= "veh.modelo, veh.fecha_formulario, "; //,en.nombre AS ensenanza,

            $mysqlQueryColumns .= "tve.id AS id_tipo, tve.nombre As tipo_nombre, ";
            $mysqlQueryColumns .= "ser.id AS id_servicio, ser.nombre As servicio_nombre, ";
            // $mysqlQueryColumns .= "lin.id As id_linea, lin.nombre As linea_nombre, ";
            $mysqlQueryColumns .= "mar.id As id_marca, mar.nombre As marca_nombre ";
            //  $mysqlQueryColumns .= "col.id As id_color, col.nombre As color_nombre ";
            #Tabla
            $mysqlQuery = "FROM ";
            $mysqlQuery .= "vehiculo veh ";
            $mysqlQuery .= "LEFT JOIN tipo_vehiculo tve ON tve.id = veh.id_tipo_vehiculo ";
            $mysqlQuery .= "LEFT JOIN servicio_vehiculo ser ON ser.id = veh.id_servicio_vehiculo ";
            $mysqlQuery .= "LEFT JOIN linea lin ON lin.id = veh.id_linea ";
            $mysqlQuery .= "LEFT JOIN marca mar ON mar.id = lin.id_marca ";
            // $mysqlQuery .= "LEFT JOIN color col ON col.id = veh.id_color ";
            // $mysqlQuery .= "LEFT JOIN ensenanza en ON en.id = veh.id_ensenanza ";

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
                                    'placa' => htmlspecialchars($row['placa']),
                                    'modelo' => ($row['modelo']),
                                    'tipo_nombre' => htmlspecialchars($row['tipo_nombre']),
                                    // 'linea_nombre' => htmlspecialchars($row['linea_nombre']),
                                    'marca_nombre' => htmlspecialchars($row['marca_nombre']),
                                    // 'color_nombre' => htmlspecialchars($row['color_nombre']),
                                    'servicio_nombre' => htmlspecialchars($row['servicio_nombre']),
                                    // 'ensenanza' => htmlspecialchars($row['ensenanza']),
                                    'fecha_formulario' => htmlspecialchars($row['fecha_formulario']),
                                    "opciones" => encrypt($row['id'], 1),
                                )
                            );
                        }
                        $this->arrayResponse = array(
                            'statusCode' => 200,
                            'statusText' => 'bien',
                            'message' => 'Resultados encontrados',
                            'elements' => $mysqlArrayElements,
                            'vehiculo' => $mysqlArray,
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

    public function EditVehiculo(
        $_id = 0,
        $placa = 'xxxxxx',
        $tipo_vehiculo = 1,
        $servicio_vehiculo = 1,
        $modelo = '1800',
        $ensenanza_vehiculo = 1,
        $editar_marca = 1,
        $editar_linea = 1,
        $editar_color = 1
    ) {

        $mysqlArray = array();
        try {
            $mysqlQuery = "CALL proc_editar_vehiculo(";

            $mysqlQuery .= ":id, ";
            $mysqlQuery .= ":placa, ";
            $mysqlQuery .= ":tipo, ";
            $mysqlQuery .= ":servicio, ";
            $mysqlQuery .= ":modelo, ";
            $mysqlQuery .= ":ensenanza, ";
            $mysqlQuery .= ":marca, ";
            $mysqlQuery .= ":linea, ";
            $mysqlQuery .= ":color, ";

            $mysqlQuery .= " @response)";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':id', $_id, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':placa', $placa, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':tipo', $tipo_vehiculo, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':servicio', $servicio_vehiculo, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':modelo', $modelo, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':ensenanza', $ensenanza_vehiculo, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':marca', $editar_marca, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':linea', $editar_linea, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':color', $editar_color, PDO::PARAM_INT);

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