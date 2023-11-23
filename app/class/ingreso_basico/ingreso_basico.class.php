<?php

class IngresoClass
{

    private $pdo = null;
    private $arrayResponse = array();

    public function __construct($_pdo)
    {

        $this->pdo = $_pdo;
    }
    public function CreateIngresoBasico($_datos = array(
        "ID_CONDUCTOR" => 0,
           "DOCUMENTO" => '',
           "NOMBRE" => '',
           "APELLIDO" => '',
           "TELEFONO_1" => '',
           "TELEFONO_2" => '',
           "TELEFONO_3" => '',
           "EMAIL" => '',
           "DIRECCION" => '',
           "ID_VEHICULO" => 1,
           "PLACA" => '',
           "TIPO" => 1,
           "SERVICIO" => 1,
           "MODELO" => 1800,
           "ENSENANZA" => 1,
           "MARCA" => 1,
           "LINEA" => 1,
           "COLOR" => 1,
           "ID_PROPIETARIO" => 1,
           "DOCUMENTO_PROPIETARIO" => '',
           "NOMBRE_PROPIETARIO" => '',
           "APELLIDO_PROPIETARIO" => '',
           "TELEFONO_1_PROPIETARIO" => '',
           "TELEFONO_2_PROPIETARIO" => '',
           "TELEFONO_3_PROPIETARIO" => '',
           "EMAIL_PROPIETARIO" => '',
           "DIRECCION_PROPIETARIO" => '',
           "ID_USUARIO" => 1
    ))
    {
        $mysqlArray = array();
        try {
            $mysqlQuery = "CALL proc_crear_ingreso_basico(";
            $mysqlQuery .= ":id_conductor, ";
            $mysqlQuery .= ":documento, ";
            $mysqlQuery .= ":nombre, ";
            $mysqlQuery .= ":apellido, ";
            $mysqlQuery .= ":telefono_1, ";
            $mysqlQuery .= ":telefono_2, ";
            $mysqlQuery .= ":telefono_3, ";
            $mysqlQuery .= ":email, ";
            $mysqlQuery .= ":direccion, ";
            $mysqlQuery .= ":id_vehiculo, ";
            $mysqlQuery .= ":placa, ";
            $mysqlQuery .= ":tipo, ";
            $mysqlQuery .= ":servicio, ";
            $mysqlQuery .= ":modelo, ";
            $mysqlQuery .= ":ensenanza, ";
            $mysqlQuery .= ":marca, ";
            $mysqlQuery .= ":linea, ";
            $mysqlQuery .= ":color, ";
            $mysqlQuery .= ":id_propietario, ";
            $mysqlQuery .= ":documento_propietario, ";
            $mysqlQuery .= ":nombre_propietario, ";
            $mysqlQuery .= ":apellido_propietario, ";
            $mysqlQuery .= ":telefono_1_propietario, ";
            $mysqlQuery .= ":telefono_2_propietario, ";
            $mysqlQuery .= ":telefono_3_propietario, ";
            $mysqlQuery .= ":email_propietario, ";
            $mysqlQuery .= ":direccion_propietario, ";
            $mysqlQuery .= ":id_usuario, ";
            $mysqlQuery .= " @response)";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);
        

            $mysqlStmt->bindParam(':id_conductor', $_datos['ID_CONDUCTOR'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':documento', $_datos['DOCUMENTO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':nombre', $_datos['NOMBRE'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':apellido', $_datos['APELLIDO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':telefono_1', $_datos['TELEFONO_1'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':telefono_2', $_datos['TELEFONO_2'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':telefono_3', $_datos['TELEFONO_3'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':email', $_datos['EMAIL'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':direccion', $_datos['DIRECCION'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':id_vehiculo', $_datos['ID_VEHICULO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':placa', $_datos['PLACA'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':tipo', $_datos['TIPO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':servicio', $_datos['SERVICIO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':modelo', $_datos['MODELO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':ensenanza', $_datos['ENSENANZA'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':marca', $_datos['MARCA'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':linea', $_datos['LINEA'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':color', $_datos['COLOR'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':id_propietario', $_datos['ID_PROPIETARIO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':documento_propietario', $_datos['DOCUMENTO_PROPIETARIO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':nombre_propietario', $_datos['NOMBRE_PROPIETARIO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':apellido_propietario', $_datos['APELLIDO_PROPIETARIO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':telefono_1_propietario', $_datos['TELEFONO_1_PROPIETARIO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':telefono_2_propietario', $_datos['TELEFONO_2_PROPIETARIO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':telefono_3_propietario', $_datos['TELEFONO_3_PROPIETARIO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':email_propietario', $_datos['EMAIL_PROPIETARIO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':direccion_propietario', $_datos['DIRECCION_PROPIETARIO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':id_usuario', $_datos['ID_USUARIO'], PDO::PARAM_INT);


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
