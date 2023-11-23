<?php

class AutoCompleteClass
{

    private $pdo = null;
    private $arrayResponse = array();
    private $arrayitems = array();

    public function __construct($_pdo)
    {
        $this->pdo = $_pdo;
    }

    public function ReadFather(
        $_column_id = '',
        $_column_name = '',
        $_table = '',
        $_value = ''
    ) {

        $contador = 0;
        try {
            $mysqlQuery = "SELECT ";
            $mysqlQuery .= $_column_id . "," . $_column_name . " ";
            $mysqlQuery .= "FROM ";
            $mysqlQuery .= $_table . " ";
            $mysqlQuery .= "WHERE ";
            $mysqlQuery .= $_column_name . " LIKE :value ";
            $mysqlQuery .= "LIMIT 0,5;";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':value', $_value, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_NUM)) {
                        $mysqlArray[$contador] = array(
                            'id' => ($row[0]),
                            'nombre' => ($row[1]),
                        );
                        $contador++;
                    }
                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'bien',
                        'items' => $mysqlArray,
                        'count' => $contador,
                    );
                    $mysqlStmt->closeCursor();
                } else {

                    $mysqlArray[0] = array(
                        "id" => 0,
                        "nombre" => "SIN RESULTADOS",
                    );
                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'sin_resultados',
                        'items' => $mysqlArray,
                        'count' => $contador,
                    );
                }
            } else {
                $mysqlArray[0] = array(
                    "id" => 0,
                    "nombre" => "Error en la consulta ",
                );
                $this->arrayResponse = array(
                    'statusCode' => 400,
                    'statusText' => 'error',
                    'items' => $mysqlArray,
                    'count' => $contador,
                );
            }
            // $this->pdo = null;
        } catch (Throwable $th) {
            $mysqlArray[0] = array(
                "id" => 0,
                "nombre" => 'Error en la comunicación: ' . $th->getMessage(),
            );
            $this->arrayResponse = array(
                'statusCode' => 500,
                'statusText' => 'error',
                'items' => $mysqlArray,
                'count' => $contador,
            );
        }
        return $this->arrayResponse;
    }
    public function CreateFather(
        $_table = '',
        $_column = '',
        $_value = '',
        $_usuario = 1
    ) {

        try {

            $mysqlQuery = "INSERT INTO ";
            $mysqlQuery .= $_table . " ";
            $mysqlQuery .= "(" . $_column . ",id_usuario) ";
            $mysqlQuery .= "VALUES ";
            $mysqlQuery .= "(:nombre,:usuario); ";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':nombre', $_value, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':usuario', $_usuario, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {

                $this->arrayResponse = array(
                    'statusCode' => 200,
                    'statusText' => 'bien',
                    'id' => $this->pdo->lastInsertId(),
                    'nombre' => $_value,
                );
                $mysqlStmt->closeCursor();
            } else {
                $this->arrayResponse = array(
                    'statusCode' => 400,
                    'statusText' => 'error',
                    'id' => 0,
                    'nombre' => 'Error al guardar',
                );
            }
        } catch (Throwable $th) {
            $this->arrayResponse = array(
                'statusCode' => 500,
                'statusText' => 'error',
                'id' => 0,
                'nombre' => 'Error en la comunicación: ' . $th->getMessage(),
            );
        }
        return $this->arrayResponse;
    }

    public function ReadSon(
        $_parent_column = 1,
        $_parent_id = 1,
        $_column_id = '',
        $_column_name = '',
        $_table = '',
        $_value = ''
    ) {

        $contador = 0;
        try {

            $mysqlQuery = "SELECT ";
            $mysqlQuery .= $_column_id . "," . $_column_name . " ";
            $mysqlQuery .= "FROM ";
            $mysqlQuery .= $_table . " ";
            $mysqlQuery .= "WHERE ";
            $mysqlQuery .= $_column_name . " LIKE :value ";
            $mysqlQuery .= "AND " . $_parent_column . " = :father ";
            $mysqlQuery .= "LIMIT 0,5;";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':value', $_value, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':father', $_parent_id, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_NUM)) {
                        $mysqlArray[$contador] = array(
                            'id' => ($row[0]),
                            'nombre' => ($row[1]),
                        );
                        $contador++;
                    }
                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'bien',
                        'items' => $mysqlArray,
                        'count' => $contador,
                    );
                    $mysqlStmt->closeCursor();
                } else {

                    $mysqlArray[0] = array(
                        "id" => 0,
                        "nombre" => "SIN RESULTADOS",
                    );

                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'sin_resultados',
                        'items' => $mysqlArray,
                        'count' => $contador,
                    );
                }
            } else {
                $mysqlArray[0] = array(
                    "id" => 0,
                    "nombre" => "Error en la consulta ",
                );
                $this->arrayResponse = array(
                    'statusCode' => 400,
                    'statusText' => 'error',
                    'items' => $mysqlArray,
                    'count' => $contador,
                );
            }
            // $this->pdo = null;
        } catch (Throwable $th) {
            $mysqlArray[0] = array(
                "id" => 0,
                "nombre" => 'Error en la comunicación: ' . $th->getMessage(),
            );
            $this->arrayResponse = array(
                'statusCode' => 500,
                'statusText' => 'error',
                'items' => $mysqlArray,
                'count' => $contador,
            );
        }
        return $this->arrayResponse;
    }

    public function CreateSon(
        $_parent_column = 1,
        $_parent_id = 1,
        $_column_name = '',
        $_table = '',
        $_value = '',
        $_usuario = 1
    ) {

        try {

            $mysqlQuery = "INSERT INTO ";
            $mysqlQuery .= $_table . " ";
            $mysqlQuery .= "(" . $_column_name . "," . $_parent_column . ",id_usuario) ";
            $mysqlQuery .= "VALUES(:nombre, :padre, :usuario) ";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':nombre', $_value, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':padre', $_parent_id, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':usuario', $_usuario, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {

                $this->arrayResponse = array(
                    'statusCode' => 200,
                    'statusText' => 'bien',
                    'id' => $this->pdo->lastInsertId(),
                    'nombre' => $_value,
                );
                $mysqlStmt->closeCursor();
            } else {
                $this->arrayResponse = array(
                    'statusCode' => 400,
                    'statusText' => 'error',
                    'id' => 0,
                    'nombre' => 'Error al guardar',
                );
            }
        } catch (Throwable $th) {
            $this->arrayResponse = array(
                'statusCode' => 500,
                'statusText' => 'error',
                'id' => 0,
                'nombre' => 'Error en la comunicación: ' . $th->getMessage(),
            );
        }
        return $this->arrayResponse;
    }
}
