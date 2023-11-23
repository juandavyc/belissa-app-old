<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/app/config.php';
$app = new MyCallCenterApp();
$app->verificar->isVigenteSession('LOGIN');
$app->menu->setModulo(
    array(
        'nombre' => 'Iniciar sesión',
        'icono' => 'icon solid fa-sign-in-alt',
    )
);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php require $app->ruta->getHead() ?>
</head>

<body data-id="iniciar-session" class="is-preload landing">
    <div id="page-wrapper">
        <article id="main">
            <?php require $app->ruta->getView('IniciarSession') ?>
        </article>
        <?php require $app->ruta->getFooter() ?>
    </div>
    <?php require $app->ruta->getMenuPublic() ?>
    <?php require $app->ruta->getScript() ?>
    <script src="<?= $app->ruta->getController('iniciar-session/main') ?>" type="module"></script>
</body>

</html>