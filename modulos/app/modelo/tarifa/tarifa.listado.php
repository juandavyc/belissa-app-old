<?php

if (
    isset($_POST['filtro']) &&
    isset($_POST['contenido']) &&
    isset($_POST['ignorar_fecha']) &&
    isset($_POST['resultados']) &&
    isset($_POST['fecha_inicial']) &&
    isset($_POST['fecha_final']) &&
    isset($_POST['page']) &&
    isset($_POST['order']) &&
    isset($_POST['by']) &&
    isset($_POST['status']) &&
    count($_POST) == 10
) {

    $json_status = "error";
    $json_title = array();
    $json_head = array();
    $json_message = array();
    $json_pagination = array();
    
    
    $php_array_filtro = array(
        '0' => "tar.id",
        '1' => "tar.desde",    
        '2' => "tar.hasta",   
        '3' => "tar.precio",    
        '4' => "titar.nombre",  
    );
    
    $php_array_order = array(
        'nro' => "tar.id",  
        'tipo de vehiculo' => "titar.nombre", 
        'modelos desde' => "tar.desde",   
        'modelos hasta' => "tar.hasta",  
        'precio' => "tar.hasta",            
        'usuario responsable' => "usu.nombre",       
        'fecha formulario' => "tar.fecha_formulario",
        'opciones' => "tar.id",
    );
    $php_array_by = array(
        'asc' => "ASC",
        'desc' => "DESC",
    );
    
    $form_filtro = getsafearray($php_array_filtro, htmlspecialchars($_POST["filtro"]), 1);
    $form_contenido = htmlspecialchars($_POST["contenido"]);
    $form_order = getsafearray($php_array_order, htmlspecialchars($_POST["order"]), 1);
    $form_by = getsafearray($php_array_by, htmlspecialchars($_POST["by"]), 1);
    $from_page = htmlspecialchars($_POST['page']);
    
    $form_rows = htmlspecialchars($_POST['resultados']);
    
 
    
    $form_contenido = ($form_filtro == 0 ) ? "%%" : $form_contenido . '%';
    $form_rows = ($form_rows == 0) ? 1000 : $form_rows; // $filtro
    
    $tarifaClass = new TarifaClass($this->pdo);
    $this->arrayResponse = $tarifaClass->ListadoTarifa(
        array(
            'ORDER' => $php_array_order[$form_order],
            'BY' => $php_array_by[$form_by],
            'PAGE' => $from_page,
            'ROWS' => $form_rows,
            'COLUMN' => $php_array_filtro[$form_filtro],
            'CONTENT' => $form_contenido,
          
            )
        );


        // var_dump($this->arrayResponse);

        // LO EMPIZA A DEVOLVER DESDE AQUÍ, EL ERROR PUEDE ESTAR EN LA CLASS
        // return;

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

        $json_message = $this->arrayResponse['tarifa'];
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
    //  else {
    //     $json_status = $this->arrayResponse['status'];
    //     $json_message = $this->arrayResponse['message'];
    // }


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