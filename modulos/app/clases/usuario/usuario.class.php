<?php

class UsuarioClass
{

    private $pdo = null;
    private $arrayResponse = array();

    public function __construct($_pdo)
    {
        // var_dump($_pdo);
        $this->pdo = $_pdo;
    }

    public function ListadoUsuario($_condicional_ = array(
        'ORDER' => 'usu.id',
        'BY' => 'DESC',
        'PAGE' => '1',
        'ROWS' => '25',
        'COLUMN' => 'usu.id',
        'CONTENT' => '%%',
    )) {

        $mysqlArray = array();
        try {

            #Contador
            $mysqlQueryCount = "SELECT COUNT(usu.id) AS MY_TOTAL_ROWS ";
            $mysqlQueryColumns = "SELECT ";
            #Columnas
            $mysqlQueryColumns .= "usu.id, concat(usu.nombre,' ', usu.apellido) AS nombre_usuario, usu.documento, est_usu.nombre As nombre_estado, rang.modulos, 
            usu.fecha_formulario, rang.nombre AS nombre_rango ";
            #Tabla
            $mysqlQuery = "FROM ";
            $mysqlQuery .= "usuario usu ";
            $mysqlQuery .= "LEFT JOIN estado_usuario est_usu ON est_usu.id = usu.id_estado ";
            $mysqlQuery .= "LEFT JOIN rango rang ON rang.id = usu.id_rango ";
            #Condicion
            $mysqlQuery .= "WHERE ";
            $mysqlQuery .= $_condicional_['COLUMN'] . " LIKE :contenido ";
            $mysqlQuery .= "AND usu.is_visible = 1 ";

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
                                    "nombre" => htmlspecialchars($row['nombre_usuario']),
                                    "nombre_rango" => htmlspecialchars($row['nombre_rango']),
                                    "documento" => htmlspecialchars($row['documento']),
                                    "estado" => htmlspecialchars($row['nombre_estado']),
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
                            'usuario' => $mysqlArray,
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

    public function Createusuario($_datos = array(
        'ID' => 0,
        'FOTO' => '/images/sin_imagen.png',
        'NOMBRE' => '',
        'APELLIDO' => '',
        'DOCUMENTO' => '',
        'RANGO' => 1,
        'FECHA_NACIMIENTO' => '2999-01-01',
        'CONTRASENIA_USUARIO' => '',
        'FIRMA' => '/images/sin_firma.png',
        'TIPO_DOCUMENTO' => 1,
        'CORREO' => '',
        'CANAL' => 1,
        'TIPO_CANAL' => 1,
        'USUARIO' => 1,

    )) {

       
        try {
            $mysqlQuery = "CALL proc_gestionar_usuario(";

            $mysqlQuery .= ":foto, ";
            $mysqlQuery .= ":nombre, ";
            $mysqlQuery .= ":apellido, ";
            $mysqlQuery .= ":documento, ";
            $mysqlQuery .= ":rango, ";
            $mysqlQuery .= ":fecha_nacimiento, ";
            $mysqlQuery .= ":contrasenia, ";
            $mysqlQuery .= ":firma, ";
            $mysqlQuery .= ":tipo_documento, ";
            $mysqlQuery .= ":correo, ";
            $mysqlQuery .= ":canal, ";
            $mysqlQuery .= ":tipo_canal, ";
            $mysqlQuery .= ":usuario, ";

            $mysqlQuery .= " @response)";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':foto', $_datos['FOTO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':nombre', $_datos['NOMBRE'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':apellido', $_datos['APELLIDO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':documento', $_datos['DOCUMENTO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':rango', $_datos['RANGO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':fecha_nacimiento', $_datos['FECHA_NACIMIENTO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':contrasenia', $_datos['CONTRASENIA_USUARIO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':firma', $_datos['FIRMA'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':tipo_documento', $_datos['TIPO_DOCUMENTO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':correo', $_datos['CORREO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':canal', $_datos['CANAL'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':tipo_canal', $_datos['TIPO_CANAL'], PDO::PARAM_INT);
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

    public function SetUsuario(
        $_id = 1,
        $id_usuario = 1
    ) {

        try {
            $mysqlQuery = "UPDATE usuario ";
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
                    'message' => 'El usuario se a eliminado ',
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

    public function InfoUsuario(
        $_id = 1
    ) {

        $mysqlArray = array();

        try {
            $mysqlQuery = "SELECT ";
            $mysqlQuery .= "usu.id,concat(usu.nombre,' ',usu.apellido) AS nombre_usuario, concat(usua.nombre,' ',usua.apellido) AS nombre_responsable,
            ran.nombre AS rango_nombre ,usu.documento,usu.correo,usu.foto,usu.firma,usu.fecha_formulario,usu.fecha_nacimiento,
            esusu.nombre AS estado, ran.modulos ";
            $mysqlQuery .= "FROM ";
            $mysqlQuery .= "usuario usu ";
            $mysqlQuery .= "LEFT JOIN usuario usua ON usua.id = usu.id_usuario ";
            $mysqlQuery .= "LEFT JOIN rango ran ON ran.id = usu.id_rango ";
            $mysqlQuery .= "LEFT JOIN estado_usuario esusu ON esusu.id = usu.id_estado ";
            $mysqlQuery .= "WHERE ";
            $mysqlQuery .= "usu.id = :id ";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':id', $_id, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {
                        $mysqlArray = array(
                            'id' => ($row['id']),
                            'nombre_usuario' => ($row['nombre_usuario']),
                            'nombre_responsable' => ($row['nombre_responsable']),
                            'rango_nombre' => ($row['rango_nombre']),
                            'documento' => ($row['documento']),
                            'correo' => ($row['correo']),
                            'foto' => ($row['foto']),
                            'firma' => ($row['firma']),
                            'fecha' => ($row['fecha_formulario']),
                            'fecha_nacimiento' => ($row['fecha_nacimiento']),
                            'estado' => ($row['estado']),
                            'modulos' => ($row['modulos']),
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
    public function CreateCanalUsuario(
        $id_usuario_asignar= 1,
        $tipo_canal = 1,
        $nombre = '',
        $id = 1
       
    ) {
        try {
           
            $mysqlQuery = "CALL proc_crear_canal_usuario(";
            $mysqlQuery .= ":usuario_asignar, ";             
            $mysqlQuery .= ":tipo_canal, ";
            $mysqlQuery .= ":nombre, ";
            $mysqlQuery .= ":usuario, ";
            $mysqlQuery .= " @response)";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':usuario', $id, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':usuario_asignar', $id_usuario_asignar, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':tipo_canal', $tipo_canal, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);

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