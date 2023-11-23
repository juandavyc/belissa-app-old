<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/app/config.php';
$app = new MyCallCenterApp();
$app->verificar->isVigenteSession('HTML');
$app->verificar->isAutorizado('visor-ingreso', true);
$app->menu->setModulo($app->menu->getMenuArray()['visor-ingreso']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php require $app->ruta->getHead() ?>
    <?= $app->ruta->getCSS('visor-ingreso') ?>
</head>

<body data-id="visor-ingreso" class="is-preload landing">
    <div id="page-wrapper">
        <article id="main">
            <?php require $app->ruta->getView('RecuperarSession') ?>
            <?php require $app->ruta->getView('visor-ingreso/Main') ?>
        </article>
        <?php require $app->ruta->getFooter() ?>
    </div>
    <?= $app->menu->getMenu($app::NAME, $app->ruta->getRoot()) ?>
    <?php require $app->ruta->getScript() ?>
    <?php require $app->ruta->getScriptHelix() ?>
    <script src="<?= $app->ruta->getController('visor-ingreso/main') ?>" type="module"></script>
</body>

</html>