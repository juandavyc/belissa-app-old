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
        <li><a href="#tabs-1" class="icon solid fa-magnifying-glass"> Informacion</a></li>
        <li><a href="#tabs-2" class="icon solid fa-plus"> Cambiar Contraseña</a></li>
    </ul>
    <div id="tabs-1">
        <?php require $app->ruta->getView('mi-cuenta/Informacion') ?>
    </div>
    <div id="tabs-2">
        <?php require $app->ruta->getView('mi-cuenta/Contrasenia') ?>
    </div>
</div>