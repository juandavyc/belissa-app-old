<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/app/config.php';
$app = new MyCallCenterApp();
$app->verificar->isVigenteSession('HTML');
$app->verificar->isAutorizado('cda-agendamiento', true);
$app->menu->setModulo($app->menu->getMenuArray()['cda-agendamiento']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php require $app->ruta->getHead() ?>
    <?= $app->ruta->getCSS('agendamiento') ?>
</head>

<body data-id="cda-agendamiento" class="is-preload landing">
    <div id="page-wrapper">
        <article id="main">
        <?php require $app->ruta->getView('RecuperarSession') ?>
            <?php require $app->ruta->getView('agendamiento-cda/Main') ?>
        </article>
        <?php require $app->ruta->getFooter() ?>
    </div>
    <?= $app->menu->getMenu($app::NAME, $app->ruta->getRoot()) ?>
    <?php require $app->ruta->getScript() ?>
    <?php require $app->ruta->getScriptHelix() ?>
    <script src="<?= $app->ruta->getController('agendamiento-cda/main') ?>" type="module"></script>    
</body>

</html>