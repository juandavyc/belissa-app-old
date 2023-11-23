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
<section class="wrapper style3 container max">
    <div class="row gtr-50 gtr-uniform">
        <div class="col-4 col-12-small">
            <div>
                <h3><i class="fa-solid fa-location-dot"></i> Mapa del sitio</h3>
                <hr>
            </div>
            <?php $app->ruta->getComponent('MapaSitio', $app->menu->getMenuArray()) ?>
        </div>
        <div class="col-8 col-12-small">
            <?php require $app->ruta->getView('documentacion/Condiciones') ?>
        </div>
        <div class="col-12">
            <?php require $app->ruta->getView('documentacion/Video') ?>
        </div>
    </div>
</section>