<?php

class NovedadClass
{

    private $pdo = null;
    private $arrayResponse = array();

    public function __construct($_pdo)
    {
        // var_dump($_pdo);
        $this->pdo = $_pdo;
    }

    public function UpdateNovedad(
        $_id = 1,
        $_contenido = '777',
        $_id_usuario = 1
    ) {
        try {
            $mysqlQuery = "UPDATE ";
            $mysqlQuery .= "novedad ";
            $mysqlQuery .= "SET ";
            $mysqlQuery .= "contenido = :contenido, ";
            $mysqlQuery .= "id_usuario = :usuario ";
            $mysqlQuery .= "WHERE ";
            $mysqlQuery .= " id = :id; ";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':id', $_id, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':contenido', $_contenido, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':usuario', $_id_usuario, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {
                if ($mysqlStmt->rowCount()) {
                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'bien',
                        'message' => 'El documento fue actualizado ',
                    );
                    $mysqlStmt->closeCursor();
                } else {
                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'error',
                        'message' => 'El documento es idéntico al anterior, no sufrió cambios.',
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

    public function ReadNovedad(
        $_id = 1
    ) {

        $mysqlArray = array();

        try {
            $mysqlQuery = "SELECT ";
            $mysqlQuery .= "id,contenido ";
            $mysqlQuery .= "FROM ";
            $mysqlQuery .= "novedad ";
            $mysqlQuery .= "WHERE ";
            $mysqlQuery .= "id = :id ";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':id', $_id, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {
                        $mysqlArray = array(
                            'id' => ($row['id']),
                            'contenido' => ($row['contenido']),
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