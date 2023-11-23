<?php

class TarifaClass
{

    private $pdo = null;
    private $arrayResponse = array();

    public function __construct($_pdo)
    {
        $this->pdo = $_pdo;
    }

    public function ListadoTarifa($_condicional_ = array(
        'ORDER' => 'tar.id',
        'BY' => 'desc',
        'PAGE' => '1',
        'ROWS' => '25',
        'COLUMN' => 'tar.id',
        'CONTENT' => '%%',

    ))
    {

        // return;
        $mysqlArray = array();
        try {

            #Contador
            $mysqlQueryCount = "SELECT COUNT(tar.id) AS MY_TOTAL_ROWS ";
            $mysqlQueryColumns = "SELECT ";
            #Columnas
            $mysqlQueryColumns .= "tar.id,tar.desde,tar.hasta,tar.precio,titar.nombre, concat(usu.nombre,' ',usu.apellido) AS nombre_usuario,tar.fecha_formulario ";
            #Tabla
            $mysqlQuery = "FROM ";
            $mysqlQuery .= "tarifa tar ";
            $mysqlQuery .= "INNER JOIN tipo_tarifa titar ON tar.id_tipo_tarifa = titar.id  ";
            $mysqlQuery .= "INNER JOIN usuario usu ON tar.id_usuario = usu.id ";
          
          

            #Condicion
            $mysqlQuery .= "WHERE ";
            $mysqlQuery .= $_condicional_['COLUMN'] . " LIKE :contenido ";
            // $mysqlQuery .= "AND tige.is_visible = 1 ";

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
                    $mysqlArrayElements['SQL_COUNT'] = (strtolower($_condicional_['BY']) == 'desc') ? ($mysqlArrayElements['SQL_ROWS'] - $mysqlArrayElements['SQL_LIMIT']) : ($mysqlArrayElements['SQL_LIMIT'] + 1);
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
                                        (strtolower($_condicional_['BY']) == 'desc') ? $mysqlArrayElements['SQL_COUNT']-- : $mysqlArrayElements['SQL_COUNT']++
                                    ),
                                    "nombre_tarifa" => htmlspecialchars($row['nombre']),
                                    "desde" => htmlspecialchars($row['desde']),
                                    "hasta" => htmlspecialchars($row['hasta']),
                                    "precio" => htmlspecialchars('$ '.($row['precio'])),                                  
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
                            'tarifa' => $mysqlArray,
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

    public function CreateTarifa($_datos = array(
        "NOMBRE_TARIFA" => "",
        "USUARIO" => 1,

    ))
    {
        try {
            $mysqlQuery = "INSERT INTO ";
            $mysqlQuery .= "tarifa";
            $mysqlQuery .= "(nombre,";
            $mysqlQuery .= "id_usuario) ";
            $mysqlQuery .= "VALUES ";
            $mysqlQuery .= "(:nombre,";
            $mysqlQuery .= ":usuario); ";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':nombre', $_datos['NOMBRE_TARIFA'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':usuario', $_datos['USUARIO'], PDO::PARAM_INT);
           

            if ($mysqlStmt->execute()) {

                $this->arrayResponse = array(
                    'statusCode' => 200,
                    'statusText' => 'bien',
                    'message' => 'El Tipo de gestion "'.$_datos['NOMBRE_TARIFA'].'" se a creado',
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

    public function SetTarifa(
        $_id = 1,
        $id_usuario = 1
    ) {

        try {
            $mysqlQuery = "UPDATE tarifa ";
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
    public function InfoTarifa(
        $_id = 1
    ) {

        $mysqlArray = array();

        try {
            $mysqlQuery = "SELECT ";
            $mysqlQuery .= "tar.id, tar.desde, tar.hasta,tar.precio,titar.nombre ";
            $mysqlQuery .= "FROM ";
            $mysqlQuery .= "tarifa tar ";
            $mysqlQuery .= "INNER JOIN tipo_tarifa titar ON tar.id_tipo_tarifa = titar.id  ";
            $mysqlQuery .= "WHERE ";
            $mysqlQuery .= "tar.id = :id ";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':id', $_id, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {
                        $mysqlArray = array(
                            'id' => ($row['id']),
                            'desde' => ($row['desde']),
                            'hasta' => ($row['hasta']),
                            'precio' => ($row['precio']),
                            'nombre' => ($row['nombre']),
                         
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
    public function EditTarifa(
        $_id = 1,
        $desde,
        $hasta,
        $precio,
        $id_usuario = 1
    ) {
        try {
            $mysqlQuery = "UPDATE tarifa ";
            $mysqlQuery .= "SET desde = :desde, ";
            $mysqlQuery .= "hasta = :hasta, ";
            $mysqlQuery .= "precio = :precio, ";
            $mysqlQuery .= "id_usuario = :usuario ";
            $mysqlQuery .= "WHERE id = :id; ";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':usuario', $id_usuario, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':id', $_id, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':desde', $desde, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':hasta', $hasta, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':precio', $precio, PDO::PARAM_STR);


            if ($mysqlStmt->execute()) {
                $this->arrayResponse = array(
                    'statusCode' => 200,
                    'statusText' => 'bien',
                    'message' => 'La tarifa se a actualizado ',
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
    public function getBuscadorTarifa()
    {
        $mysqlArray = array();
        try {
            $mysqlQuery = "SELECT ";
            $mysqlQuery .= "tar.desde,tar.hasta,tar.precio,titar.nombre ";
            $mysqlQuery .= "FROM ";
            $mysqlQuery .= "tarifa tar ";
            $mysqlQuery .= "INNER JOIN tipo_tarifa titar ON tar.id_tipo_tarifa = titar.id  ;";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $contador = 1;             

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {
                        array_push(
                            $mysqlArray,
                            array(
                            'NRO'=> $contador++,
                            'desde' => ($row['desde']), 
                            'hasta' => ($row['hasta']),   
                            'precio' =>'$ '.($row['precio']),
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
