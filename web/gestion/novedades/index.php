<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/app/config.php';
$app = new MyCallCenterApp();
$app->verificar->isVigenteSession('HTML');
$app->verificar->isAutorizado('gestion', true);
$app->menu->setModulo($app->menu->getMenuArray()['gestion']['sub-menu'][0]);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php require $app->ruta->getHead() ?>
    <style>
        #form_1_tipo_conexion_seleccionada,
        #editar-tipo_conexion_html {
            background: #dceefd;
            padding: 0.5em;
            border-radius: 4px;
            text-align: center;
        }
    </style>
</head>

<body data-id="gestion" class="is-preload landing">
    <div id="page-wrapper">
        <article id="main">
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