<?php

if (
    isset($_POST['filtro']) &&
    isset($_POST['contenido']) &&
    isset($_POST['estado_agendamiento']) &&
    isset($_POST['ignorar_fecha']) &&
    isset($_POST['resultados']) &&
    isset($_POST['tipo_fecha']) &&
    isset($_POST['fecha_inicial']) &&
    isset($_POST['fecha_final']) &&
    isset($_POST['page']) &&
    isset($_POST['order']) &&
    isset($_POST['by']) &&
    isset($_POST['status']) &&
    count($_POST) == 12
) {

    $json_status = "error";
    $json_title = array();
    $json_head = array();
    $json_message = array();
    $json_pagination = array();

    $php_array_filtro = array(
        '0' => "agen.id",
        '1' => "veh.placa",
        '2' => "cli.documento",
        '3' => "cli.telefono_2",
        
    );

    $php_array_order = array(
        'nro' => "agen.id",
        'placa' => "veh.placa",
        #'cliente' => "cli.nombre",
        'asistir' => "agen.fecha",
        'horario' => "hor.nombre",
        'canal' => "can.nombre",
        'estado' => "esagen.nombre",
        'creado' => "agen.fecha_formulario",
        'opciones' => "agen.id",
    );
    $php_array_by = array(
        'asc' => "ASC",
        'desc' => "DESC",
    );

    $form_filtro = getsafearray($php_array_filtro, htmlspecialchars($_POST["filtro"]), 1);
    $form_contenido = htmlspecialchars($_POST["contenido"]);
    $form_estado_agendamiento = htmlspecialchars($_POST["estado_agendamiento"]);
    $form_order = getsafearray($php_array_order, htmlspecialchars($_POST["order"]), 1);
    $form_by = getsafearray($php_array_by, htmlspecialchars($_POST["by"]), 1);
    $from_page = htmlspecialchars($_POST['page']);

    $form_rows = htmlspecialchars($_POST['resultados']);

    $form_contenido = ($form_filtro == 0) ? "%%" : $form_contenido . '%';
    $form_estado_agendamiento = ($form_estado_agendamiento == 0) ? "%%" : $form_estado_agendamiento;
    $form_rows = ($form_rows == 0) ? 1000 : $form_rows;

  $form_tipo_fecha = ($_POST["tipo_fecha"]);
    $form_ignorar = ($_POST["ignorar_fecha"]);
    
    
    $form_fecha_inicial = getSpecialDateDatabase($_POST['fecha_inicial']);
    $form_fecha_final = getSpecialDateDatabase($_POST['fecha_final']);

    if ($form_filtro > 0 || $form_ignorar == 1) {
        $form_fecha_inicial = '2022-01-01';
        $form_fecha_final = '2030-01-01';
    }

 
    

    $usuario = $_SESSION['session_user'][1];

    $agenClass = new AgendamientoCanalClass($this->pdo);

    $this->arrayResponse = $agenClass->getBuscador(
        array(
            'ORDER' => $php_array_order[$form_order],
            'BY' => $php_array_by[$form_by],
            'PAGE' => $from_page,
            'ROWS' => $form_rows,
            'COLUMN' => $php_array_filtro[$form_filtro],
            'CONTENT' => $form_contenido,
            'TIPO' => $form_estado_agendamiento,
            'TIPO_FECHA' => $form_tipo_fecha,
            'FINICIAL' => $form_fecha_inicial,
            'FFINAL' => $form_fecha_final,
            'CANAL' => $usuario,
        )
    );

    if ($this->arrayResponse['statusText'] == 'bien' && $this->arrayResponse['statusCode'] == 200) {

        $json_status = "bien";
        $json_title = array(
            "total" => intval($this->arrayResponse['elements']['SQL_ROWS']),
            "page" => intval($this->arrayResponse['elements']['SQL_PAGE']),
            "total_pages" => intval($this->arrayResponse['elements']['SQL_TOTAL_PAGES']),
        );
        $json_head = array(
            "fields" => array_keys($php_array_order),
            "order" => $form_order,
            "by" => $form_by,
        );

        $json_message = $this->arrayResponse['agendamiento'];
        $json_pagination = array(
            "pages" => intval($this->arrayResponse['elements']['SQL_PAGE']),
            "total_pages" => intval($this->arrayResponse['elements']['SQL_TOTAL_PAGES']),
        );

        $this->arrayResponse = array(
            'statusCode' => 200,
            'statusText' => $json_status,
            'title' => $json_title,
            'head' => $json_head,
            'body' => $json_message,
            'pages' => $json_pagination,
        );
    }

    $this->pdo = null;
} else if (!isset($_config)) {
    if (!isset($_POST['status'])) {
        echo json_encode(array('statusCode' => 400, 'statusText' => false, 'message' => 'Bad request'), http_response_code(400), JSON_FORCE_OBJECT);
        exit;
    } else {
        echo json_encode(array('statusCode' => 400, 'statusText' => 'error', 'message' => 'Formulario incompleto'), JSON_FORCE_OBJECT);
        exit;
    }
}