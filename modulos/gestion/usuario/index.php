<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';
$recursosApp = new RecursosApp();
$recursosApp->verificarSession('HTML');
$recursosApp->verificarModulo('gestion', true);
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Gestionar Usuario | Belissa CallCenter</title>
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
    #form_1_tipo_conexion_seleccionada {
        background: #dceefd1f;
        border: 1px solid #a7bcd230;
        padding: 0.5em;
        border-radius: 4px;
        text-align: center;
    }
    </style>
</head>

<body data-id="Gestión" class="is-preload landing">
    <div id="page-wrapper">
        <?php require DOCUMENT_ROOT . '/assets/html/my_camera.html';?>
        <article id="main">
            <header class="special container">
                <span class="icon solid fas fa-users-line"></span>
                <h2>Gestión - Usuarios</h2>
                <p>Gestionar <b> Usuarios </b> del call center</p>
            </header>
            <nav class="breadcrumbs" id="breadcrumbs_global"></nav>
            <div id="tab-visor">
                <ul>
                    <li><a href="#tabs-0" class="icon solid fa-magnifying-glass"> Buscador </a></li>
                    <li><a href="#tabs-1" class="icon solid fa-plus"> Agregar</a></li>
                </ul>
                <div id="tabs-0">
                    <?php require DOCUMENT_ROOT . '/modulos/app/vista/usuario/buscador.php';?>
                </div>

                <div id="tabs-1">
                    <?php require DOCUMENT_ROOT . '/modulos/app/vista/usuario/agregar.php';?>
                </div>
            </div>
            <?php require DOCUMENT_ROOT . '/modulos/app/vista/usuario/agregar_canal.php';?>
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
    <script src="/assets/js/excanvas.js"></script>
    <script src="../../app/js/my_camera.js"></script>
    <script src="../../app/js/my_canvas.js?v=1"></script>
    <script src="../../app/js/my_autocomplete.js"></script>
    <script src="../../app/js/main_private.js"></script>
    <script src="/assets/js/jquery.validate.min.js"></script>
    <script src="/assets/js/localization/messages_es.js"></script>
    <script src="/assets/js/vbuscador.js"></script>
    <script type="module" src="/modulos/app/controlador/usuario/main.js?v=1"></script>



</body>

</html>