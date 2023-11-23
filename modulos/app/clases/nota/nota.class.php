<?php

class NotaClass
{
    private $pdo = null;
    private $arrayResponse = array();

    public function __construct($_pdo)
    {
        // var_dump($_pdo);
        $this->pdo = $_pdo;
    }

    public function createNota(
        $_tabla = 'vehiculo',
        $_id_objetivo = 1,
        $_nota = '...',
        $_id_usuario = 1
    ) {
        try {

            $mysqlQuery = "INSERT INTO ";
            $mysqlQuery .= "nota_" . $_tabla . " ";
            $mysqlQuery .= "(id_" . $_tabla . ",";
            $mysqlQuery .= "nota,id_usuario) ";
            $mysqlQuery .= "VALUES ";
            $mysqlQuery .= "(:id,:nota,:usuario);";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':id', $_id_objetivo, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':nota', $_nota, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':usuario', $_id_usuario, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {

                $this->arrayResponse = array(
                    'statusCode' => 200,
                    'statusText' => 'bien',
                    'message' => 'La nota fue guardada correctamente',
                    'id' => $this->pdo->lastInsertId(),
                );

                $mysqlStmt->closeCursor();
            } else {
                $this->arrayResponse = array(
                    'statusCode' => 500,
                    'statusText' => 'error',
                    'message' => 'Error en la consulta',
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

    public function eliminarNota(
        $_id = 1,
        $_table = 'vehiculo',
        $_id_usuario = 1
    ) {
        try {

            $mysqlQuery = "DELETE FROM ";
            $mysqlQuery .= "nota_" . $_table . " ";
            $mysqlQuery .= "WHERE id = :id; ";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':id', $_id, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {

                $this->arrayResponse = array(
                    'statusCode' => 200,
                    'statusText' => 'bien',
                    'message' => 'La nota fue eliminada correctamente',
                );

                $mysqlStmt->closeCursor();
            } else {
                $this->arrayResponse = array(
                    'statusCode' => 500,
                    'statusText' => 'error',
                    'message' => 'Error en la consulta',
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

    public function getNota(
        $_table = 'vehiculo',
        $_value = 1,
        $_column = 'ID'
    ) {

        $mysqlArray = array();
        try {

            $_table_fix = 'vehiculo';
            if ($_table == 'propietario' || $_table == 'conductor') {
                $_table_fix = 'cliente';
            }

            $mysqlQuery = "SELECT ";
            $mysqlQuery .= "nota.id, nota.id_" . $_table . ", ";
            $mysqlQuery .= "nota.nota,nota.fecha_formulario, ";
            $mysqlQuery .= "usu.id As id_usuario, concat(usu.nombre,' ',usu.apellido) AS nombre_usuario ";
            $mysqlQuery .= "FROM ";
            $mysqlQuery .= "nota_" . $_table . " nota ";
            $mysqlQuery .= "LEFT JOIN " . $_table_fix . " ON " . $_table_fix . ".id = nota.id_" . $_table . " ";
            $mysqlQuery .= "LEFT JOIN usuario usu ON usu.id = nota.id_usuario ";
            $mysqlQuery .= "WHERE ";
            $mysqlQuery .= $_table_fix . "." . $_column . " = :value ";
            $mysqlQuery .= "ORDER BY nota.id DESC;";

            //echo $mysqlQuery;
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);
            $mysqlStmt->bindParam(':value', $_value, PDO::PARAM_INT);

            $contador = 1;

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {
                        array_push(
                            $mysqlArray,
                            array(
                                'id' => ($row['id']),
                                'nro' => $contador++,
                                'nota' => ($row['nota']),
                                'fecha' => getSpecialDateTime($row['fecha_formulario']),
                                'usuario' => htmlspecialchars($row['nombre_usuario']),
                            ),
                        );
                    }
                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'bien',
                        'message' => 'Nota(s) encontrada(s) (' . intval($mysqlStmt->rowCount()) . ')',
                        'nota' => $mysqlArray,
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