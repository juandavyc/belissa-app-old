<?php

class ReadVehiculoPeritaje
{

    private $pdo = null;

    private $arrayResponse = array();

    public function __construct($_pdo)
    {
        $this->pdo = $_pdo;
    }

    public function getVehiculoPeritaje(
        $_datos = array(
            'TYPE' => 'ID',
            'VALUE' => '1',
            'LIMIT' => '0,1',
        )
    ) {
        // var_dump($_datos);
        $arrayCondicional = array(
            'ID' => 'peri.id',
        );

        $mysqlArray = array();

        try {

            $mysqlQuery = "SELECT ";
            $mysqlQuery .= "peri.id,veh.placa,veh.modelo,veh.cilindraje, veh.kilometraje, ";
            $mysqlQuery .= "veh.numero_motor,veh.vin,veh.numero_puertas,peri.fecha_formulario,peri.aseguradora_si_no, ";

            $mysqlQuery .= "veh.id AS vehiculo_id, ";
            $mysqlQuery .= "lin.id AS linea_id, lin.nombre AS linea_nombre, ";
            $mysqlQuery .= "mar.id AS marca_id, mar.nombre AS marca_nombre, ";
            $mysqlQuery .= "tca.id AS carroceria_id, tca.nombre AS carroceria_nombre, ";
            $mysqlQuery .= "tse.id AS servicio_id, tse.nombre AS servicio_nombre, ";
            $mysqlQuery .= "com.id AS combustible_id, com.nombre AS combustible_nombre, ";
            $mysqlQuery .= "nac.id AS nacionalidad_id, nac.nombre AS nacionalidad_nombre, ";
            $mysqlQuery .= "ase.id AS aseguradora_id, ase.nombre AS aseguradora_nombre, ";
            $mysqlQuery .= "dis.id AS diseno_id, dis.nombre AS diseno_nombre, ";
            $mysqlQuery .= "caj.id AS caja_id, caj.nombre AS caja_nombre, ";
            $mysqlQuery .= "cla.id AS clase_id, cla.nombre AS clase_nombre, ";
            $mysqlQuery .= "tip.id AS tipo_id, tip.nombre AS tipo_nombre, ";
            $mysqlQuery .= "pro.id AS propietario_id, pro.cedula AS propietario_cedula, pro.nombre AS nombre_propietario, ";
            $mysqlQuery .= "con.id AS conductor_id, con.cedula AS conductor_cedula ";
            $mysqlQuery .= "FROM peritaje peri ";

            $mysqlQuery .= "LEFT JOIN vehiculo veh  ON peri.id_vehiculo = veh.id  ";
            $mysqlQuery .= "LEFT JOIN tipo_carroceria tca ON veh.id_tipo_carroceria = tca.id  ";
            $mysqlQuery .= "LEFT JOIN color col ON veh.id_color = col.id  ";
            $mysqlQuery .= "LEFT JOIN tipo_servicio tse ON veh.id_tipo_servicio = tse.id  ";
            $mysqlQuery .= "LEFT JOIN combustible com ON veh.id_combustible = com.id  ";
            $mysqlQuery .= "LEFT JOIN tiempo_motor tim ON veh.id_tiempo_motor = tim.id  ";
            $mysqlQuery .= "LEFT JOIN nacionalidad nac ON veh.id_nacionalidad = nac.id  ";
            $mysqlQuery .= "LEFT JOIN servicio_especial ser ON veh.id_servicio_especial = ser.id  ";
            $mysqlQuery .= "LEFT JOIN pais pai ON veh.id_pais = pai.id  ";
            $mysqlQuery .= "LEFT JOIN aseguradora_soat ase ON veh.id_aseguradora_soat = ase.id  ";
            $mysqlQuery .= "LEFT JOIN diseno dis ON veh.id_diseno = dis.id  ";
            $mysqlQuery .= "LEFT JOIN tipo_caja caj ON veh.id_tipo_caja = caj.id  ";
            $mysqlQuery .= "LEFT JOIN clase cla ON veh.id_clase = cla.id  ";
            $mysqlQuery .= "LEFT JOIN tipo_vehiculo tip ON veh.id_tipo_vehiculo = tip.id  ";
            $mysqlQuery .= "LEFT JOIN linea lin ON veh.id_linea = lin.id ";
            $mysqlQuery .= "LEFT JOIN marca mar ON lin.id_marca = mar.id  ";
            $mysqlQuery .= "LEFT JOIN propietario pro ON veh.id_propietario = pro.id ";
            $mysqlQuery .= "LEFT JOIN conductor con ON veh.id_conductor = con.id ";
            $mysqlQuery .= "WHERE " . $arrayCondicional[$_datos['TYPE']] . " LIKE :value ";
            $mysqlQuery .= "ORDER BY peri.id ASC LIMIT " . $_datos['LIMIT'] . " ; ";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);
            $mysqlStmt->bindParam(':value', $_datos['VALUE'], PDO::PARAM_STR);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {

                        array_push(
                            $mysqlArray,
                            array(
                                'id' => ($row['id']),
                                'placa' => htmlspecialchars($row['placa']),
                                'tipo' => array(
                                    'id' => ($row['tipo_id']),
                                    'nombre' => htmlspecialchars($row['tipo_nombre']),
                                ),
                                'servicio' => array(
                                    'id' => ($row['servicio_id']),
                                    'nombre' => htmlspecialchars($row['servicio_nombre']),
                                ),
                                'clase' => array(
                                    'id' => ($row['clase_id']),
                                    'nombre' => htmlspecialchars($row['clase_nombre']),
                                ),
                                'marca' => array(
                                    'id' => ($row['marca_id']),
                                    'nombre' => htmlspecialchars($row['marca_nombre']),
                                ),
                                'linea' => array(
                                    'id' => ($row['linea_id']),
                                    'nombre' => htmlspecialchars($row['linea_nombre']),
                                ),
                                'modelo' => htmlspecialchars($row['modelo']),
                                'numero_motor' => htmlspecialchars($row['numero_motor']),
                                'numero_vin' => htmlspecialchars($row['vin']),
                                'cilindraje' => htmlspecialchars($row['cilindraje']),
                                'kilometraje' => htmlspecialchars($row['kilometraje']),
                                'carroceria' => array(
                                    'id' => ($row['carroceria_id']),
                                    'nombre' => htmlspecialchars($row['carroceria_nombre']),
                                ),

                                'numero_puertas' => htmlspecialchars($row['numero_puertas']),
                                'combustible' => array(
                                    'id' => ($row['combustible_id']),
                                    'nombre' => htmlspecialchars($row['combustible_nombre']),
                                ),

                                'diseno' => array(
                                    'id' => ($row['diseno_id']),
                                    'nombre' => htmlspecialchars($row['diseno_nombre']),
                                ),
                                'caja' => array(
                                    'id' => ($row['caja_id']),
                                    'nombre' => htmlspecialchars($row['caja_nombre']),
                                ),
                                'numero_vin' => htmlspecialchars($row['vin']),
                                'propietario' => array(
                                    'id' => ($row['propietario_id']),
                                    'documento' => htmlspecialchars($row['propietario_cedula']),
                                    'nombre' => htmlspecialchars($row['nombre_propietario']),
                                ),
                                'conductor' => array(
                                    'id' => ($row['conductor_id']),
                                    'documento' => htmlspecialchars($row['conductor_cedula']),
                                ),
                                'nacionalidad' => htmlspecialchars($row['nacionalidad_nombre']),
                                'fecha_peritaje' => htmlspecialchars($row['fecha_formulario']),
                                'aseguradora' => htmlspecialchars($row['aseguradora_si_no']),

                            )
                        );
                    }

                    $this->arrayResponse = array(
                        'status' => 'bien',
                        'message' => 'Vehículo encontrado',
                        'vehiculo' => $mysqlArray,
                    );
                    $mysqlStmt->closeCursor();
                } else {
                    $this->arrayResponse = array(
                        'status' => 'sin_resultados',
                        'message' => 'La búsqueda no arrojo ningún resultado, por favor inténtelo de nuevo o más tarde',
                    );
                }

            } else {
                $this->arrayResponse = array(
                    'status' => 'error',
                    'message' => 'Error en la consulta ',
                );
            }

        } catch (Throwable $th) {
            $this->arrayResponse = array(
                'status' => 'error',
                'message' => 'Error en la comunicación: ' . $th->getMessage(),
            );
        }

        return $this->arrayResponse;
    }

    public function getPruebaPeritaje(
        $_datos = array(
            'TYPE' => 'ID',
            'VALUE' => '1',
            'PRU' => '1',
            'LIMIT' => '0,1',

        )
    ) {
        // var_dump($_datos);
        $arrayCondicional = array(
            'ID' => 'prupe.id_peritaje',
            'PRU' => 'prupe.id_tipo_prueba',

        );

        $mysqlArray = array();

        try {

            $mysqlQuery = "SELECT ";
            $mysqlQuery .= "prupe.id,prupe.id_peritaje,prupe.valores,prupe.id_tipo_prueba,  ";
            $mysqlQuery .= "concat(usu.nombre,' ',usu.apellido) AS nombre_usuario,usu.firma ";

            $mysqlQuery .= "FROM prueba_peritaje prupe ";

            $mysqlQuery .= "LEFT JOIN usuario usu on prupe.id_usuario = usu.id  ";

            $mysqlQuery .= "WHERE " . $arrayCondicional[$_datos['TYPE']] . " LIKE :value ";
            $mysqlQuery .= "AND prupe.id_tipo_prueba = " . $_datos['PRU'] . " ";

            $mysqlQuery .= "ORDER BY prupe.id ASC LIMIT " . $_datos['LIMIT'] . " ; ";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);
            $mysqlStmt->bindParam(':value', $_datos['VALUE'], PDO::PARAM_STR);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {

                        array_push(
                            $mysqlArray,
                            array(
                                'id' => ($row['id']),
                                'tipo_prueba' => ($row['id_tipo_prueba']),
                                'valores' => (json_decode($row['valores'], true)),
                                'usuario' => array(
                                    'nombre' => htmlspecialchars($row['nombre_usuario']),
                                    'firma' => htmlspecialchars($row['firma']),
                                ),

                            )
                        );
                    }

                    $this->arrayResponse = array(
                        'status' => 'bien',
                        'message' => 'Pruebas encontradas',
                        'vehiculo' => $mysqlArray,
                    );
                    $mysqlStmt->closeCursor();
                } else {
                    $this->arrayResponse = array(
                        'status' => 'sin_resultados',
                        'message' => 'La búsqueda no arrojo ningún resultado, por favor inténtelo de nuevo o más tarde',
                    );
                }

            } else {
                $this->arrayResponse = array(
                    'status' => 'error',
                    'message' => 'Error en la consulta ',
                );
            }

        } catch (Throwable $th) {
            $this->arrayResponse = array(
                'status' => 'error',
                'message' => 'Error en la comunicación: ' . $th->getMessage(),
            );
        }

        return $this->arrayResponse;
    }

}