<?php $app->ruta->getComponent('HeaderContainer', $app->menu->current) ?>
<section class="wrapper style4 container max">
    <?php require $app->ruta->getView('ingreso-completo/Placa') ?>
    <?php require $app->ruta->getView('ingreso-rapido/Ingreso') ?>
</section>