<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/app/config.php';
$app = new MyCallCenterApp();
$app->verificar->isVigenteSession('HTML');
$app->verificar->isAutorizado('inspector-evidencia', true);
$app->menu->setModulo($app->menu->getMenuArray()['inspector-evidencia']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php require $app->ruta->getHead() ?>
    <style>
        video {
            width: 100%;
            height: auto;
            max-width: 600px;
            max-height: 300px;
            border: 5px solid #7E8A99;
            border-radius: 9px;
            background: #1e2c38;
        }
        #container-resultado {
            border: 1px dashed #cbd2d9;
            background: #fafcff;
            border-radius: 10px;
            max-height: 300px;
            overflow: auto;
        }
        #container-resultado li {
            font-weight: bold;
            padding: .4em;
            list-style-type: none;
        }
        #container-resultado li ul li {
            font-weight: normal;
            padding-left: 1em !important;
            cursor: pointer;
            color: #169fcc;
            background: #DEE8F2;
            margin-top: 1px;
            border-radius: 20px;
            text-align: center;
        }
        #container-resultado ol {
            padding-left: 1em !important;
        }
    </style>
</head>

<body data-id="inspector-evidencia" class="is-preload landing">
    <div id="page-wrapper">
        <article id="main">
            <?php require $app->ruta->getView('RecuperarSession') ?>
            <?php require $app->ruta->getView('inspector-evidencia/Main') ?>
        </article>
        <?php require $app->ruta->getFooter() ?>
    </div>
    <?= $app->menu->getMenu($app::NAME, $app->ruta->getRoot()) ?>
    <?php require $app->ruta->getScript() ?>
    <?php require $app->ruta->getScriptHelix() ?>
    <script src="/assets/js/recordrtc.js"></script>
    <script src="<?= $app->ruta->getController('inspector-evidencia/main') ?>" type="module"></script>
    <script></script>
</body>

</html>