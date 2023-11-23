<?php $app->ruta->getComponent('HeaderContainer', $app->menu->current) ?>
<section class="wrapper style4 container max">
    <?php require $app->ruta->getView('crear-cliente-vehiculo/Placa') ?>
    <?php  require $app->ruta->getView('crear-cliente-vehiculo/Ingreso') ?>
</section>