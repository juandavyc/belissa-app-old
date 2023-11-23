<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/app/config.php';
$app = new MyCallCenterApp();
$app->verificar->isVigenteSession('HTML');
$app->verificar->isAutorizado('gestion', true);
$app->menu->setModulo($app->menu->getMenuArray()['gestion']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php require $app->ruta->getHead() ?>
    <style>
        .dashboard-servicio {
            padding: 0.45em 1em;
            border-radius: 4px;
            background: #f5f5f5;
            border: 1px solid #e3e3e3;
        }
        .dashboard-servicio .icon-status {
            line-height: 60px;
        }
        .privilegios-alt {
            background: #ecf1f7;
            border: 1px solid #d6dbdf;
        }
        .color-758 {
            color: #758799;
        }
    </style>
</head>

<body data-id="gestion" class="is-preload landing">
    <div id="page-wrapper">
        <article id="main">
            <?php require $app->ruta->getView('gestion/Main') ?>
        </article>
        <?php require $app->ruta->getFooter() ?>
    </div>
    <?= $app->menu->getMenu($app::NAME, $app->ruta->getRoot()) ?>
    <?php require $app->ruta->getScript() ?>
    <?php require $app->ruta->getScriptHelix() ?>
</body>

</html>