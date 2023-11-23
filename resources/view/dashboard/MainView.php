<?php $app->ruta->getComponent('HeaderContainer', $app->menu->current) ?>
<section class="wrapper style3 container max">
    <div class="row gtr-50 gtr-uniform">
        <div class="col-6 col-12-small">
            <?php require $app->ruta->getView('dashboard/Perfil') ?>
        </div>
        <div class="col-6 col-12-small">
            <?php require $app->ruta->getView('dashboard/Servicio') ?>
        </div>
    </div>
    <?php require $app->ruta->getView('dashboard/Administrador') ?>
    <?php require $app->ruta->getView('dashboard/General') ?>
</section>