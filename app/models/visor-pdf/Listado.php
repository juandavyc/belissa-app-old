<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
        if (
            isset($_POST['filtro']) &&
            isset($_POST['contenido']) &&
            isset($_POST['tipo']) &&
            isset($_POST['servicio']) &&
            isset($_POST['vez']) &&
            isset($_POST['ignorar_fecha']) &&
            isset($_POST['resultados']) &&
            isset($_POST['fecha_inicial']) &&
            isset($_POST['fecha_final']) &&
            isset($_POST['page']) &&
            isset($_POST['order']) &&
            isset($_POST['by']) &&
            isset($_POST['status']) &&
            count($_POST) == 13
        ) {

            $json_status = "error";
            $json_title = array();
            $json_body = array();
            $json_head = array();
            $json_message = array();
            $json_pagination = array();

            $php_array_filtro = array(
                '0' => "ing.id",
                '1' => "veh.placa",
                '5' => "can.nombre",
                '6' => "prop.documento",
                '7' => "prop.nombre",
                '8' => "prop.apellido",
                '9' => "prop.telefono_3",
                '10' => "prop.email",
                '11' => "prop.direccion",
                '12' => "cond.documento",
                '13' => "cond.nombre",
                '14' => "cond.apellido",
                '15' => "cond.telefono_3",
                '16' => "cond.email",
                '17' => "cond.direccion",

            );

            $php_array_order = array(
                'nro' => "ing.id",
                'placa' => "veh.placa",
                'tipo' => "tiveh.nombre",
                'servicio' => "seveh.nombre",
                'vez' => "ing.vez",
                'canal' => "can.nombre",
                'fecha ingreso' => "ing.fecha_formulario",
                'enviado' => "ing.id_estado",
                'opciones' => "ing.id",
            );
            $php_array_by = array(
                'asc' => "ASC",
                'desc' => "DESC",
            );

            $form_filtro = getsafearray($php_array_filtro, htmlspecialchars($_POST["filtro"]), 1);
            $form_contenido = htmlspecialchars($_POST["contenido"]);
            $form_tipo = htmlspecialchars($_POST["tipo"]);
            $form_vez = htmlspecialchars($_POST["vez"]);
            $form_servicio = htmlspecialchars($_POST["servicio"]);
            $form_order = getsafearray($php_array_order, htmlspecialchars($_POST["order"]), 1);
            $form_by = getsafearray($php_array_by, htmlspecialchars($_POST["by"]), 1);
            $from_page = htmlspecialchars($_POST['page']);

            $form_rows = htmlspecialchars($_POST['resultados']);

            $form_contenido = ($form_filtro == 0) ? "%%" : $form_contenido . '%';
            $form_tipo = ($form_tipo == 0) ? "%%" : $form_tipo;
            $form_servicio = ($form_servicio == 0) ? "%%" : $form_servicio;
            $form_vez = ($form_vez == 0) ? "%%" : $form_vez;
            $form_rows = ($form_rows == 0) ? 1000 : $form_rows; // $filtro

            $form_ignorar = ($_POST["ignorar_fecha"]);
            $form_fecha_inicial = ($form_ignorar == 2) ? getSpecialDateDatabase($_POST['fecha_inicial']) : '2022-01-01';
            $form_fecha_final = ($form_ignorar == 2) ? getSpecialDateDatabase($_POST['fecha_final']) : '2030-01-01';

            $ingresoClass = new IngresoClass($__pdo);
            $elementClassResponse = $ingresoClass->ListadoIngreso(
                array(
                    'ORDER' => $php_array_order[$form_order],
                    'BY' => $php_array_by[$form_by],
                    'PAGE' => $from_page,
                    'ROWS' => $form_rows,
                    'COLUMN' => $php_array_filtro[$form_filtro],
                    'CONTENT' => $form_contenido,
                    'TIPO' => $form_tipo,
                    'VEZ' => $form_vez,
                    'SERVICIO' => $form_servicio,
                    'FINICIAL' => $form_fecha_inicial,
                    'FFINAL' => $form_fecha_final,
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
                $json_body = $elementClassResponse['ingreso'];
                $json_pagination = array(
                    "pages" => intval($elementClassResponse['elements']['SQL_PAGE']),
                    "total_pages" => intval($elementClassResponse['elements']['SQL_TOTAL_PAGES']),
                );
            }
            else{
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
        } else {
            $__modelResponseApp = ($__configuracionApp->mensaje->getFormularioIcompleto());
        }
    } else {
        $__modelResponseApp = ($__configuracionApp->mensaje->getSinPermisos());
    }
} else {
    echo "<h1>404 Not Found</h1>";
    echo "The page that you have requested could not be found.";
}