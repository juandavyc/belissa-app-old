<header class="special container">
    <span class="<?= $app->menu->current['icon'] ?>"></span>
    <h2>
        <?= $app->menu->current['name'] ?>
    </h2>
    <p>
        <?= htmlspecialchars($_SESSION['session_user'][3]); ?>
    </p>
</header>
<nav class="breadcrumbs" id="breadcrumbs_global"></nav>
<section class="wrapper style4 container max">
    <?php require $app->ruta->getView('ingreso-completo/Placa') ?>
    <?php require $app->ruta->getView('ingreso-completo/Ingreso') ?>
</section>