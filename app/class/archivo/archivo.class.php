<?php

class ArchivoClass
{

    private $pdo = null;
    private $arrayResponse = array();

    public function __construct($_pdo)
    {
        // var_dump($_pdo);
        $this->pdo = $_pdo;
    }

    public function ListadoArchivo($_condicional_ = array(
        'ORDER' => 'arch.id',
        'BY' => 'DESC',
        'PAGE' => '1',
        'ROWS' => '25',
        'COLUMN' => 'arch.id',
        'CONTENT' => '%%',
        'TIPO' => '%%',
    ))
    {


        // return;
        $mysqlArray = array();
        try {

            #Contador
            $mysqlQueryCount = "SELECT COUNT(arch.id) AS MY_TOTAL_ROWS ";
            $mysqlQueryColumns = "SELECT ";
            #Columnas
            $mysqlQueryColumns .= "arch.id, arch.ruta, arch.nombre AS nombre_archivo,arch.tamano,tiarch.nombre,arch.fecha_formulario ";
            #Tabla
            $mysqlQuery = "FROM ";
            $mysqlQuery .= "archivo arch ";
            $mysqlQuery .= "LEFT JOIN tipo_archivo tiarch ON arch.id_tipo_archivo = tiarch.id ";

            #Condicion
            $mysqlQuery .= "WHERE ";
            $mysqlQuery .= $_condicional_['COLUMN'] . " LIKE :contenido ";
            $mysqlQuery .= "AND tiarch.id LIKE :tipo ";
            $mysqlQuery .= "AND arch.is_visible = 1 ";

            #Ordenamiento
            $mysqlQuery .= "ORDER BY " . $_condicional_['ORDER'] . " " . $_condicional_['BY'] . " ";
            #Une las consultas

            $mysqlQueryCount .= $mysqlQuery;
            $mysqlQueryColumns .= $mysqlQuery;
            // echo $mysqlQueryColumns;

            $mysqlStmt = $this->pdo->prepare($mysqlQueryCount);

            $mysqlStmt->bindParam(':contenido', $_condicional_['CONTENT'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':tipo', $_condicional_['TIPO'], PDO::PARAM_STR);

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

                    if ($mysqlStmt->execute()) {

                        while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {

                            array_push(
                                $mysqlArray,
                                array(
                                    "nro" => htmlspecialchars(
                                        (strtolower($_condicional_['BY']) == 'asc') ? $mysqlArrayElements['SQL_COUNT']-- : $mysqlArrayElements['SQL_COUNT']++
                                    ),
                                    // "ruta" => htmlspecialchars($row['ruta']),

                                    "nombre_archivo" => htmlspecialchars($row['nombre_archivo']),
                                    "tamano" => htmlspecialchars($row['tamano']),
                                    "tipo_archivo" => htmlspecialchars($row['nombre']),
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
                            'archivo' => $mysqlArray,
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

    public function CreateArchivo($_datos = array(
        "TIPO_ARCHIVO" => 1,
        "ARCHIVO" => "",
        "USUARIO" => 1,
        "NOMBRE_ARCHIVO" => "",
        "TAMANO_ARCHIVO" => "",
    ))
    {
        // var_dump($_datos);
        $mysqlArray = array();
        try {
       
            $mysqlQuery = "CALL proc_crear_archivo(";
            $mysqlQuery .= ":tipo_archivo, ";
            $mysqlQuery .= ":archivo, ";
            $mysqlQuery .= ":nombre_archivo, ";
            $mysqlQuery .= ":tamano_archivo, ";
            $mysqlQuery .= ":usuario, ";
            $mysqlQuery .= " @response)";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':tipo_archivo', $_datos['TIPO_ARCHIVO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':archivo', $_datos['ARCHIVO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':nombre_archivo', $_datos['NOMBRE_ARCHIVO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':tamano_archivo', $_datos['TAMANO_ARCHIVO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':usuario', $_datos['USUARIO'], PDO::PARAM_INT);

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

    public function LinkArchivo(
        $_id = 1
    ) {

        $mysqlArray = array();

        try {
            $mysqlQuery = "SELECT ";
            $mysqlQuery .= "id,ruta ";
            $mysqlQuery .= "FROM ";
            $mysqlQuery .= "archivo ";
            $mysqlQuery .= "WHERE ";
            $mysqlQuery .= "id = :id ";

            
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':id', $_id, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {
                        $mysqlArray = array(
                            'id' => ($row['id']),
                            'ruta' => ($row['ruta']),
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
    public function EliminarArchivo(
       
        $id = 1,
        $usuario = 1
        )
        {
         
            try {
           
                $mysqlQuery = "CALL proc_eliminar_archivo(";
                $mysqlQuery .= ":id, ";             
                $mysqlQuery .= ":usuario, ";
                $mysqlQuery .= " @response)";
                $mysqlStmt = $this->pdo->prepare($mysqlQuery);
    
                $mysqlStmt->bindParam(':id', $id, PDO::PARAM_INT);                
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
                            'ruta' => $responseArray[2],
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