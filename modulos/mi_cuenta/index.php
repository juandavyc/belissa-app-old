<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/assets/php/call_config.php';
$recursosApp = new RecursosApp();
$recursosApp->verificarSession('HTML');
$recursosApp->verificarModulo('mi_cuenta', true);
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Gestionar Mi Cuenta | Belissa CallCenter</title>
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

<body data-id="mi_cuenta" class="is-preload landing">

    <div id="page-wrapper">
        <?php require DOCUMENT_ROOT . '/assets/html/my_camera.html';?>
        <article id="main">
            <header class="special container">
                <span class="icon solid fas fa-user-cog"></span>
                <h2>OPCIONES DE LA CUENTA</h2>
                <p><?php echo $_SESSION['session_user'][3]; ?></p>
            </header>
            <nav class="breadcrumbs" id="breadcrumbs_global"></nav>
            <div id="tab-visor">
                <ul>
                    <li><a href="#tabs-1" class="icon solid fa-magnifying-glass"> Informacion</a></li>
                    <li><a href="#tabs-2" class="icon solid fa-plus"> Cambiar Contraseña</a></li>
                </ul>
                <div id="tabs-1">
                    <?php require DOCUMENT_ROOT . '/modulos/app/vista/mi_cuenta/informacion.php';?>
                </div>

                <div id="tabs-2">
                    <?php require DOCUMENT_ROOT . '/modulos/app/vista/mi_cuenta/contrasena.php';?>
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
    <script src="../app/js/my_camera.js"></script>
    <script src="../app/js/my_canvas.js?v=1"></script>
    <script src="../app/js/main_private.js"></script>
    <script src="/assets/js/jquery.validate.min.js"></script>

    <script type="module" src="/modulos/app/controlador/mi_cuenta/main.js"></script>

    <script>
    function show_pass(_from, _check, _input) {
        if (_check == 1) {
            $('#' + _input).attr('type', 'text');
            $(_from).attr('data-check', '2');
        } else {
            $('#' + _input).attr('type', 'password');
            $(_from).attr('data-check', '1');
        }
    }
    </script>

</body>

</html>