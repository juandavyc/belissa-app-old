<?php

class TipoGestionClass
{

    private $pdo = null;
    private $arrayResponse = array();

    public function __construct($_pdo)
    {
        // var_dump($_pdo);
        $this->pdo = $_pdo;
    }

    public function ListadoTipoGestion($_condicional_ = array(
        'ORDER' => 'tige.id',
        'BY' => 'DESC',
        'PAGE' => '1',
        'ROWS' => '25',
        'COLUMN' => 'tige.id',
        'CONTENT' => '%%',

    ))
    {

        // return;
        $mysqlArray = array();
        try {

            #Contador
            $mysqlQueryCount = "SELECT COUNT(tige.id) AS MY_TOTAL_ROWS ";
            $mysqlQueryColumns = "SELECT ";
            #Columnas
            $mysqlQueryColumns .= "tige.id, tige.nombre AS nombre_tipo_gestion, concat(usu.nombre,' ',usu.apellido) AS nombre_usuario,tige.fecha_formulario ";
            #Tabla
            $mysqlQuery = "FROM ";
            $mysqlQuery .= "tipo_gestion tige ";
            $mysqlQuery .= "LEFT JOIN usuario usu ON tige.id_usuario = usu.id ";
          
          

            #Condicion
            $mysqlQuery .= "WHERE ";
            $mysqlQuery .= $_condicional_['COLUMN'] . " LIKE :contenido ";
            $mysqlQuery .= "AND tige.is_visible = 1 ";

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
                                    "nombre_tipo_gestion" => htmlspecialchars($row['nombre_tipo_gestion']),
                                    "nombre_usuario" => htmlspecialchars($row['nombre_usuario']),                                    
                                    "fecha_formulario" => getSpecialDateTime($row['fecha_formulario']),
                                    "opciones" => encrypt($row['id'], 1),
                                )
                            );
                        }
                        $this->arrayResponse = array(
                            'statusCode' => 200,
                            'statusText' => 'bien',
                            'message' => 'Resultados encontrados',
                            'elements' => $mysqlArrayElements,
                            'canal' => $mysqlArray,
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

    public function CreateTipoGestion($_datos = array(
        "NOMBRE_TIPO_GESTION" => "",
        "USUARIO" => 1,

    ))
    {
        try {
            $mysqlQuery = "INSERT INTO ";
            $mysqlQuery .= "tipo_gestion";
            $mysqlQuery .= "(nombre,";
            $mysqlQuery .= "id_usuario) ";
            $mysqlQuery .= "VALUES ";
            $mysqlQuery .= "(:nombre,";
            $mysqlQuery .= ":usuario); ";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':nombre', $_datos['NOMBRE_TIPO_GESTION'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':usuario', $_datos['USUARIO'], PDO::PARAM_INT);
           

            if ($mysqlStmt->execute()) {

                $this->arrayResponse = array(
                    'statusCode' => 200,
                    'statusText' => 'bien',
                    'message' => 'El Tipo de gestion "'.$_datos['NOMBRE_TIPO_GESTION'].'" se a creado',
                    'id' => $this->pdo->lastInsertId(),
                );

                $mysqlStmt->closeCursor();
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

    public function SetTipoGestion(
        $_id = 1,
        $id_usuario = 1
    ) {

        try {
            $mysqlQuery = "UPDATE tipo_gestion ";
            $mysqlQuery .= "SET is_visible = 2, ";
            $mysqlQuery .= "id_usuario = :usuario ";
            $mysqlQuery .= "WHERE id = :id; ";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':usuario', $id_usuario, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':id', $_id, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {
                $this->arrayResponse = array(
                    'statusCode' => 200,
                    'statusText' => 'bien',
                    'message' => 'El tipo de gestion se a eliminado ',
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
    public function InfoTipoGestion(
        $_id = 1
    ) {

        $mysqlArray = array();

        try {
            $mysqlQuery = "SELECT ";
            $mysqlQuery .= "tige.id, tige.nombre AS nombre_tipo_gestion ";
            $mysqlQuery .= "FROM ";
            $mysqlQuery .= "tipo_gestion tige ";
            $mysqlQuery .= "WHERE ";
            $mysqlQuery .= "tige.id = :id ";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':id', $_id, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {
                        $mysqlArray = array(
                            'id' => ($row['id']),
                            'nombre_tipo_gestion' => ($row['nombre_tipo_gestion']),
                         
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
    public function EditTipoGestion(
        $_id = 1,
        $nombre,
        $id_usuario = 1
    ) {
        try {
            $mysqlQuery = "UPDATE tipo_gestion ";
            $mysqlQuery .= "SET nombre = :nombre, ";
            $mysqlQuery .= "id_usuario = :usuario ";
            $mysqlQuery .= "WHERE id = :id; ";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':usuario', $id_usuario, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':id', $_id, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);


            if ($mysqlStmt->execute()) {
                $this->arrayResponse = array(
                    'statusCode' => 200,
                    'statusText' => 'bien',
                    'message' => 'El tipo de gestion se a actualizado ',
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
    public function getBuscadorTipoGestion()
    {
        $mysqlArray = array();
        try {
            $mysqlQuery = "SELECT ";
            $mysqlQuery .= "nombre ";
            $mysqlQuery .= "FROM ";
            $mysqlQuery .= "tipo_gestion ";
            $mysqlQuery .= "GROUP BY nombre ASC ;";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $contador = 1;             

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {
                        array_push(
                            $mysqlArray,
                            array(
                            'NRO'=> $contador++,
                            'nombre' => ($row['nombre']),                        
                            ),                                        
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
