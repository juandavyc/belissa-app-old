<?php

if (isset($__configuracionApp)) {
    if (isset($_POST['status'])) {
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

            // include DOCUMENT_ROOT . '/modulos/assets/php/clases/rango/rango.class.php';

            $php_array_filtro = array(
                '0' => "ran.id",
                '1' => "ran.nombre",
            );
            $php_array_order = array(
                'nro' => "ran.id",
                'nombre' => "ran.nombre",
                'modulos' => "ran.modulos",
                'fecha_formulario' => "ran.fecha_formulario",
                'opciones' => "ran.id",
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

            $form_contenido = ($form_filtro == 0) ? "%%" : $form_contenido . '%';
            $form_rows = ($form_rows == 0) ? 1000 : $form_rows; // $filtro

            $rangoClass = new RangoClass($__pdo);
            $classResponse = $rangoClass->ListadoRango(
                array(
                    'ORDER' => $php_array_order[$form_order],
                    'BY' => $php_array_by[$form_by],
                    'PAGE' => $from_page,
                    'ROWS' => $form_rows,
                    'COLUMN' => $php_array_filtro[$form_filtro],
                    'CONTENT' => $form_contenido,
                )
            );

            if ($classResponse['statusText'] == 'bien' && $classResponse['statusCode'] == 200) {

                $json_status = "bien";
                $json_title = array(
                    "total" => intval($classResponse['elements']['SQL_ROWS']),
                    "page" => intval($classResponse['elements']['SQL_PAGE']),
                    "total_pages" => intval($classResponse['elements']['SQL_TOTAL_PAGES']),
                );

                $json_head = array(
                    "fields" => array_keys($php_array_order),
                    "order" => $form_order,
                    "by" => $form_by,
                );

                $json_message = $classResponse['rango'];
                $json_pagination = array(
                    "pages" => intval($classResponse['elements']['SQL_PAGE']),
                    "total_pages" => intval($classResponse['elements']['SQL_TOTAL_PAGES']),
                );
            } else {
                $json_status = $classResponse['statusText'];
                $json_message = $classResponse['message'];
            }

            $__modelResponseApp = array(
                'statusCode' => 200,
                'statusText' => $json_status,
                'title' => $json_title,
                'head' => $json_head,
                'body' => $json_message,
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
