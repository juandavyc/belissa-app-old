<?php session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/app/config.php';
$app = new MyCallCenterApp();
$app->menu->setModulo(
    array(
        'nombre' => 'Términos y condiciones',
        'icono' => 'icon solid fa-gavel',
    )
);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php require $app->ruta->getHead() ?>
</head>

<body data-id="terminos-y-condiciones" class="is-preload landing">
    <div id="page-wrapper">
        <article id="main">
            <header class="special container">
                <span class="<?= $app->menu->current['icon'] ?>"></span>
                <h2>
                    <?= $app->menu->current['name'] ?>
                </h2>
                <p>
                    CENTRO DE DIAGNÓSTICO AUTOMOTOR
                    <br>
                    <b>CDA AUTOMOTOS S.A.S</b>
                </p>
            </header>
            <nav class="breadcrumbs" id="main-breadcrumbs"></nav>
            <section class="wrapper style3 container max">
                <div class="col-12">
                    <h3>Contenido</h3>
                    <ul>
                        <li><a href="#terminos">TERMINOS Y CONDICIONES DEL SERVICIO</a></li>
                        <li><a href="#condiciones">CONDICIONES DE LA INSPECCIÓN</a></li>
                        <li><a href="#aviso">AVISO DE PRIVACIDAD</a></li>
                        <li><a href="#autorizacion">AUTORIZACIÓN TRATAMIENTO DE DATOS</a></li>
                    </ul>
                </div>
                <div class="col-12" id="terminos">
                    <h3 class="align-center">TERMINOS Y CONDICIONES DEL SERVICIO</h3>
                    <?php require $app->ruta->getView('legal/TerminosCondiciones') ?>
                </div>
                <div class="col-12" id="condiciones">
                    <h3 class="align-center">CONDICIONES DE LA INSPECCIÓN</h3>
                    <?php require $app->ruta->getView('legal/Condiciones') ?>
                </div>
                <div class="col-12" id="aviso">
                    <h3 class="align-center">AVISO DE PRIVACIDAD</h3>
                    <?php require $app->ruta->getView('legal/AvisoPrivacidad') ?>
                </div>
                <div class="col-12" id="autorizacion">
                    <h3 class="align-center">AUTORIZACIÓN TRATAMIENTO DE DATOS</h3>
                    <?php require $app->ruta->getView('legal/Autorizacion') ?>
                </div>
            </section>
        </article>
        <?php require $app->ruta->getFooter() ?>
    </div>
    <?php require $app->ruta->getMenuPublic() ?>
    <?php require $app->ruta->getScript() ?>
</body>

</html>