<?php
class DashboardClass
{

    private $pdo = null;
    private $arrayResponse = array();

    public function __construct($_pdo)
    {
        $this->pdo = $_pdo;
    }

    public function getDatosMes(
        $_mes = 'ACTUAL'
    ) {

        $ingresoArray = array();
        $mysqlArray = array(
            'tipo' => ($_mes == 'ACTUAL') ? 'ACTUAL' : 'ANTERIOR',
            'ingreso' => $ingresoArray,
            'mes' => 0,
        );

        try {

            $mysqlQuery = "SELECT ";
            $mysqlQuery .= "COUNT(igr.id) AS total, ";
            $mysqlQuery .= "tip.nombre, tip.id AS id_tipo, ";
            if ($_mes == "ACTUAL") {
                $mysqlQuery .= "MONTH(CURRENT_DATE()) AS mes ";
            } else {
                $mysqlQuery .= "MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AS mes ";
            }
            $mysqlQuery .= "FROM ";
            $mysqlQuery .= "tipo_vehiculo tip ";
            $mysqlQuery .= "LEFT JOIN ";
            $mysqlQuery .= "vehiculo veh ON veh.id_tipo_vehiculo = tip.id ";
            $mysqlQuery .= "LEFT JOIN ";
            $mysqlQuery .= "ingreso igr ON igr.id_vehiculo = veh.id ";
            $mysqlQuery .= "AND igr.vez = 1 ";
            $mysqlQuery .= "AND MONTH(igr.fecha_formulario) = ";
            if ($_mes == "ACTUAL") {
                $mysqlQuery .= "MONTH(CURRENT_DATE()) ";
            } else {
                $mysqlQuery .= "MONTH(CURRENT_DATE - INTERVAL 1 MONTH) ";
            }
            $mysqlQuery .= "WHERE tip.id > 1 ";
            $mysqlQuery .= "GROUP BY tip.nombre ";
            $mysqlQuery .= "ORDER BY tip.id ASC;";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {

                        if ($mysqlArray['mes'] == 0) {
                            $mysqlArray['mes'] = $row['mes'];
                        }
                        array_push(
                            $ingresoArray,
                            array(
                                'total' => ($row['total']),
                                'nombre' => htmlspecialchars($row['nombre']),
                                'id_tipo' => ($row['id_tipo']),
                            )
                        );
                    }
                    $mysqlArray['ingreso'] = $ingresoArray;

                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'bien',
                        'message' => 'Bien, encontrado.',
                        'elemento' => $mysqlArray,
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
    public function getDatosOchoDias(
    ) {

        $ingresoArray = array();
        $mysqlArray = array();
        $arrayDefault = 'default';

        try {

            $mysqlQuery = "SELECT ";
            $mysqlQuery .= "COUNT(igr.id) AS total, ";
            $mysqlQuery .= "DATE(igr.fecha_formulario) As fecha, ";
            $mysqlQuery .= "tip.nombre,tip.id AS id_tipo ";
            $mysqlQuery .= "FROM ";
            $mysqlQuery .= "ingreso igr ";
            $mysqlQuery .= "LEFT JOIN ";
            $mysqlQuery .= "vehiculo veh ON igr.id_vehiculo = veh.id ";
            $mysqlQuery .= "LEFT JOIN ";
            $mysqlQuery .= "tipo_vehiculo tip ON veh.id_tipo_vehiculo = tip.id ";
            $mysqlQuery .= "WHERE ";
            $mysqlQuery .= "tip.id > 1 ";
            $mysqlQuery .= "AND igr.vez = 1 ";
            $mysqlQuery .= "AND DATE(igr.fecha_formulario) BETWEEN DATE_ADD(CURDATE(), INTERVAL -7 DAY) AND CURDATE() ";
            //$mysqlQuery .= "AND DATE(igr.fecha_formulario) BETWEEN '2022-10-20' AND '2022-10-27' ";
            $mysqlQuery .= "GROUP BY fecha,tip.nombre ";
            $mysqlQuery .= "ORDER BY fecha ASC;";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {

                        if (!isset($mysqlArray[getSpecialDate($row['fecha'])]['liviano'])) {
                            $mysqlArray[getSpecialDate($row['fecha'])]['liviano'] = $arrayDefault;
                        }
                        if (!isset($mysqlArray[getSpecialDate($row['fecha'])]['4x4'])) {
                            $mysqlArray[getSpecialDate($row['fecha'])]['4x4'] = $arrayDefault;
                        }
                        if (!isset($mysqlArray[getSpecialDate($row['fecha'])]['moto'])) {
                            $mysqlArray[getSpecialDate($row['fecha'])]['moto'] = $arrayDefault;
                        }
                        if (!isset($mysqlArray[getSpecialDate($row['fecha'])]['remolque'])) {
                            $mysqlArray[getSpecialDate($row['fecha'])]['remolque'] = $arrayDefault;
                        }
                        if (!isset($mysqlArray[getSpecialDate($row['fecha'])]['taxi'])) {
                            $mysqlArray[getSpecialDate($row['fecha'])]['taxi'] = $arrayDefault;
                        }
                        $mysqlArray[getSpecialDate($row['fecha'])][strtolower($row['nombre'])] = array(
                            "total" => ($row['total']),
                            "tipo" => ($row['id_tipo']),
                        );
                    }

                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'bien',
                        'message' => 'Bien, encontrado.',
                        'elemento' => $mysqlArray,
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