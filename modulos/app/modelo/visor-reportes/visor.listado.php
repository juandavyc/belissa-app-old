<?php

if (
    isset($_POST['filtro']) &&
    isset($_POST['contenido']) &&
    isset($_POST['resultados']) &&
    isset($_POST['fecha_inicial']) &&
    isset($_POST['fecha_final']) &&
    isset($_POST['page']) &&
    isset($_POST['order']) &&
    isset($_POST['by']) &&
    isset($_POST['form_0_tipo']) &&
    isset($_POST['usuario']) &&
    isset($_POST['modulo']) &&
    isset($_POST['status']) &&
    count($_POST) == 12
) {


    $json_status = "error";
    $json_title = array();
    $json_head = array();
    $json_message = array();
    $json_pagination = array();

    $php_array_filtro = array(
        '0' => "bel.id",
    );

    $php_array_order = array(
        'nro' => "bel.id",
        'tipo' => "bel_tip.nombre",
        'modulo' => "bel_mod.nombre",
        'usuario' => "usu.nombre",
        'fecha formulario' => "bel.fecha_formulario",
        'opciones' => "bel.id",
    );

    $php_array_by = array(
        'asc' => "ASC",
        'desc' => "DESC",
    );

    $form_filtro = getsafearray($php_array_filtro, htmlspecialchars($_POST["filtro"]), 1);
    $form_0_tipo = htmlspecialchars($_POST["form_0_tipo"]);
    $modulo = htmlspecialchars($_POST["modulo"]);
    $usuario = htmlspecialchars($_POST["usuario"]);
    $form_contenido = htmlspecialchars($_POST["contenido"]);
    $form_order = getsafearray($php_array_order, htmlspecialchars($_POST["order"]), 1);
    $form_by = getsafearray($php_array_by, htmlspecialchars($_POST["by"]), 1);
    $from_page = htmlspecialchars($_POST['page']);
    $fecha_inicial = getSpecialDateDatabase($_POST['fecha_inicial']);
    $fecha_final = getSpecialDateDatabase($_POST['fecha_final']);

    $form_rows = htmlspecialchars($_POST['resultados']);

    $form_contenido = ($form_filtro == 0) ? "%%" : $form_contenido . '%';
    $form_0_tipo = ($form_0_tipo == 0) ? "%%" : $form_0_tipo . '%';
    $modulo = ($modulo == 0) ? "%%" : $modulo . '%';
    $usuario = ($usuario == 0) ? "%%" : $usuario . '%';
    $form_rows = ($form_rows == 0) ? 1000 : $form_rows; // $filtro



    $BelissaLog = new BelissaLogClass($this->pdo);
    $this->arrayResponse = $BelissaLog->ListadoBelissa(
        array(
            'ORDER' => $php_array_order[$form_order],
            'BY' => $php_array_by[$form_by],
            'PAGE' => $from_page,
            'ROWS' => $form_rows,
            'COLUMN' => $php_array_filtro[$form_filtro],
            'CONTENT' => $form_contenido,
            'USUARIO' => $usuario,
            'TIPO' => $form_0_tipo,
            'MODULO' => $modulo,
            'FINICIAL' => $fecha_inicial,
            'FFINAL' => $fecha_final,

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

        $json_message = $this->arrayResponse['vehiculo'];
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
    } else {
        $json_status = $this->arrayResponse['statusText'];
        $json_message = $this->arrayResponse['message'];
    }

    // var_dump($this->arrayResponse);

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