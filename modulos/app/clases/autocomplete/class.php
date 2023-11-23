<?php

class AutoCompleteClass
{

    private $pdo = null;
    private $arrayResponse = array();
    private $arrayOptions = array();

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
                        'options' => $mysqlArray,
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
                        'options' => $mysqlArray,
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
                    'options' => $mysqlArray,
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
                'options' => $mysqlArray,
                'count' => $contador,
            );
        }
        return $this->arrayResponse;
    }
    public function CreateFather(
        $_table_name = '',
        $_column_name = '',
        $_value = '',
        $_id_usuario = 1,
        $_return = 0
    ) {

        try {

            $mysqlQuery = "INSERT INTO ";
            $mysqlQuery .= $_table_name . " ";
            $mysqlQuery .= "(" . $_column_name . ",id_usuario) ";
            $mysqlQuery .= "VALUES ";
            $mysqlQuery .= "(:nombre,:usuario); ";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':nombre', $_value, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':usuario', $_id_usuario, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {

                $this->arrayResponse = array(
                    'statusCode' => 200,
                    'statusText' => 'bien',
                    'id' => ($_return == 0) ? $this->pdo->lastInsertId() : $_value,
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
        $_father_colum = 1,
        $_father_value = 1,
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
            $mysqlQuery .= "AND " . $_father_colum . " = :father ";
            $mysqlQuery .= "LIMIT 0,5;";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':value', $_value, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':father', $_father_value, PDO::PARAM_INT);

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
                        'options' => $mysqlArray,
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
                        'options' => $mysqlArray,
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
                    'options' => $mysqlArray,
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
                'options' => $mysqlArray,
                'count' => $contador,
            );
        }
        return $this->arrayResponse;
    }

    public function CreateSon(
        $_father_colum = 1,
        $_father_value = 1,
        $_table = '',
        $_column_name = '',
        $_value = '',
        $_id_usuario = 1
    ) {

        try {

            $mysqlQuery = "INSERT INTO ";
            $mysqlQuery .= $_table . " ";
            $mysqlQuery .= "(" . $_column_name . "," . $_father_colum . ",id_usuario) ";
            $mysqlQuery .= "VALUES(:nombre, :padre, :usuario) ";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':nombre', $_value, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':padre', $_father_value, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':usuario', $_id_usuario, PDO::PARAM_INT);

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
