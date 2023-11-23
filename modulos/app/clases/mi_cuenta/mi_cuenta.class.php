<?php

class MiCuentaClass
{

    private $pdo = null;

    private $arrayResponse = array();

    public function __construct($_pdo)
    {
        $this->pdo = $_pdo;
    }

    public function getMiCuenta(
        $_id = 0

    ) {

        $mysqlArray = array();

        try {

            $mysqlQuery = "SELECT ";
            $mysqlQuery .= "usua.id,usua.documento, usua.nombre, usua.apellido, usua.foto, usua.firma,usua.id_style ";
            $mysqlQuery .= "FROM usuario usua ";

            $mysqlQuery .= "WHERE  usua.id = :id; ";

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
                                "foto" => htmlspecialchars($row['foto']),
                                "firma" => htmlspecialchars($row['firma']),
                                "interfaz" => htmlspecialchars($row['id_style']),
                            )
                        );
                    }
                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'bien',
                        'message' => 'Resultados encontrados',
                        'cuenta' => $mysqlArray,
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

    public function setCambioContrasena(

        $_contra_vieja = '',
        $_contra_nueva = '',
        $_id = 0

    ) {
        try {

            $mysqlQuery = "CALL proc_cambiar_contrasena (:contra_vieja,:contra_nueva, :id, @response); ";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':contra_vieja', $_contra_vieja, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':contra_nueva', $_contra_nueva, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':id', $_id, PDO::PARAM_INT);

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

    public function setDatosInformacion(
        $_nombre = '',
        $_apellido = '',
        $_foto = '',
        $_firma = '',
        $_interfaz = '',
        $_id = 0
    ) {

        $mysqlArray = array();

        try {

            $mysqlQuery = "UPDATE ";
            $mysqlQuery .= "usuario ";
            $mysqlQuery .= "SET ";
            $mysqlQuery .= "nombre = :nombre, apellido = :apellido, ";
            $mysqlQuery .= "foto = :foto, ";
            $mysqlQuery .= "firma = :firma, ";
            $mysqlQuery .= "id_style = :interfaz ";
            $mysqlQuery .= "WHERE ";
            $mysqlQuery .= "id = :id; ";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':nombre', $_nombre, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':apellido', $_apellido, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':foto', $_foto, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':firma', $_firma, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':interfaz', $_interfaz, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':id', $_id, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {
                if ($mysqlStmt->rowCount()) {
                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'bien',
                        'message' => 'El usuario fue actualizado ',
                    );
                    $mysqlStmt->closeCursor();
                } else {
                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'error',
                        'message' => 'El usuario es idéntico al anterior, no sufrió cambios.',
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