<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/app/config.php';
$app = new MyCallCenterApp();
$app->verificar->isVigenteSession('HTML');
$app->verificar->isAutorizado('ingreso-rapido', true);
$app->menu->setModulo($app->menu->getMenuArray()['ingreso-rapido']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php require $app->ruta->getHead() ?>
    <?= $app->ruta->getCSS('ingreso-completo') ?>
</head>

<body data-id="ingreso-rapido" class="is-preload landing">
    <div id="page-wrapper">
        <article id="main">
            <?php $app->ruta->getComponent('FileChooserCamera') ?>
            <?php require $app->ruta->getView('RecuperarSession') ?>
            <?php require $app->ruta->getView('ingreso-rapido/Main') ?>
        </article>
        <?php require $app->ruta->getFooter() ?>
    </div>
    <?= $app->menu->getMenu($app::NAME, $app->ruta->getRoot()) ?>
    <?php require $app->ruta->getScript() ?>
    <script src="/assets/js/helix/qrcode.min.js"></script>
    <script src="/assets/js/helix/filechooser.camera.js"></script>
    <script src="/assets/js/helix/canvas.firma.js"></script>
    <?php require $app->ruta->getScriptHelix() ?>
    <script src="<?= $app->ruta->getController('ingreso-rapido/main') ?>" type="module"></script>
</body>

</html>