<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';
$recursosApp = new RecursosApp();
$recursosApp->verificarSession('HTML');
$recursosApp->verificarModulo('ingreso-completo', true);
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Ingreso completo | Belissa CallCenter</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="csrf-token" content="<?=$_SESSION['csrf_token']?>">
    <link rel="shortcut icon" type="image/jpg" href="/images/favicon.png" />
    <link rel="stylesheet" href="/assets/css/main_<?=$_SESSION['session_user'][7]?>.css" />
    <link rel="stylesheet" href="/assets/css/jquery_<?=$_SESSION['session_user'][7]?>.css" />
    <link rel="stylesheet" href="/modulos/app/css/ingreso-completo/style_<?=$_SESSION['session_user'][7]?>.css" />
    <noscript>
        <link rel="stylesheet" href="/assets/css/noscript.css" />
    </noscript>
</head>

<body data-id="ingreso-completo" class="is-preload landing">

    <div id="page-wrapper">
        <?php require DOCUMENT_ROOT . '/assets/html/my_camera.html';?>
        <article id="main">
            <header class="special container">
                <span class="icon solid fa-file-circle-plus"></span>
                <h2>Ingreso de vehículos</h2>
                <p><?php echo $_SESSION['session_user'][3]; ?></p>
            </header>
            <nav class="breadcrumbs" id="breadcrumbs_global"></nav>
            <section class="wrapper style4 container max">
                <!-- ingreso - placa -->
                <?php require DOCUMENT_ROOT . '/modulos/app/vista/ingreso-completo/placa.php';?>
                <!-- ingreso - vehiculo -->
                <?php require DOCUMENT_ROOT . '/modulos/app/vista/ingreso-completo/ingreso.php';?>
            </section>

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
    <script src="/assets/js/ckeditor-basic/ckeditor.js"></script>
    <script src="/assets/js/jquery.validate.min.js"></script>
    <script src="/assets/js/localization/messages_es.js"></script>
    <script src="/modulos/app/js/main_private.js"></script>
    <!-- <script src="/assets/js/vbuscador.js"></script> -->
    <script src="/modulos/app/js/my_canvas.js?v=1"> </script>
    <script src="/modulos/app/js/my_camera.js"></script>
    <script src="/modulos/app/js/my_autocomplete.js"></script>
    <script type="module" src="/modulos/app/controlador/ingreso-completo/main.js?v=1.4"></script>
</body>

</html>