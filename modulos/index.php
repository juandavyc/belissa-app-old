<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';
$recursosApp = new RecursosApp();
$recursosApp->verificarSession('HTML');
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Dashboard | Belissa, Call Center</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="csrf-token" content="<?=$_SESSION['csrf_token']?>">
    <meta name="csrf-dashboard" content="dash_<?=$_SESSION['session_user'][4]?>">
    <link rel="shortcut icon" type="image/png" href="/images/favicon.png" />
    <link rel="stylesheet" href="/assets/css/main_<?=$_SESSION['session_user'][7]?>.css" />
    <link rel="stylesheet" href="/modulos/app/css/inicio/style_<?=$_SESSION['session_user'][7]?>.css" />
    <link rel="stylesheet"
        href="/modulos/app/css/dashboard/style_<?=$_SESSION['session_user'][7]?>.css?v=<?php echo time(); ?>" />
    <noscript>
        <link rel="stylesheet" href="/assets/css/noscript.css" />
    </noscript>
</head>

<body data-id="Inicio" class="is-preload landing">
    <div id="page-wrapper">
        <article id="main">
            <header class="special container">
                <span class="icon solid fa-gauge-high"></span>
                <h2> Dashboard </h2>
                <p><?php echo $_SESSION['session_user'][3]; ?></p>
            </header>
            <nav class="breadcrumbs" id="breadcrumbs_global"></nav>

            <div id="tab-modulos">
                <ul>
                    <li><a href="#tabs-0" class="icon solid fa-gauge-high"> Dashboard </a></li>
                    <li><a href="#tabs-1" class="icon solid fa-newspaper"> Novedades </a></li>
                </ul>
                <div id="tabs-0">
                    <div class="row gtr-50 gtr-uniform">
                        <div class="col-6 col-12-small">
                            <?php require DOCUMENT_ROOT . '/modulos/app/vista/dashboard/perfil.php';?>
                        </div>
                        <div class="col-6 col-12-small">
                            <?php require DOCUMENT_ROOT . '/modulos/app/vista/dashboard/servicio.php';?>
                        </div>
                    </div>
                    <?php require DOCUMENT_ROOT . '/modulos/app/vista/dashboard/administrador.php';?>
                    <?php require DOCUMENT_ROOT . '/modulos/app/vista/dashboard/general.php';?>
                </div>
                <div id="tabs-1">
                    <div class="container-ckeditor" id="container-novedades"></div>
                </div>
            </div>
        </article>
        <?php require DOCUMENT_ROOT . '/assets/php/call_footer.php';?>
    </div>
    <!-- nuevo menú -->
    <?php echo $recursosApp->generarMenu(); ?>

    <!-- Scripts -->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/browser.min.js"></script>
    <script src="/assets/js/breakpoints.min.js"></script>
    <script src="/assets/js/util.js"></script>
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/jquery-confirm.js"></script>
    <script src="/assets/js/jquery.tabs.js"></script>
    <script src="/assets/js/loader.js"></script>
    <script type="module" src="/modulos/app/controlador/dashboard/main.js?v=<?php echo time(); ?>"> </script>
    <script>

    </script>
</body>

</html>