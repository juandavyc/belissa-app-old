<?php

class EditarUsuarioClass
{

    private $pdo = null;
    private $arrayResponse = array();

    public function __construct($_pdo)
    {
        // var_dump($_pdo);
        $this->pdo = $_pdo;
    }

   
    public function CreateEditarUsuario($_datos = array(
        'ID' => 0,
        'FOTO' => '/images/sin_imagen.png',
        'NOMBRE' => '',
        'APELLIDO' => '',
        'DOCUMENTO' => '',
        'RANGO' => 1,
        'FECHA_NACIMIENTO' => '2999-01-01',
        'FIRMA' => '/images/sin_firma.png',
        'CORREO' => '',
        'USUARIO' => 1,
        'ESTADO_USUARIO' => 1,

    )) {

        $mysqlArray = array();
        try {
            $mysqlQuery = "CALL proc_editar_usuario(";

            $mysqlQuery .= ":id, ";
            $mysqlQuery .= ":foto, ";
            $mysqlQuery .= ":nombre, ";
            $mysqlQuery .= ":apellido, ";
            $mysqlQuery .= ":documento, ";
            $mysqlQuery .= ":rango, ";
            $mysqlQuery .= ":fecha_nacimiento, ";
            $mysqlQuery .= ":firma, ";
            $mysqlQuery .= ":correo, ";          
            $mysqlQuery .= ":usuario, ";
            $mysqlQuery .= ":estado_usuario, ";

            $mysqlQuery .= " @response)";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':id', $_datos['ID'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':foto', $_datos['FOTO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':nombre', $_datos['NOMBRE'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':apellido', $_datos['APELLIDO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':documento', $_datos['DOCUMENTO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':rango', $_datos['RANGO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':fecha_nacimiento', $_datos['FECHA_NACIMIENTO'], PDO::PARAM_STR);         
            $mysqlStmt->bindParam(':firma', $_datos['FIRMA'], PDO::PARAM_STR);           
            $mysqlStmt->bindParam(':correo', $_datos['CORREO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':usuario', $_datos['USUARIO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':estado_usuario', $_datos['ESTADO_USUARIO'], PDO::PARAM_INT);

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

    

    public function getEditarUsuario(
        $_id = 0
        

    ) {

        $mysqlArray = array();

        try {

            $mysqlQuery = "SELECT ";
            $mysqlQuery .= "usu.id,usu.nombre,usu.apellido,ran.nombre AS rango_nombre ,usu.documento,usu.correo,usu.foto,usu.firma,
            usu.fecha_nacimiento, esusu.nombre AS estado,ran.id AS id_rango,esusu.id AS id_estado,ran.nombre AS nombre_rango ";
            $mysqlQuery .= "FROM ";
            $mysqlQuery .= "usuario usu ";
            $mysqlQuery .= "LEFT JOIN rango ran ON ran.id = usu.id_rango ";
            $mysqlQuery .= "LEFT JOIN estado_usuario esusu ON esusu.id = usu.id_estado ";
            $mysqlQuery .= "WHERE ";
            $mysqlQuery .= "usu.id = :id ";

          

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':id', $_id, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {

                        array_push(
                            $mysqlArray,
                            array(
                                "id" => htmlspecialchars($row['id']),
                                "nombre" => htmlspecialchars($row['nombre']),
                                "apellido" => htmlspecialchars($row['apellido']),
                                "documento" => htmlspecialchars($row['documento']),
                                "correo" => htmlspecialchars($row['correo']),
                                "id_rango" => htmlspecialchars($row['id_rango']),
                                "rango" => htmlspecialchars($row['nombre_rango']),
                                "foto" => htmlspecialchars($row['foto']),
                                "firma" => htmlspecialchars($row['firma']),
                                "fecha_nacimiento" => htmlspecialchars($row['fecha_nacimiento']),
                                "estado" => htmlspecialchars($row['id_estado']),

                            )
                        );
                    }
                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'bien',
                        'message' => $mysqlArray ,
                        'editar_usuario' => $mysqlArray,
                    );
                    $mysqlStmt->closeCursor();
                } else {
                    $this->arrayResponse = array(
                        'statusCode' => 400,
                        'statusText' => 'error',
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