<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/app/config.php';
$app = new MyCallCenterApp();
$app->verificar->isVigenteSession('HTML');
$app->verificar->isAutorizado('ingreso-completo', true);
$app->menu->setModulo($app->menu->getMenuArray()['ingreso-completo']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php require $app->ruta->getHead() ?>
    <?= $app->ruta->getCSS('ingreso-completo') ?>
</head>

<body data-id="ingreso-completo" class="is-preload landing">
    <div id="page-wrapper">
        <article id="main">
            <?php $app->ruta->getComponent('FileChooserCamera') ?>
            <?php require $app->ruta->getView('RecuperarSession') ?>
            <?php require $app->ruta->getView('ingreso-completo/Main') ?>
        </article>
        <?php require $app->ruta->getFooter() ?>
    </div>
    <?= $app->menu->getMenu($app::NAME, $app->ruta->getRoot()) ?>
    <?php require $app->ruta->getScript() ?>
    <script src="/assets/js/helix/qrcode.min.js"></script>
    <script src="/assets/js/helix/filechooser.camera.js"></script>
    <script src="/assets/js/helix/canvas.firma.js"></script>
    <?php require $app->ruta->getScriptHelix() ?>
    <script src="<?= $app->ruta->getController('ingreso-completo/main') ?>" type="module"></script>
</body>

</html>