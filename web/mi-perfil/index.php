<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/app/config.php';
$app = new MyCallCenterApp();
$app->verificar->isVigenteSession('HTML');
$app->verificar->isAutorizado('mi-perfil', true);
$app->menu->setModulo($app->menu->getMenuArray()['mi-perfil']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php require $app->ruta->getHead() ?>
    <style>
        .icon-contrasenia {
            border: none;
            border-radius: 1px;
            background: #ced4da;
            height: 35px;
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
            color: #202020;
        }

        .input-contrasenia {
            border-radius: 10px;
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }
    </style>
</head>

<body data-id="mi-perfil" class="is-preload landing">
    <div id="page-wrapper">
        <article id="main">
            <?php $app->ruta->getComponent('FileChooserCamera') ?>
            <?php require $app->ruta->getView('RecuperarSession') ?>
            <?php require $app->ruta->getView('mi-perfil/Main') ?>
        </article>
        <?php require $app->ruta->getFooter() ?>
    </div>
    <?= $app->menu->getMenu($app::NAME, $app->ruta->getRoot()) ?>

    <?php require $app->ruta->getScript() ?>
    <?php require $app->ruta->getScriptHelix() ?>

    <script src="/assets/js/helix/filechooser.camera.js"> </script>
    <script src="/assets/js/helix/canvas.firma.js"></script>

    <script src="<?= $app->ruta->getController('mi-perfil/main') ?>" type="module"></script>
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