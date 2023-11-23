<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/app/config.php';
$app = new MyCallCenterApp();
$app->verificar->isVigenteSession('HTML');
$app->verificar->isAutorizado('callcenter', true);
$app->menu->setModulo($app->menu->getMenuArray()['callcenter']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php require $app->ruta->getHead() ?>
    <?= $app->ruta->getCSS('callcenter') ?>
</head>

<body data-id="callcenter" class="is-preload landing">
    <div id="page-wrapper">
        <article id="main">
        <?php require $app->ruta->getView('RecuperarSession') ?>
            <?php require $app->ruta->getView('callcenter/Main') ?>
        </article>
        <?php require $app->ruta->getFooter() ?>
    </div>
    <?= $app->menu->getMenu($app::NAME, $app->ruta->getRoot()) ?>
    <?php require $app->ruta->getScript() ?>
    <script src="/assets/js/ckeditor-basic/ckeditor.js"></script>
    <?php require $app->ruta->getScriptHelix() ?>
    <script src="<?= $app->ruta->getController('callcenter/main') ?>" type="module"></script>    
</body>

</html>