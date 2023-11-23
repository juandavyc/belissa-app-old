<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/app/config.php';
$app = new MyCallCenterApp();
$app->verificar->isVigenteSession('HTML');
$app->verificar->isAutorizado('crear-cliente-vehiculo', true);
$app->menu->setModulo($app->menu->getMenuArray()['crear-cliente-vehiculo']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php require $app->ruta->getHead() ?>
    <?= $app->ruta->getCSS('ingreso-completo') ?>
</head>

<body data-id="crear-cliente-vehiculo" class="is-preload landing">
    <div id="page-wrapper">
        <article id="main">
            <?php require $app->ruta->getView('RecuperarSession') ?>
            <?php require $app->ruta->getView('crear-cliente-vehiculo/Main') ?>
        </article>
        <?php require $app->ruta->getFooter() ?>
    </div>
    <?= $app->menu->getMenu($app::NAME, $app->ruta->getRoot()) ?>
    <?php require $app->ruta->getScript() ?>
    <script src="/assets/js/helix/canvas.firma.js"> </script>
    <?php require $app->ruta->getScriptHelix() ?>
    <script src="<?= $app->ruta->getController('crear-cliente-vehiculo/main') ?>" type="module"></script>
</body>

</html>