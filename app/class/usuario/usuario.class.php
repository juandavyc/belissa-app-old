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
        'RANGO' => '%%',
        'ESTADO' => '%%'
    ))
    {

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
            $mysqlQuery .= "AND usu.id_rango LIKE :rango ";
            $mysqlQuery .= "AND usu.id_estado LIKE :estado  ";
            $mysqlQuery .= "AND usu.is_visible = 1 ";

            #Ordenamiento
            $mysqlQuery .= "ORDER BY " . $_condicional_['ORDER'] . " " . $_condicional_['BY'] . " ";
            #Une las consultas

            $mysqlQueryCount .= $mysqlQuery;
            $mysqlQueryColumns .= $mysqlQuery;
            // echo $mysqlQueryColumns;

            $mysqlStmt = $this->pdo->prepare($mysqlQueryCount);

            $mysqlStmt->bindParam(':contenido', $_condicional_['CONTENT'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':rango', $_condicional_['RANGO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':estado', $_condicional_['ESTADO'], PDO::PARAM_STR);

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
                    $mysqlStmt->bindParam(':rango', $_condicional_['RANGO'], PDO::PARAM_STR);
                    $mysqlStmt->bindParam(':estado', $_condicional_['ESTADO'], PDO::PARAM_STR);

                    if ($mysqlStmt->execute()) {

                        while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {

                            array_push(
                                $mysqlArray,
                                array(
                                    "nro" => htmlspecialchars(
                                        (strtolower($_condicional_['BY']) == 'asc') ? $mysqlArrayElements['SQL_COUNT']-- : $mysqlArrayElements['SQL_COUNT']++
                                    ),
                                    "documento" => htmlspecialchars($row['documento']),
                                    "nombre" => htmlspecialchars($row['nombre_usuario']),
                                    "nombre_rango" => htmlspecialchars($row['nombre_rango']),
                                    "estado" => htmlspecialchars($row['nombre_estado']),
                                    "fecha_formulario" => getSpecialDateTime($row['fecha_formulario']),
                                    "opciones" => getEncriptado($row['id']),
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

    public function gestionarUsuario(
        $id = 0,
        $foto = "/images/sin_imagen.png",
        $nombre = "no_name",
        $apellido = "no_lastname",
        $tipo_documento = 1,
        $documento = "0",
        $correo = "correo@example.com",
        $rango = 4,
        $nacimiento = "2000-01-01",
        $contrasenia = "contrasenia",
        $firma = "/images/sin_firma.png",
        $canal = 1,
        $tipo_canal = 1,
        $estado = 1,
        $usuario = 1
    ) {


        try {

            $mysqlQuery = "SELECT gestionarUsuario(:id, :foto, :nombre, :apellido, :tipo_documento, :documento, :correo, :rango, :nacimiento, :contrasenia, :firma, :canal, :tipo_canal,:estado, :usuario) AS resultado";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':foto', $foto, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':tipo_documento', $tipo_documento, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':documento', $documento, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':rango', $rango, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':nacimiento', $nacimiento, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':contrasenia', $contrasenia, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':firma', $firma, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':canal', $canal, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':tipo_canal', $tipo_canal, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':estado', $estado, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':usuario', $usuario, PDO::PARAM_INT);


            if ($mysqlStmt->execute()) {
                $tempResponse = json_decode($mysqlStmt->fetchColumn(), true);

                $tempResponse['usuario'] = json_decode($tempResponse['usuario'], true);
                $tempResponse['canal'] = json_decode($tempResponse['canal'], true);

                $this->arrayResponse = $tempResponse;
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

    public function InformacionUsuario(
        $_id = 1
    ) {

        $mysqlArray = array();

        try {
            $mysqlQuery = "SELECT 
            usu_act.id,
            usu_act.nombre,
            usu_act.apellido,
            usu_act.documento,
            usu_act.id_tipo_documento,
            usu_act.correo,
            usu_act.foto,
            usu_act.firma,
            usu_act.fecha_formulario,
            usu_act.fecha_nacimiento,
            usu_res.id AS responsable_id,
            usu_res.nombre AS responsable_nombre,
            usu_res.apellido AS responsable_apellido,
            esusu.nombre AS estado,
            rang.id AS rango_id,
            rang.nombre AS rango_nombre,
            rang.modulos
        FROM
            usuario usu_act
                INNER JOIN
            usuario usu_res ON usu_res.id = usu_act.id_usuario 
                INNER JOIN
            rango rang ON rang.id = usu_act.id_rango
                INNER JOIN
            estado_usuario esusu ON esusu.id = usu_act.id_estado
        WHERE
            usu_act.id = :id ";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':id', $_id, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {
                        $mysqlArray = array(
                            'id' => ($row['id']),
                            'nombre' => htmlspecialchars($row['nombre']),
                            'apellido' => htmlspecialchars($row['apellido']),
                            'documento' => htmlspecialchars($row['documento']),
                            'tipo_documento' => htmlspecialchars($row['id_tipo_documento']),
                            'correo' => htmlspecialchars($row['correo']),
                            'foto' => htmlspecialchars($row['foto']),
                            'firma' => htmlspecialchars($row['firma']),
                            'fecha_nacimiento' => getSpecialDate($row['fecha_nacimiento']),
                            'estado' => htmlspecialchars($row['estado']),
                            'rango' => array(
                                'id' => ($row['rango_id']),
                                'nombre' => htmlspecialchars($row['rango_nombre']),
                                'modulos' => ($row['modulos'])
                            ),
                            'responsable' => array(
                                'id' => ($row['responsable_id']),
                                'nombre' => htmlspecialchars($row['responsable_nombre']),
                                'apellido' => htmlspecialchars($row['responsable_apellido'])
                            ),
                            'fecha' => getSpecialDate($row['fecha_formulario']),
                        );
                    }
                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'bien',
                        'message' => 'Usuario encontrado',
                        'usuario' => $mysqlArray,
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
        $id_usuario_asignar = 1,
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
