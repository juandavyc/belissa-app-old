<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';
$recursosApp = new RecursosApp();
$recursosApp->verificarSession('HTML');
$recursosApp->verificarModulo('gestion', true);
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Gestor de archivos | Belissa CallCenter</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="csrf-token" content="<?=$_SESSION['csrf_token']?>">
    <link rel="shortcut icon" type="image/jpg" href="/images/favicon.png" />
    <link rel="stylesheet" href="/assets/css/main_<?=$_SESSION['session_user'][7]?>.css" />
    <link rel="stylesheet" href="/assets/css/jquery_<?=$_SESSION['session_user'][7]?>.css" />
    <noscript>
        <link rel="stylesheet" href="/assets/css/noscript.css" />
    </noscript>
    <style>

    </style>
</head>

<body data-id="Gestión" class="is-preload landing">
    <div id="page-wrapper">
        <?php require DOCUMENT_ROOT . '/assets/html/my_camera.html';?>
        <article id="main">
            <header class="special container">
                <span class="icon solid fas fa-file"></span>
                <h2>Gestor de archivos</h2>
                <!-- <p>Los <b>rangos-roles-poderes</b> de la aplicación</p> -->
            </header>
            <nav class="breadcrumbs" id="breadcrumbs_global"></nav>


            <div id="tab-visor">
                <ul>
                    <li><a href="#tabs-0" class="icon solid fa-magnifying-glass"> Buscador </a></li>
                    <li><a href="#tabs-1" class="icon solid fa-plus"> Agregar </a></li>
                </ul>
                <div id="tabs-0">
                    <?php require DOCUMENT_ROOT . '/modulos/app/vista/archivo/buscador.php';?>
                </div>
                <div id="tabs-1">
                    <?php require DOCUMENT_ROOT . '/modulos/app/vista/archivo/agregar.php';?>
                </div>
            </div>
        </article>
        <?php require DOCUMENT_ROOT . '/assets/php/call_footer.php';?>
    </div>

    <?php echo $recursosApp->generarMenu(); ?>

    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/browser.min.js"></script>
    <script src="/assets/js/breakpoints.min.js"></script>
    <script src="/assets/js/util.js"></script>
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/jquery-confirm.js"></script>
    <script src="/assets/js/jquery.tabs.js"></script>
    <script src="/assets/js/jquery.ui.min.js"></script>

    <script src="/assets/js/jquery.validate.min.js"></script>
    <script src="/assets/js/localization/messages_es.js"></script>
    <script src="/assets/js/vbuscador.js"></script>



    <script type="text/javascript">
    function mostrar(id) {
        if (id == "0") {
            $("#form_foto").hide();
            $("#form_video").hide();
            $("#form_pdf").hide();
            $("#form_excel").hide();
            $("#form_documento").hide();

        }
        if (id == "1") {
            $("#form_foto").show();
            $("#form_video").hide();
            $("#form_pdf").hide();
            $("#form_excel").hide();
            $("#form_documento").hide();

        }
        if (id == "2") {
            $("#form_foto").hide();
            $("#form_video").show();
            $("#form_pdf").hide();
            $("#form_excel").hide();
            $("#form_documento").hide();
        }
        if (id == "3") {
            $("#form_foto").hide();
            $("#form_video").hide();
            $("#form_pdf").show();
            $("#form_excel").hide();
            $("#form_documento").hide();
        }
        if (id == "4") {
            $("#form_foto").hide();
            $("#form_video").hide();
            $("#form_pdf").hide();
            $("#form_excel").show();
            $("#form_documento").hide();
        }
        if (id == "5") {
            $("#form_foto").hide();
            $("#form_video").hide();
            $("#form_pdf").hide();
            $("#form_excel").hide();
            $("#form_documento").show();
        }


    }
    </script>



    <script type="module" src="/modulos/app/controlador/archivo/main.js?v=<?php echo time(); ?>"></script>


</body>

</html>