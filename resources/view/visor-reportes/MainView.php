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
<div id="tab-visor">
    <ul>
        <li><a href="#tabs-0" class="icon solid fa-magnifying-glass"> Visor Reportes (General) </a></li>
        <li><a href="#tabs-1" class="icon solid fa-magnifying-glass"> Visor Reportes (Privado) </a></li>
    </ul>
    <div id="tabs-0">
        <?php require $app->ruta->getView('visor-reportes/Publico') ?>
    </div>
    <div id="tabs-1">
        <?php require $app->ruta->getView('visor-reportes/Privado') ?>
    </div>
</div>