<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/app/config.php';
$app = new MyCallCenterApp();
$app->verificar->isVigenteSession('HTML');
$app->verificar->isAutorizado('documentacion', true);
$app->menu->setModulo($app->menu->getMenuArray()['documentacion']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php require $app->ruta->getHead() ?>
    <?= $app->ruta->getCSS('documentacion') ?>
</head>

<body data-id="documentacion" class="is-preload landing">    
    <div id="page-wrapper">       
        <article id="main"> 
            <?php require $app->ruta->getView('RecuperarSession') ?>
            <?php require $app->ruta->getView('documentacion/Main') ?>
        </article>
        <?php require $app->ruta->getFooter() ?>
    </div>
    <?= $app->menu->getMenu($app::NAME, $app->ruta->getRoot()) ?>
    <?php require $app->ruta->getScript() ?>
</body>

</html>