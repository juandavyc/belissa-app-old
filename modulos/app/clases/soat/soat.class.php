<?php

class SoatClass
{

    private $pdo = null;
    private $arrayResponse = array();

    public function __construct($_pdo)
    {
        $this->pdo = $_pdo;
    }

    public function getHistorialVehiculo(
        $_column = 'ID',
        $_value = 0
    ) {

        $arrayColumna = array(
            'ID' => 'veh.id',
            'PLACA' => 'veh.placa',
        );

        $mysqlArray = array();
        $contadorArray = 1;
        try {

            $mysqlQuery = "SELECT ";
            // columnas
            $mysqlQuery .= "soa.id,ase.nombre,soa.fecha_expedicion, ";
            $mysqlQuery .= "DATE_ADD(soa.fecha_expedicion, INTERVAL 1 YEAR) As fecha_vencimiento, ";
            $mysqlQuery .= "CONCAT(usu.nombre,' ',usu.apellido) As responsable ";
            // tabla
            $mysqlQuery .= "FROM soat soa ";
            // joins
            $mysqlQuery .= "LEFT JOIN aseguradora ase ON ase.id = soa.id_aseguradora ";
            $mysqlQuery .= "LEFT JOIN vehiculo veh ON veh.id = soa.id_vehiculo ";
            $mysqlQuery .= "LEFT JOIN usuario usu ON usu.id = soa.id_usuario ";

            // condicional
            $mysqlQuery .= "WHERE " . $arrayColumna[$_column] . " LIKE :contenido ";
            $mysqlQuery .= "ORDER BY soa.id DESC; ";
            //echo $mysqlQuery;

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);
            $mysqlStmt->bindParam(':contenido', $_value, PDO::PARAM_STR);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {
                        array_push(
                            $mysqlArray, array(
                                'nro' => ($contadorArray++),
                                'aseguradora' => htmlspecialchars($row['nombre']),
                                'expedicion' => getSpecialDate($row['fecha_expedicion']),
                                'vencimiento' => getSpecialDate($row['fecha_vencimiento']),
                                'vigente' => ($row['fecha_vencimiento'] <= date('Y-m-d')),
                                'usuario' => htmlspecialchars($row['responsable']),
                            )
                        );
                    }
                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'bien',
                        'message' => 'Soat encontradas ( ' . $mysqlStmt->rowCount() . ' )',
                        'soat' => $mysqlArray,
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

    public function createSoat(
        $_aseguradora = 1,
        $_expedicion = '2000-01-01',
        $_vehiculo = 1,
        $_usuario = 1
    ) {
        try {
            $mysqlQuery = "INSERT INTO ";
            $mysqlQuery .= "soat";
            $mysqlQuery .= "(id_aseguradora,id_vehiculo,fecha_expedicion,";
            $mysqlQuery .= "id_usuario) ";
            $mysqlQuery .= "VALUES ";
            $mysqlQuery .= "(:aseguradora,:vehiculo,:expedicion,";
            $mysqlQuery .= ":usuario); ";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':aseguradora', $_aseguradora, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':vehiculo', $_vehiculo, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':expedicion', $_expedicion, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':usuario', $_usuario, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {

                $this->arrayResponse = array(
                    'statusCode' => 200,
                    'statusText' => 'bien',
                    'message' => 'El SOAT fue guardado correctamente',
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

}