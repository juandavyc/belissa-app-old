<?php

class BelissaLogClass
{

    private $pdo = null;
    private $arrayResponse = array();

    public function __construct($_pdo)
    {
        $this->pdo = $_pdo;
    }

    public function ListadoBelissa($_condicional_ = array(
        'ORDER' => 'bel.id',
        'BY' => 'DESC',
        'PAGE' => '1',
        'ROWS' => '25',
        'COLUMN' => 'bel.id',
        'CONTENT' => '%%',
        'USUARIO' => 0,
        'TIPO' => 1,
        'MODULO' => 1,
        'FINICIAL' => '2000-01-01',
        'FFINAL' => '2000-01-01',
    ))
    {
        // var_dump($_condicional_);


        // return;
        $mysqlArray = array();
        try {

            #Contador
            $mysqlQueryCount = "SELECT COUNT(bel.id) AS MY_TOTAL_ROWS ";
            $mysqlQueryColumns = "SELECT ";
            #Columnas
            $mysqlQueryColumns .= "bel.id, bel_tip.nombre As tipo, bel_mod.nombre as modulo,usu.nombre AS usuario, bel.fecha_formulario ";
            $mysqlQuery = "FROM ";
            $mysqlQuery .= "belissa_log bel ";
            $mysqlQuery .= "INNER JOIN belissa_tipo bel_tip ON bel_tip.id = bel.id_belissa_tipo ";
            $mysqlQuery .= "INNER JOIN belissa_modulo bel_mod ON bel_mod.id = bel.id_belissa_modulo ";
            $mysqlQuery .= "INNER JOIN usuario usu ON usu.id = bel.id_usuario ";
            $mysqlQuery .= "WHERE ";
            $mysqlQuery .= "DATE(bel.fecha_formulario) BETWEEN :finicial AND :ffinal AND ";
            $mysqlQuery .= $_condicional_['COLUMN'] . " LIKE :contenido AND  ";
            $mysqlQuery .= "bel_tip.id LIKE :tipo AND usu.id LIKE :usuario  AND bel_mod.id LIKE :modulo ";
            $mysqlQuery .= "ORDER BY " . $_condicional_['ORDER'] . " " . $_condicional_['BY'] . " ";
            // $mysqlQuery .= "ORDER BY " . $_condicional_['ORDER'] . " " . $_condicional_['BY'] . " ";

            $mysqlQueryCount .= $mysqlQuery;
            $mysqlQueryColumns .= $mysqlQuery;
 
            // var_dump( $mysqlQueryColumns);
// 
            $mysqlStmt = $this->pdo->prepare($mysqlQueryCount);

            $mysqlStmt->bindParam(':contenido', $_condicional_['CONTENT'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':tipo', $_condicional_['TIPO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':usuario', $_condicional_['USUARIO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':modulo', $_condicional_['MODULO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':finicial', $_condicional_['FINICIAL'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':ffinal', $_condicional_['FFINAL'], PDO::PARAM_STR);

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
                    $mysqlStmt->bindParam(':tipo', $_condicional_['TIPO'], PDO::PARAM_STR);
                    $mysqlStmt->bindParam(':usuario', $_condicional_['USUARIO'], PDO::PARAM_STR);
                    $mysqlStmt->bindParam(':modulo', $_condicional_['MODULO'], PDO::PARAM_STR);
                    $mysqlStmt->bindParam(':finicial', $_condicional_['FINICIAL'], PDO::PARAM_STR);
                    $mysqlStmt->bindParam(':ffinal', $_condicional_['FFINAL'], PDO::PARAM_STR);

                    if ($mysqlStmt->execute()) {

                        while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {

                            array_push(
                                $mysqlArray,
                                array(
                                    "nro" => htmlspecialchars(
                                        (strtolower($_condicional_['BY']) == 'asc') ? $mysqlArrayElements['SQL_COUNT']-- : $mysqlArrayElements['SQL_COUNT']++
                                    ),
                                    'tipo' => htmlspecialchars($row['tipo']),
                                    'modulo' => ($row['modulo']),
                                    'usuario' => ($row['usuario']),
                                    'fecha' => ($row['fecha_formulario']),
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
    public function infoBelissa($_id = 0)
    {

        // return;
        $mysqlArray = array();
        try {
            $mysqlQuery = "SELECT ";
            $mysqlQuery .= "bel.descripcion, bel_tip.nombre AS tipo_bel, bel_mod.nombre AS nombre_mod, usu.nombre AS usuario_nombre, bel.fecha_formulario ";
            $mysqlQuery .= "FROM ";
            $mysqlQuery .= "belissa_log bel ";
            $mysqlQuery .= "INNER JOIN belissa_tipo bel_tip ON bel_tip.id = bel.id_belissa_tipo ";
            $mysqlQuery .= "INNER JOIN belissa_modulo bel_mod ON bel_mod.id = bel.id_belissa_modulo ";
            $mysqlQuery .= "INNER JOIN usuario usu ON usu.id = bel.id_usuario ";
            $mysqlQuery .= "WHERE ";
            $mysqlQuery .= "bel.id = :id ";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':id', $_id, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {
                        $mysqlArray = array(
                            // 'id' => ($row['id']),
                            'descripcion' => ($row['descripcion']),
                            'tipo_bel' => htmlspecialchars($row['tipo_bel']),
                            'nombre_mod' => htmlspecialchars($row['nombre_mod']),
                            'usuario' => htmlspecialchars($row['usuario_nombre']),
                            'fecha' => htmlspecialchars ($row['fecha_formulario']),
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

        // var_dump($this->arrayResponse);

        return $this->arrayResponse;
    }
}
