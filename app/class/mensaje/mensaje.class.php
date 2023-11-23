<?php

class MensajeClass
{
    private $pdo = null;
    private $arrayResponse = array();

    public function __construct($_pdo)
    {
        $this->pdo = $_pdo;
    }

    public function saveLogMessage(
        $_response
    ) {

        // try {
        //     $mysqlQuery = "CALL proc_log_mensaje_masivo(";
        //     $mysqlQuery .= ":titulo, ";
        //     $mysqlQuery .= ":mensaje, ";
        //     $mysqlQuery .= ":usuario, ";
        //     $mysqlQuery .= " @response);";
        //     $mysqlStmt = $this->pdo->prepare($mysqlQuery);


        //     $mysqlStmt->bindParam(':titulo', $_response['TITULO'], PDO::PARAM_STR);
        //     $mysqlStmt->bindParam(':mensaje', $_response['MENSAJE'], PDO::PARAM_STR);
        //     $mysqlStmt->bindParam(':usuario', $_response['USUARIO'], PDO::PARAM_INT);


        //     if ($mysqlStmt->execute()) {
        //         $mysqlStmt->closeCursor();

        //         $mysqlQuery = "SELECT @response As response_procedure; ";
        //         $mysqlStmt = $this->pdo->prepare($mysqlQuery);

        //         if ($mysqlStmt->execute()) {

        //             $responseArray = $mysqlStmt->fetch(PDO::FETCH_ASSOC);
        //             $responseArray = json_decode($responseArray['response_procedure']);

        //             $mysqlStmt->closeCursor();

        //             $this->arrayResponse = array(
        //                 'statusCode' => 200,
        //                 'statusText' => $responseArray[0],
        //                 'message' => $responseArray[1],
        //             );
        //         } else {
        //             $this->arrayResponse = array(
        //                 'statusCode' => 500,
        //                 'statusText' => 'error',
        //                 'message' => 'Error en la consulta # 2 ',
        //             );
        //         }
        //     } else {
        //         $this->arrayResponse = array(
        //             'statusCode' => 500,
        //             'statusText' => 'error',
        //             'message' => 'Error en la consulta # 1 ',
        //         );
        //     }
        // } catch (Throwable $th) {
        //     $this->arrayResponse = array(
        //         'statusCode' => 500,
        //         'statusText' => 'error',
        //         'message' => 'Error en la comunicación: ' . $th->getMessage(),
        //     );
        // }
        return $this->arrayResponse;
    }
    public function CreateMensaje(
        $_datos = array(
            'TITULO' => '',
            'MENSAJE' => '',
            'USUARIO' => 1,
        )
    ) {



        try {
            $mysqlQuery = "CALL proc_crear_mensaje_predeterminado(";
            $mysqlQuery .= ":titulo, ";
            $mysqlQuery .= ":mensaje, ";
            $mysqlQuery .= ":usuario, ";
            $mysqlQuery .= " @response);";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);


            $mysqlStmt->bindParam(':titulo', $_datos['TITULO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':mensaje', $_datos['MENSAJE'], PDO::PARAM_STR);
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



    public function EditarMensaje(
        $_datos = array(
            'ID' => '',
            'USUARIO' => 1,
        )
    ) {



        try {
            $mysqlQuery = "CALL proc_editar_mensaje_predeterminado(";
            $mysqlQuery .= ":id, ";
            $mysqlQuery .= ":mensaje, ";
            $mysqlQuery .= ":usuario, ";
            $mysqlQuery .= " @response);";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);


            $mysqlStmt->bindParam(':titulo', $_datos['TITULO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':mensaje', $_datos['MENSAJE'], PDO::PARAM_STR);
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

    public function getListado(
        $_tabla_columna = 'titulo',
        $_contenido = '%%'
    ) {



        $mysqlArray = array();
        $contadorArray = 1;
        try {

            $mysqlQuery = "SELECT ";
            $mysqlQuery .= "id,titulo, mensaje, fecha_formulario ";
            $mysqlQuery .= "FROM mensaje_predeterminado ";
            $mysqlQuery .= "WHERE " . $_tabla_columna . " LIKE :contenido ";
            $mysqlQuery .= "ORDER BY id ASC; ";
            // echo $mysqlQuery;
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);
            $mysqlStmt->bindParam(':contenido', $_contenido, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {
                        array_push(
                            $mysqlArray,
                            array(
                                'nro' => ($contadorArray++),
                                'titulo' => htmlspecialchars($row['titulo']),
                                'mensaje' => htmlspecialchars($row['mensaje']),
                                'fecha' => htmlspecialchars($row['fecha_formulario']),
                                'opciones' => ($row['id']),
                            )
                        );
                    }
                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'bien',
                        'message' => 'Mensajes encontrados ( ' . $mysqlStmt->rowCount() . ' )',
                        'mensaje_pred' => $mysqlArray,
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
    public function getMensaje(
        $datos = array(
            'ID' => 0,
            'USUARIO' => 0,
        )

    ) {

        $mysqlArray = array();

        try {

            $mysqlQuery = "SELECT ";
            $mysqlQuery .= "id,titulo, mensaje, fecha_formulario ";
            $mysqlQuery .= "FROM mensaje_predeterminado ";
            $mysqlQuery .= "WHERE id = :value ";
            $mysqlQuery .= "ORDER BY id ASC; ";
            // echo $mysqlQuery;
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);
            $mysqlStmt->bindParam(':value', $datos['ID'], PDO::PARAM_STR);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {
                        array_push(
                            $mysqlArray,
                            array(
                                'id' => htmlspecialchars($row['id']),
                                'titulo' => htmlspecialchars($row['titulo']),
                                'mensaje' => htmlspecialchars($row['mensaje']),
                                'fecha' => htmlspecialchars($row['fecha_formulario']),
                            )
                        );
                    }
                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'bien',
                        'message' => 'Mensajes encontrados ( ' . $mysqlStmt->rowCount() . ' )',
                        'mensaje_pred' => $mysqlArray,
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

    public function GetMensajeMasivo(
        $datos = array(
            'dias' => 0,
            'mensaje' => 0,
        )

    ) {

        $mysqlArray = array('numeros' => array());

        try {

            //consulta de los numeros

            $mysqlQuery = "select cli.telefono_1
            from tecnicomecanica tec
            left join vehiculo veh ON veh.id = tec.id_vehiculo
            left join cliente cli ON cli.id = veh.id_propietario
            WHERE DATE_ADD(fecha_expedicion,INTERVAL 365 DAY) = DATE_ADD(DATE(NOW()),INTERVAL :dias DAY) 
            ORDER BY tec.id ASC LIMIT 0,100 ;";

            // echo $mysqlQuery;
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);
            $mysqlStmt->bindParam(':dias', $datos['dias'], PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {
                        array_push(
                            $mysqlArray['numeros'],
                            htmlspecialchars($row['telefono_1']),
                        );
                    }
                    $this->arrayResponse = array(
                        'statusCode' => 200,
                        'statusText' => 'bien',
                        'message' => 'Mensajes encontrados ( ' . $mysqlStmt->rowCount() . ' )',
                        'mensaje_pred' => $mysqlArray,
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
        // $this->arrayResponse = array(
        //     'statusCode' => 200,
        //     'statusText' => 'bien',
        //     'message' => 'Mensaje',
        //     'mensaje_pred' =>
        //     array(

        //         "numeros" => array(
        //             "0" => 3118132736,
        //             "1" => 3017848800,
        //             "2" => 3222205301,
        //             "3" => 3222205301,
        //             "4" => 3054105200,
        //             "5" => 3014449513,
        //         ),
        //         // "1" => array(
        //         //     "nro" => 2,
        //         //     "titulo" => "Prueba",
        //         //     "mensaje" => "prueba",
        //         //     "fecha" => "2022-11-12 13=>39=>51",
        //         //     "opciones" => 2
        //         // ),
        //         // "2" => array(
        //         //     "nro" => 3,
        //         //     "titulo" => "prueba MODULO",
        //         //     "mensaje" => "MODULO 123423213213123",
        //         //     "fecha" => "2022-11-12 13=>39=>51",
        //         //     "opciones" => 3
        //         // ),
        //         // "3" => array(
        //         //     "nro" => 4,
        //         //     "titulo" => "MENSAJE PRUEBA",
        //         //     "mensaje" => "MENSAJEEEE",
        //         //     "fecha" => "2022-11-12 13=>39=>51",
        //         //     "opciones" => 4
        //         // )

        //     )
        // );
        return $this->arrayResponse;
    }
}
