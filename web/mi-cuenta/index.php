<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/app/config.php';
$app = new MyCallCenterApp();
$app->verificar->isVigenteSession('HTML');
$app->verificar->isAutorizado('mi_cuenta', true);
$app->menu->setModulo($app->menu->getMenuArray()['mi_cuenta']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php require $app->ruta->getHead() ?>
</head>

<body data-id="mi_cuenta" class="is-preload landing">
    <div id="page-wrapper">
        <?php require $app->ruta->getComponent('camera') ?>
        <article id="main">
            <?php require $app->ruta->getView('mi-cuenta/Main') ?>
        </article>
        <?php require $app->ruta->getFooter() ?>
    </div>
    <?= $app->menu->getMenu($app::NAME, $app->ruta->getRoot()) ?>

    <?php require $app->ruta->getScript() ?>
    <?php require $app->ruta->getScriptHelix() ?>
    <?php require $app->ruta->getScriptCamera() ?>

    <script src="<?= $app->ruta->getController('mi-cuenta/main') ?>" type="module"></script>
    <script>
        function show_pass(_from, _check, _input) {
            if (_check == 1) {
                $('#' + _input).attr('type', 'text');
                $(_from).attr('data-check', '2');
            } else {
                $('#' + _input).attr('type', 'password');
                $(_from).attr('data-check', '1');
            }
        }
    </script>
</body>

</html>