<?php

class IniciarSesion
{

    private $pdo = null;
    private $arrayResponse = array();

    public function __construct($_pdo)
    {
        $this->pdo = $_pdo;
    }

    public function inicioTradicional(
        $_usuario = '',
        $_contrasenia = ''
    ) {

        $mysqlArray = array();

        try {

            $sql = " CALL proc_iniciar_sesion (:cedula, :contrasenia, @response); ";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':cedula', $_usuario, PDO::PARAM_STR);
            $stmt->bindParam(':contrasenia', $_contrasenia, PDO::PARAM_STR);


            if ($stmt->execute()) {

                $sql = "SELECT @response As response_procedure; ";
                $stmt = $this->pdo->prepare($sql);

                if ($stmt->execute()) {

                    $mysqlArray = $stmt->fetch(PDO::FETCH_ASSOC);
                    $mysqlArray = json_decode($mysqlArray['response_procedure']);
   
                    if (strcasecmp($mysqlArray[0], "bien") == 0) {
                        $this->arrayResponse = array(
                            "status" => true,
                            "statusText" => $mysqlArray[0],
                            "message" => $mysqlArray,
                        );
                    } else {
                        $this->arrayResponse = array(
                            "status" => false,
                            "statusText" => $mysqlArray[0],
                            "message" => $mysqlArray[1],
                        );
                    }
                } 
            } else {
                $this->arrayResponse = array(
                    "status" => false,
                    'statusText' => 'sql_error',
                    'message' => 'Error en la consulta ',
                );
            }
        } catch (PDOException $e) {
            $this->arrayResponse = array(
                "status" => false,
                'statusText' => 'code_error',
                'message' => "General Error: Internal server error 2 <br>" . $e->getMessage(),
            );
        } catch (Exception $e) {
            $this->arrayResponse = array(
                "status" => false,
                'statusText' => 'code_error',
                'message' => "General Error: Internal server error 1 <br>" . $e->getMessage(),
            );
        }

        return $this->arrayResponse;
    }

    // public function comprobarSesion(
    //     $_usuario = '',
    //     $_contrasenia = ''
    // ) {

    //     $mysqlArray = array();

    //     try {

    //         $sql = " CALL proc_comprobar_sesion (:cedula, :contrasenia, @response); ";
    //         $stmt = $this->pdo->prepare($sql);

    //         $stmt->bindParam(':cedula', $_usuario, PDO::PARAM_STR);
    //         $stmt->bindParam(':contrasenia', $_contrasenia, PDO::PARAM_STR);


    //         if ($stmt->execute()) {
    //             if (intval($stmt->rowCount()) > 0) {

    //                 $sql = "SELECT @response As response_procedure; ";
    //                 $stmt = $this->pdo->prepare($sql);

    //                 if ($stmt->execute()) {

    //                     $mysqlArray = $stmt->fetch(PDO::FETCH_ASSOC);
    //                     $mysqlArray = json_decode($mysqlArray['response_procedure']);

    //                     if (strcasecmp($mysqlArray[0], "bien") == 0) {

    //                         $this->arrayResponse = array(
    //                             "status" => true,
    //                             "statusText" => $mysqlArray[0],
    //                             "message" => $mysqlArray,
    //                         );

    //                     }
    //                     else {
    //                         $this->arrayResponse = array(
    //                             "status" => true,
    //                             "statusText" => $mysqlArray[0],
    //                             "message" => $mysqlArray[1],
    //                         );
    //                     }
    //                 } else {
    //                 }
    //             }  else {
    //                 $this->arrayResponse = array(
    //                     "status" => false,
    //                     'statusText' => 'sin_resultados',
    //                     'message' => 'La búsqueda no arrojo ningún resultado, por favor inténtelo de nuevo o más tarde',
    //                 );
    //             }
    //         } else {
    //             $this->arrayResponse = array(
    //                 "status" => false,
    //                 'statusText' => 'sql_error',
    //                 'message' => 'Error en la consulta ',
    //             );
    //         }
    //     } catch (PDOException $e) {
    //         $this->arrayResponse = array(
    //             "status" => false,
    //             'status' => 'code_error',
    //             'message' => "General Error: Internal server error 2 <br>" . $e->getMessage(),
    //         );

    //     } catch (Exception $e) {
    //         $this->arrayResponse = array(
    //             "status" => false,
    //             'statusText' => 'code_error',
    //             'message' => "General Error: Internal server error 1 <br>" . $e->getMessage(),
    //         );
    //     }

    //     return $this->arrayResponse;

    // }
}
