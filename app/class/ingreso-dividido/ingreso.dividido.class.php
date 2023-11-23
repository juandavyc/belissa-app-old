<?php

class IngresoDivididoClass
{

    private $pdo = null;
    private $arrayResponse = array();

    public function __construct($_pdo)
    {
        $this->pdo = $_pdo;
    }

    public function guardarInformacion(
        $id_vehiculo,
        $placa,
        $id_propietario,
        $id_conductor,
        $tipo_vehiculo,
        $servicio_vehiculo,
        $modelo,
        $propietario_tipo_documento,
        $propietario_documento,
        $propietario_nombres,
        $propietario_apellidos,
        $propietario_telefono,
        $propietario_correo,
        $propietario_direccion,
        $conductor_tipo_documento,
        $conductor_documento,
        $conductor_nombres,
        $conductor_apellidos,
        $conductor_telefono,
        $conductor_correo,
        $usuario
    ){
        try {
            $mysqlQuery = "CALL proc_crear_ingreso_dividido(";
            $mysqlQuery .= ":id_vehiculo,";
            $mysqlQuery .= ":placa,";
            $mysqlQuery .= ":id_propietario,";
            $mysqlQuery .= ":id_conductor,";
            $mysqlQuery .= ":tipo_vehiculo,";
            $mysqlQuery .= ":servicio_vehiculo,";
            $mysqlQuery .= ":modelo,";
            $mysqlQuery .= ":propietario_tipo_documento,";
            $mysqlQuery .= ":propietario_documento,";
            $mysqlQuery .= ":propietario_nombres,";
            $mysqlQuery .= ":propietario_apellidos,";   
            $mysqlQuery .= ":propietario_telefono,";    
            $mysqlQuery .= ":propietario_correo,";     
            $mysqlQuery .= ":propietario_direccion,";
            $mysqlQuery .= ":conductor_tipo_documento,";
            $mysqlQuery .= ":conductor_documento,";
            $mysqlQuery .= ":conductor_nombres,";
            $mysqlQuery .= ":conductor_apellidos,";
            $mysqlQuery .= ":conductor_telefono,";
            $mysqlQuery .= ":conductor_correo,";
            $mysqlQuery .= ":usuario,";
            $mysqlQuery .= " @response)";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':id_vehiculo', $id_vehiculo, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':placa', $placa, PDO::PARAM_STR);   
            $mysqlStmt->bindParam(':id_propietario', $id_propietario, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':id_conductor', $id_conductor, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':tipo_vehiculo', $tipo_vehiculo, PDO::PARAM_INT);  
            $mysqlStmt->bindParam(':servicio_vehiculo', $servicio_vehiculo, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':modelo', $modelo, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':propietario_tipo_documento', $propietario_tipo_documento, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':propietario_documento', $propietario_documento, PDO::PARAM_STR);   
            $mysqlStmt->bindParam(':propietario_nombres', $propietario_nombres, PDO::PARAM_STR);    
            $mysqlStmt->bindParam(':propietario_apellidos', $propietario_apellidos, PDO::PARAM_STR);    
            $mysqlStmt->bindParam(':propietario_telefono', $propietario_telefono, PDO::PARAM_STR);   
            $mysqlStmt->bindParam(':propietario_correo', $propietario_correo, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':propietario_direccion', $propietario_direccion, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':conductor_tipo_documento', $conductor_tipo_documento, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':conductor_documento', $conductor_documento, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':conductor_nombres', $conductor_nombres, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':conductor_apellidos', $conductor_apellidos, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':conductor_telefono', $conductor_telefono, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':conductor_correo', $conductor_correo, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':usuario', $usuario, PDO::PARAM_INT);

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
