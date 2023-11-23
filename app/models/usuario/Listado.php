<?php

if (isset($__configuracionApp)) {

    if (
        isset($_POST['filtro']) &&
        isset($_POST['contenido']) &&
        isset($_POST['resultados']) &&
        isset($_POST['rango']) &&
        isset($_POST['estado']) &&
        isset($_POST['page']) &&
        isset($_POST['order']) &&
        isset($_POST['by']) &&
        isset($_POST['status']) &&
        count($_POST) == 9
    ) {

        $json_status = "error";
        $json_title = array();
        $json_body = array();
        $json_head = array();
        $json_message = array();
        $json_pagination = array();

        $php_array_filtro = array(
            "usu.id",
            "usu.documento",
            "usu.nombre",
            "usu.apellido",
            "usu.correo",
        );
        $php_array_order = array(
            'nro' => "usu.id",
            'documento' => "usu.documento",
            'nombre' => "usu.nombre",
            'rango' => "rang.nombre",
            'estado' => "est_usu.nombre",
            'creado' => "usu.fecha_formulario",
            'opciones' => "usu.id",
        );
        $php_array_by = array(
            'asc' => "ASC",
            'desc' => "DESC",
        );

        $form_filtro = getsafearray($php_array_filtro, htmlspecialchars($_POST["filtro"]), 1);
        $form_contenido = htmlspecialchars($_POST["contenido"]);
        $form_order = getsafearray($php_array_order, htmlspecialchars($_POST["order"]), 1);
        $form_by = getsafearray($php_array_by, htmlspecialchars($_POST["by"]), 1);

        $form_rango = htmlspecialchars($_POST['rango']);
        $form_estado = htmlspecialchars($_POST['estado']);

        $form_page = htmlspecialchars($_POST['page']);
        $form_rows = htmlspecialchars($_POST['resultados']);

        $form_rango = ($form_rango == 0) ? "%%" : $form_rango;
        $form_estado = ($form_estado == 0) ? "%%" : $form_estado;

        $form_contenido = ($form_filtro == 0) ? "%%" : $form_contenido . '%';
        $form_rows = ($form_rows == 0) ? 1000 : $form_rows;

        $usuarioClass = new UsuarioClass($__pdo);
        $elementClassResponse = $usuarioClass->ListadoUsuario(
            array(
                'ORDER' => $php_array_order[$form_order],
                'BY' => $php_array_by[$form_by],
                'PAGE' => $form_page,
                'ROWS' => $form_rows,
                'COLUMN' => $php_array_filtro[$form_filtro],
                'CONTENT' => $form_contenido,
                'RANGO' => $form_rango,
                'ESTADO' => $form_estado,
            )
        );

        if ($elementClassResponse['statusText'] == 'bien' && $elementClassResponse['statusCode'] == 200) {

            $json_status = "bien";
            $json_title = array(
                "total" => intval($elementClassResponse['elements']['SQL_ROWS']),
                "page" => intval($elementClassResponse['elements']['SQL_PAGE']),
                "total_pages" => intval($elementClassResponse['elements']['SQL_TOTAL_PAGES']),
            );
            $json_head = array(
                "fields" => array_keys($php_array_order),
                "order" => $form_order,
                "by" => $form_by,
            );

            $json_message = $elementClassResponse['message'];
            $json_body = $elementClassResponse['usuario'];
            $json_pagination = array(
                "pages" => intval($elementClassResponse['elements']['SQL_PAGE']),
                "total_pages" => intval($elementClassResponse['elements']['SQL_TOTAL_PAGES']),
            );
        } else {
            $json_status = $elementClassResponse['statusText'];
            $json_title = $elementClassResponse['statusText'];
            $json_message = $elementClassResponse['message'];
        }

        $__modelResponseApp = array(
            'statusCode' => 200,
            'statusText' => $json_status,
            'title' => $json_title,
            'message' => $json_message,
            'head' => $json_head,
            'body' => $json_body,
            'pages' => $json_pagination,
        );

        $__pdo = null;
    } else if (!isset($_POST['status'])) {
        $__modelResponseApp = ($__configuracionApp->mensaje->getSinPermisos());
    } else {
        $__modelResponseApp = ($__configuracionApp->mensaje->getFormularioIcompleto());
    }
} else {
    echo "<h1>404 Not Found</h1>";
    echo "The page that you have requested could not be found.";
}
