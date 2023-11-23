<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';
$recursosApp = new RecursosApp();
$recursosApp->verificarSession('HTML');
$recursosApp->verificarModulo('mi_cuenta', true);
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Ingreso | Belissa CallCenter</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="csrf-token" content="<?=$_SESSION['csrf_token']?>">
    <link rel="shortcut icon" type="image/jpg" href="/images/favicon.png" />
    <link rel="stylesheet" href="/assets/css/main_<?=$_SESSION['session_user'][7]?>.css" />
    <link rel="stylesheet" href="/assets/css/jquery_<?=$_SESSION['session_user'][7]?>.css" />
    <noscript>
        <link rel="stylesheet" href="/assets/css/noscript.css" />
    </noscript>
</head>

<body data-id="ingreso" class="is-preload landing">

    <div id="page-wrapper">
        <?php require DOCUMENT_ROOT . '/assets/html/my_camera.html';?>
        <article id="main">
            <header class="special container">
                <span class="icon solid fa-file-circle-plus"></span>
                <h2>Ingreso de vehículos</h2>
                <!-- <p>Paquetes, vehículo, propietario y conductor</p> -->
            </header>

            <div id="tab-visor">
                <ul>
                    <li><a href="#tabs-1">Ingreso de Vehiculo</a></li>

                </ul>

                <div id="tabs-1">
                    <?php require DOCUMENT_ROOT . '/modulos/app/vista/test/testt.php';?>
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
    <script src="/assets/js/ckeditor/ckeditor.js"></script>
    <script src="/assets/js/jquery.validate.min.js"></script>
    <script src="/assets/js/localization/messages_es.js"></script>
    <script src="/assets/js/vbuscador.js"></script>
    <script src="../app/js/js/my_canvas.js"></script>
    <script src="../app/js/js/main_private.js"></script>
    <script type="module" src="/modulos/app/controlador/test/main.js"></script>
    <script src="../app/js/js/my_camera.js"></script>

</body>

</html>