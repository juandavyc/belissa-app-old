<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/app/config.php';
$app = new MyCallCenterApp();
$app->menu->setModulo(
    array(
        'nombre' => 'PQRS',
        'icono' => 'icon solid fa-address-book',
    )
);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php require $app->ruta->getHead() ?>
    <style>
        .contacto {
            background: #e0f4fd;
            padding: 1em 2em;
            border-radius: 1em;
        }

        .contacto>li {
            padding-top: 1em;

        }
    </style>
</head>

<body data-id="pqrs" class="is-preload landing">
    <div id="page-wrapper">
        <article id="main">
            <header class="special container">
                <span class="<?= $app->menu->current['icon'] ?>"></span>
                <h2>
                    <?= $app->menu->current['name'] ?>
                </h2>
                <p>
                    (Peticiones, Quejas, Reclamos y sugerencias)
                    <br>
                    <b>CDA AUTOMOTOS S.A.S</b>
                </p>
            </header>
            <nav class="breadcrumbs" id="main-breadcrumbs"></nav>
            <?php require $app->ruta->getView('pqrs/Main') ?>
        </article>
        <?php require $app->ruta->getFooter() ?>
    </div>
    <?php require $app->ruta->getMenuPublic() ?>
    <?php require $app->ruta->getScript() ?>
    <script src="/assets/js/helix/datepicker.js"></script>
    <script src="controller/main.js" type="module"></script>

</body>

</html>