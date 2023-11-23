<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/app/config.php';
$app = new MyCallCenterApp();
$app->verificar->isVigenteSession('HTML');
$app->verificar->isAutorizado('cpanel', true);
$app->menu->setModulo($app->menu->getMenuArray()['cpanel']['sub-menu']['novedades']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php require $app->ruta->getHead() ?>
    </style>
</head>

<body data-id="cpanel" class="is-preload landing">
    <div id="page-wrapper">
        <article id="main">
            <?php require $app->ruta->getView('RecuperarSession') ?>
            <?php require $app->ruta->getView('novedades/Main') ?>
        </article>
        <?php require $app->ruta->getFooter() ?>
    </div>
    <?= $app->menu->getMenu($app::NAME, $app->ruta->getRoot()) ?>
    <?php require $app->ruta->getScript() ?>
    <?php require $app->ruta->getScriptHelix() ?>
    <script src="/assets/js/ckeditor-full/ckeditor.js"></script>
    <script src="<?= $app->ruta->getController('novedades/main') ?>" type="module"></script>
</body>

</html>