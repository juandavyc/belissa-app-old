<?php

class IngresoQr
{
    private $pdo = null;
    private $arrayResponse = array();
    public function __construct($_pdo)
    {
        $this->pdo = $_pdo;
    }

    public function createQr( 
        $placa,
        $tipo,       
        $fecha,
        $usuario
    ){
        try {
            $mysqlQuery = "INSERT INTO 
            ingreso_qr
            (
                placa, 
                id_tipo_vehiculo,
                fecha_vencimiento,
                id_usuario
            )
            VALUES
            (
                :placa,
                :tipo,
                :fecha,
                :usuario
            )";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);
            
            $mysqlStmt->bindParam(':placa', $placa, PDO::PARAM_STR);   
            $mysqlStmt->bindParam(':tipo', $tipo, PDO::PARAM_INT);   
            $mysqlStmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);   
            $mysqlStmt->bindParam(':usuario', $usuario, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {                
                $this->arrayResponse = array(
                    'statusCode' => 200,
                    'statusText' => 'bien',
                    'message' => 'Ingreso Creado',
                    'id' => getEncriptado($this->pdo->lastInsertId()), 
                );
                $mysqlStmt->closeCursor();
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

    public function isVigenteQR( 
        $id
    ){
        try {
            $mysqlQuery = "select isVigenteIngresoQR(:id);";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);            
            $mysqlStmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {  
                $tempResponse = json_decode($mysqlStmt->fetchColumn(), true);
                $this->arrayResponse = $tempResponse;
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

    public function guardarInformacion(
        $id,
        $placa,
        $tipo,
        $propietario_documento,
        $propietario_tipo_documento,
        $propietario_nombres,
        $propietario_apellidos,
        $propietario_telefono,
        $propietario_correo,
        $propietario_direccion,
        $propietario_rut,
        $conductor_documento,
        $conductor_tipo_documento,
        $conductor_nombres,
        $conductor_apellidos,
        $conductor_telefono,
        $conductor_correo,
        $conductor_direccion,
        $conductor_rut,
        $factura_documento,
        $factura_tipo_documento,
        $factura_nombres,
        $factura_apellidos,
        $factura_telefono,
        $factura_correo,
        $factura_direccion,
        $factura_rut,
        $tarjeta_delantera,
        $tarjeta_trasera
    ){
        try {
            $mysqlQuery = "CALL procCrearIngresoQr(";
            $mysqlQuery .= ":id,";
            $mysqlQuery .= ":placa,";
            $mysqlQuery .= ":tipo,";
            $mysqlQuery .= ":propietario_documento,";
            $mysqlQuery .= ":propietario_tipo_documento,";
            $mysqlQuery .= ":propietario_nombres,";
            $mysqlQuery .= ":propietario_apellidos,";
            $mysqlQuery .= ":propietario_telefono,";
            $mysqlQuery .= ":propietario_correo,";
            $mysqlQuery .= ":propietario_direccion,";
            $mysqlQuery .= ":propietario_rut,";
            $mysqlQuery .= ":conductor_documento,";
            $mysqlQuery .= ":conductor_tipo_documento,";
            $mysqlQuery .= ":conductor_nombres,";
            $mysqlQuery .= ":conductor_apellidos,";
            $mysqlQuery .= ":conductor_telefono,";
            $mysqlQuery .= ":conductor_correo,";
            $mysqlQuery .= ":conductor_direccion,";
            $mysqlQuery .= ":conductor_rut,";
            $mysqlQuery .= ":factura_documento,";
            $mysqlQuery .= ":factura_tipo_documento,";
            $mysqlQuery .= ":factura_nombres,";
            $mysqlQuery .= ":factura_apellidos,";
            $mysqlQuery .= ":factura_telefono,";
            $mysqlQuery .= ":factura_correo,";
            $mysqlQuery .= ":factura_direccion,";
            $mysqlQuery .= ":factura_rut,";
            $mysqlQuery .= ":tarjeta_delantera,";
            $mysqlQuery .= ":tarjeta_trasera,";           
            $mysqlQuery .= " @response)";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':placa', $placa, PDO::PARAM_STR);   
            $mysqlStmt->bindParam(':tipo', $tipo, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':propietario_documento', $propietario_documento, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':propietario_tipo_documento', $propietario_tipo_documento, PDO::PARAM_INT);  
            $mysqlStmt->bindParam(':propietario_nombres', $propietario_nombres, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':propietario_apellidos', $propietario_apellidos, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':propietario_telefono', $propietario_telefono, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':propietario_correo', $propietario_correo, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':propietario_direccion', $propietario_direccion, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':propietario_rut', $propietario_rut, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':conductor_documento', $conductor_documento, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':conductor_tipo_documento', $conductor_tipo_documento, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':conductor_nombres', $conductor_nombres, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':conductor_apellidos', $conductor_apellidos, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':conductor_telefono', $conductor_telefono, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':conductor_correo', $conductor_correo, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':conductor_direccion', $conductor_direccion, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':conductor_rut', $conductor_rut, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':factura_documento', $factura_documento, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':factura_tipo_documento', $factura_tipo_documento, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':factura_nombres', $factura_nombres, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':factura_apellidos', $factura_apellidos, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':factura_telefono', $factura_telefono, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':factura_correo', $factura_correo, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':factura_direccion', $factura_direccion, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':factura_rut', $factura_rut, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':tarjeta_delantera', $tarjeta_delantera, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':tarjeta_trasera', $tarjeta_trasera, PDO::PARAM_STR);

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
