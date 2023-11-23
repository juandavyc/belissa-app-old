<?php

class IngresoClass
{

    private $pdo = null;
    private $arrayResponse = array();

    public function __construct($_pdo)
    {

        $this->pdo = $_pdo;
    }

    // conteo-rtm
     public function getEstadoPlacas(
        $inicial = '2022-11-01',
        $final = '2022-11-01'
    )
    {
        $mysqlArray = array();

        try {
            $mysqlQuery = "SELECT 
                count(id) AS total, id_estado_tecnicomecanica 
            FROM ingreso 
            WHERE
                DATE(fecha_formulario)
                BETWEEN :inicial AND :final
                AND id_estado = 1 
            GROUP BY id_estado_tecnicomecanica
            ;";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':inicial', $inicial, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':final', $final, PDO::PARAM_STR);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {
                        array_push($mysqlArray, array(                        
                            'total' => ($row['total']),
                            'estado' => ($row['id_estado_tecnicomecanica']),                      
                        ));
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


    public function EditarIngreso($_datos = array(
        'ID_INGRESO' => 1,
        'ID_VEHICULO' => 1,
        'ID_PROPIETARIO' => 1,
        'ID_CONDUCTOR' => 1,
        'PROPIETARIO_TIPO_DOCUMENTO' => 1,
        'PROPIETARIO_DOCUMENTO' => '',
        'PROPIETARIO_NOMBRES' => '',
        'PROPIETARIO_APELLIDOS' => '',
        'PROPIETARIO_TELEFONO' => '',
        'PROPIETARIO_CORREO' => '',
        'PROPIETARIO_DIRECCION' => '',
        'CONDUCTOR_TIPO_DOCUMENTO' => 1,
        'CONDUCTOR_DOCUMENTO' => '',
        'CONDUCTOR_NOMBRES' => '',
        'CONDUCTOR_APELLIDOS' => '',
        'CONDUCTOR_TELEFONO' => '',
        'CONDUCTOR_CORREO' => '',
        "USUARIO" => 1,
    ))
    {
        // var_dump($_datos);

        $mysqlArray = array();
        try {
            $mysqlQuery = "CALL proc_editar_ingreso(";
            $mysqlQuery .= ":id_ingreso, ";
            $mysqlQuery .= ":id_vehiculo, ";
            $mysqlQuery .= ":id_propietario, ";
            $mysqlQuery .= ":id_conductor, ";
            $mysqlQuery .= ":propietario_tipo_documento, ";
            $mysqlQuery .= ":propietario_documento, ";
            $mysqlQuery .= ":propietario_nombres, ";
            $mysqlQuery .= ":propietario_apellidos, ";
            $mysqlQuery .= ":propietario_telefono, ";
            $mysqlQuery .= ":propietario_correo, ";
            $mysqlQuery .= ":propietario_direccion, ";
            $mysqlQuery .= ":conductor_tipo_documento, ";
            $mysqlQuery .= ":conductor_documento, ";
            $mysqlQuery .= ":conductor_nombres, ";
            $mysqlQuery .= ":conductor_apellidos, ";
            $mysqlQuery .= ":conductor_telefono, ";
            $mysqlQuery .= ":conductor_correo, ";
            $mysqlQuery .= ":usuario, ";
            $mysqlQuery .= " @response)";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':id_ingreso', $_datos['ID_INGRESO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':id_vehiculo', $_datos['ID_VEHICULO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':id_propietario', $_datos['ID_PROPIETARIO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':id_conductor', $_datos['ID_CONDUCTOR'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':propietario_tipo_documento', $_datos['PROPIETARIO_TIPO_DOCUMENTO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':propietario_documento', $_datos['PROPIETARIO_DOCUMENTO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':propietario_nombres', $_datos['PROPIETARIO_NOMBRES'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':propietario_apellidos', $_datos['PROPIETARIO_APELLIDOS'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':propietario_telefono', $_datos['PROPIETARIO_TELEFONO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':propietario_correo', $_datos['PROPIETARIO_CORREO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':propietario_direccion', $_datos['PROPIETARIO_DIRECCION'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':conductor_tipo_documento', $_datos['CONDUCTOR_TIPO_DOCUMENTO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':conductor_documento', $_datos['CONDUCTOR_DOCUMENTO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':conductor_nombres', $_datos['CONDUCTOR_NOMBRES'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':conductor_apellidos', $_datos['CONDUCTOR_APELLIDOS'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':conductor_telefono', $_datos['CONDUCTOR_TELEFONO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':conductor_correo', $_datos['CONDUCTOR_CORREO'], PDO::PARAM_STR);
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

    public function CreateIngresoCom(
        $_data_ = array(
            "ID_VEHICULO" => 1,
            "PLACA" => '',
            "ID_PROPIETARIO" => 1,
            "ID_CONDUCTOR" => 1,
            "VEZ" => 1,
            "TIPO_VEHICULO" => 1,
            "SERVICIO_VEHICULO" => 1,
            "MARCA" => 1,
            "LINEA" => 1,
            "MODELO" => 1,
            "COLOR" => 1,
            "CARROCERIA" => 1,
            "COMBUSTIBLE" => 1,
            "CERTIFICADO_GNCV" => 1,
            "FECHA_GNCV" => '1999-01-01',
            "CAPACIDAD" => 1,
            "PUERTAS" => 1,
            "ENSENANZA" => 1,
            "KILOMETRAJE" => 1000,
            "TIPO_CAJA" => 1,
            "TIEMPOS_MOTOR" => 1,
            "DISENIO" => 1,
            "BLINDADO" => 1,
            "POLARIZADO" => 1,
            "LLANTA_REFERENCIA" => 1,
            "DELANTERA_MOTO" => 1,
            "TRASERA_MOTO" => 1,
            "DELANTERA_IZQUIERDA_LIVIANO" => 1,
            "TRASERA_IZQUIERDA_LIVIANO" => 1,
            "TRASERA_DERECHA_LIVIANO" => 1,
            "DELANTERA_DERECHA_LIVIANO" => 1,
            "REPUESTO_LIVIANO" => 1,
            "DEFECTO" => '',
            "CRITERIO" => '',
            "PROPIETARIO_TIPO_DOCUMENTO" => 1,
            "PROPIETARIO_DOCUMENTO" => '1',
            "PROPIETARIO_NOMBRES" => '',
            "PROPIETARIO_APELLIDOS" => '',
            "TELEFONO_PROPIETARIO" => '',
            "PROPIETARIO_CORREO" => '',
            "PROPIETARIO_DIRECCION" => '',
            "CONDUCTOR_TIPO_DOCUMENTO" => 1,
            "CONDUCTOR_DOCUMENTO" => '1',
            "CONDUCTOR_NOMBRES" => '',
            "CONDUCTOR_APELLIDOS" => '',
            "CONDUCTOR_TELEFONO" => '',
            "CONDUCTOR_CORREO" => '',
            "CANAL_MERCADEO" => 1,
            "POLITICA_CONFIDENCIALIDAD" => 1,
            "OFERTAS_COMERCIALES" => 1,
            "AUTORIZA_INSPECCION" => 1,
            "GUARDAR" => 1,
            "OBSERVACIONES" => '',
            "FIRMA" => 'images/sin_firma.png',
            "USUARIO" => 1,

        )
    ) {
        $this->arrayResponse = array();
        try {
            $mysqlQuery = "CALL proc_crear_ingreso_completo(";
            $mysqlQuery .= ":id_vehiculo,";
            $mysqlQuery .= ":placa,";
            $mysqlQuery .= ":id_propietario,";
            $mysqlQuery .= ":id_conductor,";
            $mysqlQuery .= ":vez,";
            $mysqlQuery .= ":tipo_vehiculo,";
            $mysqlQuery .= ":servicio_vehiculo,";
            $mysqlQuery .= ":marca,";
            $mysqlQuery .= ":linea,";
            $mysqlQuery .= ":modelo,";
            $mysqlQuery .= ":color,";
            $mysqlQuery .= ":carroceria,";
            $mysqlQuery .= ":combustible,";
            $mysqlQuery .= ":certificado_gncv,";
            $mysqlQuery .= ":fecha_gncv,";
            $mysqlQuery .= ":capacidad,";
            $mysqlQuery .= ":puertas,";
            $mysqlQuery .= ":ensenanza,";
            $mysqlQuery .= ":kilometraje,";
            $mysqlQuery .= ":tipo_caja,";
            $mysqlQuery .= ":tiempos_motor,";
            $mysqlQuery .= ":disenio,";
            $mysqlQuery .= ":blindado,";
            $mysqlQuery .= ":polarizado,";
            $mysqlQuery .= ":llanta_referencia,";
            $mysqlQuery .= ":delantera_moto,";
            $mysqlQuery .= ":trasera_moto,";
            $mysqlQuery .= ":delantera_izquierda_liviano,";
            $mysqlQuery .= ":trasera_izquierda_liviano,";
            $mysqlQuery .= ":trasera_derecha_liviano,";
            $mysqlQuery .= ":delantera_derecha_liviano,";
            $mysqlQuery .= ":repuesto_liviano,";
            $mysqlQuery .= ":defecto,";
            $mysqlQuery .= ":criterio,";
            $mysqlQuery .= ":propietario_tipo_documento,";
            $mysqlQuery .= ":propietario_documento,";
            $mysqlQuery .= ":propietario_nombres,";
            $mysqlQuery .= ":propietario_apellidos,";
            $mysqlQuery .= ":telefono_propietario,";
            $mysqlQuery .= ":propietario_correo,";
            $mysqlQuery .= ":propietario_direccion,";
            $mysqlQuery .= ":conductor_tipo_documento,";
            $mysqlQuery .= ":conductor_documento,";
            $mysqlQuery .= ":conductor_nombres,";
            $mysqlQuery .= ":conductor_apellidos,";
            $mysqlQuery .= ":conductor_telefono,";
            $mysqlQuery .= ":conductor_correo,";
            $mysqlQuery .= ":canal_mercadeo,";
            $mysqlQuery .= ":politica_confidencialidad,";
            $mysqlQuery .= ":ofertas_comerciales,";
            $mysqlQuery .= ":autoriza_inspeccion,";
            $mysqlQuery .= ":guardar,";
            $mysqlQuery .= ":observaciones,";
            $mysqlQuery .= ":firma,";
            $mysqlQuery .= ":usuario, ";
            $mysqlQuery .= " @response)";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':id_vehiculo', $_data_['ID_VEHICULO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':placa', $_data_['PLACA'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':id_propietario', $_data_['ID_PROPIETARIO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':id_conductor', $_data_['ID_CONDUCTOR'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':vez', $_data_['VEZ'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':tipo_vehiculo', $_data_['TIPO_VEHICULO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':servicio_vehiculo', $_data_['SERVICIO_VEHICULO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':marca', $_data_['MARCA'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':linea', $_data_['LINEA'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':modelo', $_data_['MODELO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':color', $_data_['COLOR'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':carroceria', $_data_['CARROCERIA'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':combustible', $_data_['COMBUSTIBLE'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':certificado_gncv', $_data_['CERTIFICADO_GNCV'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':fecha_gncv', $_data_['FECHA_GNCV'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':capacidad', $_data_['CAPACIDAD'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':puertas', $_data_['PUERTAS'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':ensenanza', $_data_['ENSENANZA'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':kilometraje', $_data_['KILOMETRAJE'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':tipo_caja', $_data_['TIPO_CAJA'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':tiempos_motor', $_data_['TIEMPOS_MOTOR'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':disenio', $_data_['DISENIO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':blindado', $_data_['BLINDADO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':polarizado', $_data_['POLARIZADO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':llanta_referencia', $_data_['LLANTA_REFERENCIA'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':delantera_moto', $_data_['DELANTERA_MOTO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':trasera_moto', $_data_['TRASERA_MOTO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':delantera_izquierda_liviano', $_data_['DELANTERA_IZQUIERDA_LIVIANO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':trasera_izquierda_liviano', $_data_['TRASERA_IZQUIERDA_LIVIANO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':trasera_derecha_liviano', $_data_['TRASERA_DERECHA_LIVIANO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':delantera_derecha_liviano', $_data_['DELANTERA_DERECHA_LIVIANO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':repuesto_liviano', $_data_['REPUESTO_LIVIANO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':defecto', $_data_['DEFECTO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':criterio', $_data_['CRITERIO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':propietario_tipo_documento', $_data_['PROPIETARIO_TIPO_DOCUMENTO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':propietario_documento', $_data_['PROPIETARIO_DOCUMENTO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':propietario_nombres', $_data_['PROPIETARIO_NOMBRES'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':propietario_apellidos', $_data_['PROPIETARIO_APELLIDOS'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':telefono_propietario', $_data_['TELEFONO_PROPIETARIO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':propietario_correo', $_data_['PROPIETARIO_CORREO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':propietario_direccion', $_data_['PROPIETARIO_DIRECCION'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':conductor_tipo_documento', $_data_['CONDUCTOR_TIPO_DOCUMENTO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':conductor_documento', $_data_['CONDUCTOR_DOCUMENTO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':conductor_nombres', $_data_['CONDUCTOR_NOMBRES'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':conductor_apellidos', $_data_['CONDUCTOR_APELLIDOS'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':conductor_telefono', $_data_['CONDUCTOR_TELEFONO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':conductor_correo', $_data_['CONDUCTOR_CORREO'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':canal_mercadeo', $_data_['CANAL_MERCADEO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':politica_confidencialidad', $_data_['POLITICA_CONFIDENCIALIDAD'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':ofertas_comerciales', $_data_['OFERTAS_COMERCIALES'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':autoriza_inspeccion', $_data_['AUTORIZA_INSPECCION'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':guardar', $_data_['GUARDAR'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':observaciones', $_data_['OBSERVACIONES'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':firma', $_data_['FIRMA'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':usuario', $_data_['USUARIO'], PDO::PARAM_INT);

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
                        'fecha' => $responseArray[2],
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

    public function ListadoIngreso(
        $_condicional_ = array(
            'ORDER' => 'ing.id',
            'BY' => 'DESC',
            'PAGE' => '1',
            'ROWS' => '25',
            'COLUMN' => 'ing.id',
            'CONTENT' => '%%',
            'TIPO' => '%%',
            'VEZ' => '%%',
            'SERVICIO' => '%%',
            'FINICIAL' => '2022-01-01',
            'FFINAL' => '2030-01-01',
        )
    ) {

        // return;
        $mysqlArray = array();
        $estadoRtm = array(
            1 => 'Aprobada',
            2 => "Rechazada",
            3 => "- No",
            4 => "Se retiro del CDA",
            5 => "No pudo completar pruebas",
        );
        try {

            #Contador
            $mysqlQueryCount = "SELECT COUNT(ing.id) AS MY_TOTAL_ROWS ";
            $mysqlQueryColumns = "SELECT ";
            #Columnas
            $mysqlQueryColumns .= "ing.id,ing.vez,ing.fecha_formulario,ing.id_estado, ing.id_estado_tecnicomecanica, ";
            $mysqlQueryColumns .= "veh.placa, ";
            $mysqlQueryColumns .= "can.nombre AS canal, ";
            $mysqlQueryColumns .= "tiveh.id AS id_tipo_vehiculo, ";
            $mysqlQueryColumns .= "tiveh.nombre AS nombre_tipo_vehiculo, ";
            $mysqlQueryColumns .= "seveh.nombre AS servicio_vehiculo ";
            #Tabla
            $mysqlQuery = "FROM ";
            $mysqlQuery .= "ingreso ing ";
            $mysqlQuery .= "LEFT JOIN vehiculo veh ON ing.id_vehiculo = veh.id ";
            $mysqlQuery .= "LEFT JOIN cliente prop ON veh.id_propietario = prop.id ";
            $mysqlQuery .= "LEFT JOIN cliente cond ON veh.id_conductor = cond.id ";
            $mysqlQuery .= "LEFT JOIN canal can ON ing.id_canal = can.id ";
            $mysqlQuery .= "LEFT JOIN tipo_vehiculo tiveh ON veh.id_tipo_vehiculo = tiveh.id ";
            $mysqlQuery .= "LEFT JOIN servicio_vehiculo seveh ON veh.id_servicio_vehiculo = seveh.id ";
            #Condicion
            $mysqlQuery .= "WHERE ";
            $mysqlQuery .= $_condicional_['COLUMN'] . " LIKE :contenido ";
            $mysqlQuery .= "AND tiveh.id LIKE :tipo ";
            $mysqlQuery .= "AND ing.vez LIKE :vez ";
            $mysqlQuery .= "AND seveh.id LIKE :servicio ";
            $mysqlQuery .= "AND DATE(ing.fecha_formulario) BETWEEN :finicial AND :ffinal ";

            #Ordenamiento
            $mysqlQuery .= "ORDER BY " . $_condicional_['ORDER'] . " " . $_condicional_['BY'] . " ";
            #Une las consultas

            $mysqlQueryCount .= $mysqlQuery;
            $mysqlQueryColumns .= $mysqlQuery;
            //echo $mysqlQueryColumns;

            $mysqlStmt = $this->pdo->prepare($mysqlQueryCount);

            $mysqlStmt->bindParam(':contenido', $_condicional_['CONTENT'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':tipo', $_condicional_['TIPO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':vez', $_condicional_['VEZ'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':servicio', $_condicional_['SERVICIO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':finicial', $_condicional_['FINICIAL'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':ffinal', $_condicional_['FFINAL'], PDO::PARAM_STR);

            # Se ejecuta
            if ($mysqlStmt->execute()) {
                $mysqlArrayElements['SQL_ROWS'] = intval($mysqlStmt->fetch(PDO::FETCH_ASSOC)['MY_TOTAL_ROWS']);

                if (intval($mysqlArrayElements['SQL_ROWS']) > 0) {

                    $mysqlStmt->closeCursor();

                    $mysqlArrayElements['SQL_TOTAL_PAGES'] = ceil($mysqlArrayElements['SQL_ROWS'] / $_condicional_['ROWS']);
                    $mysqlArrayElements['SQL_PAGE'] = ($_condicional_['PAGE']);
                    $mysqlArrayElements['SQL_LIMIT'] = (($mysqlArrayElements['SQL_PAGE'] - 1) * $_condicional_['ROWS']);
                    $mysqlArrayElements['SQL_COUNT'] = (strtolower($_condicional_['BY']) == 'asc') ? ($mysqlArrayElements['SQL_ROWS'] - $mysqlArrayElements['SQL_LIMIT']) : ($mysqlArrayElements['SQL_LIMIT'] + 1);
                    #SQL LIMITE
                    $mysqlQueryColumns .= "LIMIT " . $mysqlArrayElements['SQL_LIMIT'] . "," . $_condicional_['ROWS'] . ";";

                    $mysqlStmt = $this->pdo->prepare($mysqlQueryColumns);

                    $mysqlStmt->bindParam(':contenido', $_condicional_['CONTENT'], PDO::PARAM_STR);
                    $mysqlStmt->bindParam(':tipo', $_condicional_['TIPO'], PDO::PARAM_INT);
                    $mysqlStmt->bindParam(':vez', $_condicional_['VEZ'], PDO::PARAM_INT);
                    $mysqlStmt->bindParam(':servicio', $_condicional_['SERVICIO'], PDO::PARAM_INT);
                    $mysqlStmt->bindParam(':finicial', $_condicional_['FINICIAL'], PDO::PARAM_STR);
                    $mysqlStmt->bindParam(':ffinal', $_condicional_['FFINAL'], PDO::PARAM_STR);

                    if ($mysqlStmt->execute()) {

                        while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {
                            array_push(
                                $mysqlArray,
                                array(
                                    "nro" => htmlspecialchars(
                                        (strtolower($_condicional_['BY']) == 'asc') ? $mysqlArrayElements['SQL_COUNT']-- : $mysqlArrayElements['SQL_COUNT']++
                                    ),
                                    "placa" => htmlspecialchars($row['placa']),
                                    "tipo" => array(
                                        'id' => ($row['id_tipo_vehiculo']),
                                        'nombre' => htmlspecialchars($row['nombre_tipo_vehiculo']),
                                    ),
                                    "servicio" => htmlspecialchars($row['servicio_vehiculo']),
                                    "vez" => htmlspecialchars($row['vez']),
                                    "canal" => htmlspecialchars($row['canal']),
                                    "fecha" => getSpecialDateTime($row['fecha_formulario']),
                                    "enviado" => htmlspecialchars(($row['id_estado'] == 2) ? '- NO' : 'SI'),
                                    "resultado" => htmlspecialchars($estadoRtm[$row['id_estado_tecnicomecanica']]),
                                    "opciones" => getEncriptado($row['id']),
                                )
                            );
                        }
                        $this->arrayResponse = array(
                            'statusCode' => 200,
                            'statusText' => 'bien',
                            'message' => 'Resultados encontrados',
                            'elements' => $mysqlArrayElements,
                            'ingreso' => $mysqlArray,
                        );
                        $mysqlStmt->closeCursor();
                    } else {
                        $this->arrayResponse = array(
                            'statusCode' => 200,
                            'statusText' => 'error',
                            'message' => 'Error en la consulta # 2 ',
                        );
                    }
                } else {
                    $this->arrayResponse = array(
                        'statusCode' => 400,
                        'statusText' => 'sin_resultados',
                        'message' => 'La búsqueda no arrojo ningún resultado, por favor inténtelo de nuevo más tarde',
                    );
                }
            } else {
                $this->arrayResponse = array(
                    'statusCode' => 400,
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
    public function InfoIngreso(
        $_id = 1
    ) {

        $mysqlArray = array();

        try {
            $mysqlQuery = "SELECT ";
            // INGRESO
            $mysqlQuery .= "ing.id,ing.vez,ing.fecha_formulario,ing.firma AS firma_ingreso,ing.observaciones,ing.criterio,ing.defectos, ";
            // VEHICULO
            $mysqlQuery .= "veh.id AS id_vehiculo,veh.placa,veh.modelo,veh.vin,veh.numero_puertas,";
            $mysqlQuery .= "veh.pasajeros,veh.kilometraje,veh.blindado,veh.polarizado,veh.vin,veh.id_ensenanza, ";
            $mysqlQuery .= "tiveh.nombre AS tipo_vehiculo, ";
            $mysqlQuery .= "seveh.nombre AS servicio_vehiculo, ";
            $mysqlQuery .= "lin.nombre AS linea, ";
            $mysqlQuery .= "mar.nombre AS marca, ";
            $mysqlQuery .= "col.nombre AS color, ";
            $mysqlQuery .= "ens.nombre AS ensenanza, ";
            $mysqlQuery .= "com.nombre AS combustible, ";
            $mysqlQuery .= "tica.nombre AS tipo_caja, ";
            $mysqlQuery .= "timo.nombre AS tiempo_motor, ";
            $mysqlQuery .= "dise.nombre AS disenio_vehiculo, ";
            $mysqlQuery .= "ticar.nombre AS tipo_carroceria,";
            $mysqlQuery .= "ing.fecha_gncv,ing.nro_gncv,";
            // CONDUCTOR
            $mysqlQuery .= "tipc.nombre AS tipo_documento_conductor,";
            $mysqlQuery .= "cli.nombre AS nombre_conductor,";
            $mysqlQuery .= "cli.apellido AS apellido_conductor,";
            $mysqlQuery .= "cli.telefono_3 AS telefono_conductor,cli.email AS correo_conductor,";
            $mysqlQuery .= "cli.direccion AS direccion_conductor, ";
            $mysqlQuery .= "cli.documento AS documento_conductor, ";
            // PROPIETARIO
            $mysqlQuery .= "tipp.nombre AS tipo_documento_propietario,";
            $mysqlQuery .= "clin.nombre AS nombre_propietario,";
            $mysqlQuery .= "clin.apellido AS apellido_propietario,";
            $mysqlQuery .= "clin.telefono_3 AS telefono_propietario,clin.email AS correo_propietario,";
            $mysqlQuery .= "clin.direccion AS direccion_propietario, ";
            $mysqlQuery .= "clin.documento AS documento_propietario, ";
            $mysqlQuery .= "can.nombre AS canal, ";
            //
            $mysqlQuery .= "concat(usu.nombre,' ',usu.apellido) AS nombre_usuario,usu.firma AS firma_usuario,";
            // PSI
            $mysqlQuery .= "ing.psi_moto_delantera,ing.psi_moto_trasera,";
            $mysqlQuery .= "ing.psi_liviano_delantera_derecha,";
            $mysqlQuery .= "ing.psi_liviano_delantera_izquierda,ing.psi_liviano_trasera_derecha,";
            $mysqlQuery .= "ing.psi_liviano_trasera_izquierda,ing.psi_liviano_repuesto ";
            $mysqlQuery .= "FROM ";
            $mysqlQuery .= "ingreso ing ";
            $mysqlQuery .= "LEFT JOIN vehiculo veh ON ing.id_vehiculo = veh.id ";
            $mysqlQuery .= "LEFT JOIN tipo_vehiculo tiveh ON veh.id_tipo_vehiculo = tiveh.id ";
            $mysqlQuery .= "LEFT JOIN servicio_vehiculo seveh ON veh.id_servicio_vehiculo = seveh.id ";
            $mysqlQuery .= "LEFT JOIN linea lin ON veh.id_linea = lin.id  ";
            $mysqlQuery .= "LEFT JOIN marca mar ON lin.id_marca = mar.id ";
            $mysqlQuery .= "LEFT JOIN color col ON veh.id_color = col.id ";
            $mysqlQuery .= "LEFT JOIN ensenanza ens ON veh.id_ensenanza = ens.id ";
            $mysqlQuery .= "LEFT JOIN combustible com ON veh.id_combustible = com.id ";
            $mysqlQuery .= "LEFT JOIN tipo_caja tica ON veh.id_tipo_caja = tica.id ";
            $mysqlQuery .= "LEFT JOIN tiempos_motor timo ON veh.id_tiempos_motor = timo.id ";
            $mysqlQuery .= "LEFT JOIN disenio dise ON veh.id_disenio = dise.id ";
            $mysqlQuery .= "LEFT JOIN cliente cli ON ing.id_conductor = cli.id ";
            $mysqlQuery .= "LEFT JOIN cliente clin ON ing.id_propietario = clin.id ";
            // tipos documento
            $mysqlQuery .= "LEFT JOIN tipo_documento tipc ON tipc.id = cli.id_tipo_documento ";
            $mysqlQuery .= "LEFT JOIN tipo_documento tipp ON tipp.id = clin.id_tipo_documento ";


            $mysqlQuery .= "LEFT JOIN canal can ON ing.id_canal = can.id ";
            $mysqlQuery .= "LEFT JOIN usuario usu ON ing.id_usuario = usu.id ";
            $mysqlQuery .= "LEFT JOIN tipo_carroceria ticar ON veh.id_tipo_carroceria = ticar.id  ";

            $mysqlQuery .= "WHERE ";
            $mysqlQuery .= "ing.id = :id ";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':id', $_id, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {
                        $mysqlArray = array(
                            'id' => ($row['id']),
                            'id_vehiculo' => ($row['id_vehiculo']),
                            'placa' => htmlspecialchars($row['placa']),
                            'tipo_vehiculo' => htmlspecialchars($row['tipo_vehiculo']),
                            'servicio_vehiculo' => htmlspecialchars($row['servicio_vehiculo']),
                            'kilometraje' => htmlspecialchars($row['kilometraje']),
                            'modelo' => htmlspecialchars($row['modelo']),
                            'marca' => htmlspecialchars($row['marca']),
                            'linea' => htmlspecialchars($row['linea']),
                            'color' => htmlspecialchars($row['color']),
                            'vin' => htmlspecialchars($row['vin']),
                            'ensenanza' => htmlspecialchars($row['id_ensenanza']),
                            'combustible' => htmlspecialchars($row['combustible']),
                            'nro_gncv' => htmlspecialchars($row['nro_gncv']),
                            'fecha_gncv' => getSpecialDate($row['fecha_gncv']),
                            'puertas' => htmlspecialchars($row['numero_puertas']),
                            'pasajeros' => htmlspecialchars($row['pasajeros']),
                            'blindado' => htmlspecialchars($row['blindado']),
                            'polarizado' => htmlspecialchars($row['polarizado']),
                            'tipo_caja' => htmlspecialchars($row['tipo_caja']),
                            'tiempo_motor' => htmlspecialchars($row['tiempo_motor']),
                            'disenio_vehiculo' => htmlspecialchars($row['disenio_vehiculo']),
                            'canal' => htmlspecialchars($row['canal']),
                            'fecha_ingreso' => getSpecialDateTime($row['fecha_formulario']),
                            'tipo_documento_propietario' => htmlspecialchars($row['tipo_documento_propietario']),
                            'documento_propietario' => htmlspecialchars($row['documento_propietario']),
                            'nombre_propietario' => htmlspecialchars(trim($row['nombre_propietario'])),
                            'apellido_propietario' => htmlspecialchars(trim($row['apellido_propietario'])),
                            'telefono_propietario' => htmlspecialchars($row['telefono_propietario']),
                            'correo_propietario' => htmlspecialchars(trim($row['correo_propietario'])),
                            'direccion_propietario' => htmlspecialchars($row['direccion_propietario']),
                            'tipo_documento_conductor' => htmlspecialchars($row['tipo_documento_conductor']),
                            'documento_conductor' => htmlspecialchars($row['documento_conductor']),
                            'nombre_conductor' => htmlspecialchars(trim($row['nombre_conductor'])),
                            'apellido_conductor' => htmlspecialchars(trim($row['apellido_conductor'])),
                            'telefono_conductor' => htmlspecialchars($row['telefono_conductor']),
                            'correo_conductor' => htmlspecialchars($row['correo_conductor']),
                            'direccion_conductor' => htmlspecialchars($row['direccion_conductor']),
                            'usuario' => htmlspecialchars($row['nombre_usuario']),
                            'carroceria' => htmlspecialchars($row['tipo_carroceria']),
                            'vez' => ($row['vez']),
                            'psi' => array(
                                'moto_delantera' => htmlspecialchars($row['psi_moto_delantera']),
                                'moto_trasera' => htmlspecialchars($row['psi_moto_trasera']),
                                'liviano_delantera_derecha' => htmlspecialchars($row['psi_liviano_delantera_derecha']),
                                'liviano_trasera_derecha' => htmlspecialchars($row['psi_liviano_trasera_derecha']),
                                'liviano_delantera_izquierda' => htmlspecialchars($row['psi_liviano_delantera_izquierda']),
                                'liviano_trasera_izquierda' => htmlspecialchars($row['psi_liviano_trasera_izquierda']),
                                'repuesto' => htmlspecialchars($row['psi_liviano_repuesto']),
                            ),
                            'firma_usuario' => ($row['firma_usuario']),
                            'firma_ingreso' => ($row['firma_ingreso']),
                            'observaciones' => ($row['observaciones']),
                            'criterio' => ($row['criterio']),
                            'defecto' => ($row['defectos']),

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

    public function getIngreso(
        $_column = 'ID',
        $_value = 0,
        $limit = '0,1'
    ) {

        $arrayColumna = array(
            'ID' => 'ing.id',
            'ID_VEHICULO' => 'veh.id',
        );
        $mysqlArray = array();
        $count = 0;

        try {
            $mysqlQuery = "SELECT ";
            $mysqlQuery .= "ing.id,ing.fecha_formulario, ing.vez, veh.id AS id_vehiculo, ";
            $mysqlQuery .= "veh.placa,veh.modelo,veh.vin,veh.numero_puertas,veh.pasajeros,veh.kilometraje,veh.blindado,veh.polarizado, ";
            $mysqlQuery .= "tiveh.nombre AS tipo_vehiculo, ";
            $mysqlQuery .= "lin.nombre AS linea, ";
            $mysqlQuery .= "mar.nombre AS marca, ";
            $mysqlQuery .= "col.nombre AS color, ";
            $mysqlQuery .= "ens.nombre AS ensenanza, ";
            $mysqlQuery .= "com.nombre AS combustible, ";
            $mysqlQuery .= "tica.nombre AS tipo_caja, ";
            $mysqlQuery .= "timo.nombre AS tiempo_motor, ";
            $mysqlQuery .= "concat(cli.nombre,' ',cli.apellido) AS nombre_conductor,cli.telefono_1 AS telefono_conductor,cli.email AS correo_conductor, ";
            $mysqlQuery .= "clin.nombre As nombre_propietario,clin.apellido As apellido_propietario,clin.telefono_3 AS telefono_propietario,clin.email AS correo_propietario, ";
            $mysqlQuery .= "clin.documento As documento_propietario,clin.id_tipo_documento As tipo_documento, clin.direccion As direccion_propietario, clin.id As id_propietario, ";
            $mysqlQuery .= "can.nombre AS canal, ";
            $mysqlQuery .= "concat(usu.nombre,' ',usu.apellido) AS nombre_usuario ";
            $mysqlQuery .= "FROM ";
            $mysqlQuery .= "ingreso ing ";
            $mysqlQuery .= "LEFT JOIN vehiculo veh ON ing.id_vehiculo = veh.id ";
            $mysqlQuery .= "LEFT JOIN tipo_vehiculo tiveh ON veh.id_tipo_vehiculo = tiveh.id ";
            $mysqlQuery .= "LEFT JOIN linea lin ON veh.id_linea = lin.id  ";
            $mysqlQuery .= "LEFT JOIN marca mar ON lin.id_marca = mar.id ";
            $mysqlQuery .= "LEFT JOIN color col ON veh.id_color = col.id ";
            $mysqlQuery .= "LEFT JOIN ensenanza ens ON veh.id_ensenanza = ens.id ";
            $mysqlQuery .= "LEFT JOIN combustible com ON veh.id_combustible = com.id ";
            $mysqlQuery .= "LEFT JOIN tipo_caja tica ON veh.id_tipo_caja = tica.id ";
            $mysqlQuery .= "LEFT JOIN tiempos_motor timo ON veh.id_tiempos_motor = timo.id ";
            $mysqlQuery .= "LEFT JOIN cliente cli ON ing.id_conductor = cli.id ";
            $mysqlQuery .= "LEFT JOIN cliente clin ON ing.id_propietario = clin.id ";
            $mysqlQuery .= "LEFT JOIN canal can ON ing.id_canal = can.id ";
            $mysqlQuery .= "LEFT JOIN usuario usu ON ing.id_usuario = usu.id ";

            $mysqlQuery .= "WHERE $arrayColumna[$_column] = :value ORDER BY ing.id DESC LIMIT $limit ";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':value', $_value, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {
                        array_push($mysqlArray, array(
                            'id' => ($row['id']),
                            'id_vehiculo' => ($row['id_vehiculo']),
                            'placa' => ($row['placa']),
                            'tipo_vehiculo' => ($row['tipo_vehiculo']),
                            'kilometraje' => ($row['kilometraje']),
                            'modelo' => ($row['modelo']),
                            'marca' => ($row['marca']),
                            'linea' => ($row['linea']),
                            'color' => ($row['color']),
                            'combustible' => ($row['combustible']),
                            'puertas' => ($row['numero_puertas']),
                            'pasajeros' => ($row['pasajeros']),
                            'blindado' => ($row['blindado']),
                            'polarizado' => ($row['polarizado']),
                            'tipo_caja' => ($row['tipo_caja']),
                            'tiempo_motor' => ($row['tiempo_motor']),
                            'vin' => ($row['vin']),
                            'canal' => ($row['canal']),
                            'fecha_ingreso' => getSpecialDateTime($row['fecha_formulario']),
                            'propietario' => array(
                                'id' => ($row['id_propietario']),
                                'tipo_documento' => ($row['tipo_documento']),
                                'documento' => ($row['documento_propietario']),
                                'nombre' => ($row['nombre_propietario']),
                                'apellido' => ($row['apellido_propietario']),
                                'telefono' => ($row['telefono_propietario']),
                                'correo' => ($row['correo_propietario']),
                                'direccion' => ($row['direccion_propietario']),
                            ),
                            'nombre_conductor' => ($row['nombre_conductor']),
                            'telefono_conductor' => ($row['telefono_conductor']),
                            'correo_conductor' => ($row['correo_conductor']),
                            'usuario' => ($row['nombre_usuario']),
                            'vez' => ($row['vez']),
                            'contador' => $count++,
                        ));
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

    public function ListadoPsi(
        $_condicional_ = array(
            'ORDER' => 'ing.id',
            'BY' => 'DESC',
            'PAGE' => '1',
            'ROWS' => '25',
            'COLUMN' => 'ing.id',
            'CONTENT' => '%%',
            'TIPO' => '%%',
            'FINICIAL' => '2022-01-01',
            'FFINAL' => '2030-01-01'
        )
    ) {

        // return;
        $mysqlArray = array();
        try {

            #Contador
            $mysqlQueryCount = "SELECT COUNT(ing.id) AS MY_TOTAL_ROWS ";
            $mysqlQueryColumns = "SELECT ";
            #Columnas
            $mysqlQueryColumns .= "ing.id,veh.placa,tiveh.nombre AS tipo_vehiculo, tica.nombre AS tipo_carroceria,lin.nombre AS linea,
            veh.pasajeros,ing.vez,ing.psi_moto_delantera,ing.psi_moto_trasera,ing.psi_liviano_delantera_derecha,
            ing.psi_liviano_delantera_izquierda,ing.psi_liviano_trasera_derecha,ing.psi_liviano_trasera_izquierda,
            ing.psi_liviano_repuesto,ing.fecha_formulario ";

            #Tabla
            $mysqlQuery = "FROM ";
            $mysqlQuery .= "ingreso ing ";
            $mysqlQuery .= "LEFT JOIN vehiculo veh ON ing.id_vehiculo = veh.id ";
            $mysqlQuery .= "LEFT JOIN tipo_carroceria tica ON veh.id_tipo_carroceria = tica.id ";
            $mysqlQuery .= "LEFT JOIN tipo_vehiculo tiveh ON veh.id_tipo_vehiculo = tiveh.id ";
            $mysqlQuery .= "LEFT JOIN linea lin ON veh.id_linea = lin.id ";
            #Condicion
            $mysqlQuery .= "WHERE ";
            $mysqlQuery .= $_condicional_['COLUMN'] . " LIKE :contenido ";
            $mysqlQuery .= "AND tiveh.id LIKE :tipo ";
            $mysqlQuery .= "AND DATE(ing.fecha_formulario) BETWEEN :finicial AND :ffinal ";
            #Ordenamiento
            $mysqlQuery .= "ORDER BY " . $_condicional_['ORDER'] . " " . $_condicional_['BY'] . " ";
            #Une las consultas

            $mysqlQueryCount .= $mysqlQuery;
            $mysqlQueryColumns .= $mysqlQuery;
            //echo $mysqlQueryColumns;

            $mysqlStmt = $this->pdo->prepare($mysqlQueryCount);

            $mysqlStmt->bindParam(':contenido', $_condicional_['CONTENT'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':tipo', $_condicional_['TIPO'], PDO::PARAM_INT);
            $mysqlStmt->bindParam(':finicial', $_condicional_['FINICIAL'], PDO::PARAM_STR);
            $mysqlStmt->bindParam(':ffinal', $_condicional_['FFINAL'], PDO::PARAM_STR);

            # Se ejecuta
            if ($mysqlStmt->execute()) {
                $mysqlArrayElements['SQL_ROWS'] = intval($mysqlStmt->fetch(PDO::FETCH_ASSOC)['MY_TOTAL_ROWS']);
                if (intval($mysqlArrayElements['SQL_ROWS']) > 0) {
                    $mysqlStmt->closeCursor();
                    $mysqlArrayElements['SQL_TOTAL_PAGES'] = ceil($mysqlArrayElements['SQL_ROWS'] / $_condicional_['ROWS']);
                    $mysqlArrayElements['SQL_PAGE'] = ($_condicional_['PAGE']);
                    $mysqlArrayElements['SQL_LIMIT'] = (($mysqlArrayElements['SQL_PAGE'] - 1) * $_condicional_['ROWS']);
                    $mysqlArrayElements['SQL_COUNT'] = (strtolower($_condicional_['BY']) == 'asc') ? ($mysqlArrayElements['SQL_ROWS'] - $mysqlArrayElements['SQL_LIMIT']) : ($mysqlArrayElements['SQL_LIMIT'] + 1);
                    #SQL LIMITE
                    $mysqlQueryColumns .= "LIMIT " . $mysqlArrayElements['SQL_LIMIT'] . "," . $_condicional_['ROWS'] . ";";

                    $mysqlStmt = $this->pdo->prepare($mysqlQueryColumns);
                    $mysqlStmt->bindParam(':contenido', $_condicional_['CONTENT'], PDO::PARAM_STR);
                    $mysqlStmt->bindParam(':tipo', $_condicional_['TIPO'], PDO::PARAM_INT);
                    $mysqlStmt->bindParam(':finicial', $_condicional_['FINICIAL'], PDO::PARAM_STR);
                    $mysqlStmt->bindParam(':ffinal', $_condicional_['FFINAL'], PDO::PARAM_STR);

                    if ($mysqlStmt->execute()) {

                        while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {

                            array_push(
                                $mysqlArray,
                                array(
                                    "nro" => htmlspecialchars(
                                        (strtolower($_condicional_['BY']) == 'asc') ? $mysqlArrayElements['SQL_COUNT']-- : $mysqlArrayElements['SQL_COUNT']++
                                    ),
                                    "placa" => htmlspecialchars($row['placa']),
                                    "tipo" => htmlspecialchars($row['tipo_vehiculo']),
                                    "carroceria" => htmlspecialchars($row['tipo_carroceria']),
                                    "vez" => htmlspecialchars($row['vez']),
                                    "fecha" => getSpecialDateTime($row['fecha_formulario']),
                                    "opciones" => getEncriptado($row['id']),
                                )
                            );
                        }
                        $this->arrayResponse = array(
                            'statusCode' => 200,
                            'statusText' => 'bien',
                            'message' => 'Resultados encontrados',
                            'elements' => $mysqlArrayElements,
                            'ingreso' => $mysqlArray,
                        );
                        $mysqlStmt->closeCursor();
                    } else {
                        $this->arrayResponse = array(
                            'statusText' => 'error',
                            'message' => 'Error en la consulta # 2 ',
                        );
                    }
                } else {
                    $this->arrayResponse = array(
                        'statusCode' => 400,
                        'statusText' => 'sin_resultados',
                        'message' => 'La búsqueda no arrojo ningún resultado, por favor inténtelo de nuevo más tarde',
                    );
                }
            } else {
                $this->arrayResponse = array(
                    'statusCode' => 400,
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

        // var_dump($this->arrayResponse);

        return $this->arrayResponse;
    }

    public function getIngresRtm(
        $_column = 'ID',
        $_value = 0,
        $limit = '0,1'
    ) {

        $arrayColumna = array(
            'ID' => 'ing.id',
            'ID_VEHICULO' => 'veh.id',
        );
        $mysqlArray = array();
        $count = 1;

        try {
            $mysqlQuery = "SELECT ";
            $mysqlQuery .= "ing.id,ing.fecha_formulario, ing.vez, ";
            $mysqlQuery .= "veh.placa,";
            $mysqlQuery .= "concat(cond.nombre,' ',cond.apellido) AS nombre_conductor, ";
            $mysqlQuery .= "can.nombre AS canal ";
            $mysqlQuery .= "FROM ";
            $mysqlQuery .= "ingreso ing ";
            $mysqlQuery .= "LEFT JOIN vehiculo veh ON ing.id_vehiculo = veh.id ";
            $mysqlQuery .= "LEFT JOIN cliente cond ON ing.id_conductor = cond.id ";
            $mysqlQuery .= "LEFT JOIN canal can ON ing.id_canal = can.id ";
            $mysqlQuery .= "WHERE $arrayColumna[$_column] = :value ORDER BY ing.id DESC LIMIT $limit ";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':value', $_value, PDO::PARAM_INT);

            if ($mysqlStmt->execute()) {
                if (intval($mysqlStmt->rowCount()) > 0) {
                    while ($row = $mysqlStmt->fetch(PDO::FETCH_BOTH)) {
                        array_push($mysqlArray, array(
                            'contador' => $count++,
                            'conductor' => htmlspecialchars($row['nombre_conductor']),
                            'vez' => htmlspecialchars($row['vez']),
                            'canal' => htmlspecialchars($row['canal']),
                            'fecha' => getSpecialDateTime($row['fecha_formulario']),
                            'opciones' => getEncriptado($row['id']),
                        ));
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

    public function createCertificado(
        $_id_vehiculo = 0,
        $_id_ingreso = 0,
        $_fecha = '0000-00-00',
        $_resultado = 1,
        $_id_usuario = 1

    ) {

        try {
            $mysqlQuery = "CALL proc_crear_certificado(";
            $mysqlQuery .= ":vehiculo, ";
            $mysqlQuery .= ":ingreso, ";
            $mysqlQuery .= ":fecha, ";
            $mysqlQuery .= ":resultado, ";
            $mysqlQuery .= ":usuario,";

            $mysqlQuery .= " @response)";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':vehiculo', $_id_vehiculo, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':ingreso', $_id_ingreso, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':fecha', $_fecha, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':resultado', $_resultado, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':usuario', $_id_usuario, PDO::PARAM_INT);

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
                        // 'id' => isset($responseArray[2]) ? $responseArray[2] : 'NO_APLICA',
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
    public function updatePlaca(
        $id_ingreso = 0,
        $id_vehiculo = 0,
        $placa_original = '',
        $placa_nueva = '',
        $razon = '...',
        $_id_usuario = 1
    ) {

        try {
            $mysqlQuery = "CALL procActualizarPlacaIngreso(";
            $mysqlQuery .= ":ingreso, ";
            $mysqlQuery .= ":vehiculo, ";
            $mysqlQuery .= ":placaoriginal, ";
            $mysqlQuery .= ":placanuevo, ";
            $mysqlQuery .= ":razon, ";
            $mysqlQuery .= ":usuario,";

            $mysqlQuery .= " @response)";
            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':ingreso', $id_ingreso, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':vehiculo', $id_vehiculo, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':placaoriginal', $placa_original, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':placanuevo', $placa_nueva, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':razon', $razon, PDO::PARAM_STR);
            $mysqlStmt->bindParam(':usuario', $_id_usuario, PDO::PARAM_INT);

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
                        // 'id' => isset($responseArray[2]) ? $responseArray[2] : 'NO_APLICA',
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
    public function setIngresoVin(
        $_id = 0,
        $_vin = 'vin'
    ) {

        try {

            $mysqlQuery = "UPDATE ";
            $mysqlQuery .= "vehiculo ";
            $mysqlQuery .= "SET ";
            $mysqlQuery .= "vin = :vin ";
            $mysqlQuery .= "WHERE ";
            $mysqlQuery .= "id = :id; ";

            $mysqlStmt = $this->pdo->prepare($mysqlQuery);

            $mysqlStmt->bindParam(':id', $_id, PDO::PARAM_INT);
            $mysqlStmt->bindParam(':vin', $_vin, PDO::PARAM_STR);

            if ($mysqlStmt->execute()) {
                //if ($mysqlStmt->rowCount()) {
                $this->arrayResponse = array(
                    'statusCode' => 200,
                    'statusText' => 'bien',
                    'message' => 'vin actualizado',
                );
                $mysqlStmt->closeCursor();
                // } else {
                //    $this->arrayResponse = array(
                //        'statusCode' => 200,
                //         'statusText' => 'igual',
                //         'message' => 'El vin es igual al ya guardado',
                //     );
                // }
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
