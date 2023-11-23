<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/app/config.php';
$app = new MyCallCenterApp();
$app->verificar->isVigenteSession('HTML');
$app->verificar->isAutorizado('inicio', true);
$app->menu->setModulo($app->menu->getMenuArray()['inicio']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php require $app->ruta->getHead() ?>
    <meta name="csrf-dashboard" content="dash_<?= $_SESSION['session_user'][4] ?>">
    <?= $app->ruta->getCSS('dashboard') ?>
</head>

<body data-id="inicio" class="is-preload landing">
    <div id="page-wrapper">
        <article id="main">
            <?php require $app->ruta->getView('RecuperarSession') ?>
            <?php require $app->ruta->getView('dashboard/Main') ?>
        </article>
        <?php require $app->ruta->getFooter() ?>
    </div>
    <?= $app->menu->getMenu($app::NAME, $app->ruta->getRoot()) ?>
    <?php require $app->ruta->getScript() ?>
    <?php require $app->ruta->getScriptHelix() ?>
    <script src="/assets/js/loader.js"></script>
    <script src="<?= $app->ruta->getController('dashboard/main') ?>" type="module"></script>
</body>

</html>