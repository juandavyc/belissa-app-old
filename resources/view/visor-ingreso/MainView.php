<?php $app->ruta->getComponent('HeaderContainer', $app->menu->current) ?>
<section class="wrapper style3 container max">
    <?php $app->ruta->getComponent(
            'VisorBuscador',
            array(
                'id' => 'form_0',
                'name' => $app->menu->current['name'],
                'essential' => $app->ruta->getView('visor-ingreso/BuscadorBasico'),
                'advanced' => $app->ruta->getView('visor-ingreso/BuscadorAvanzado'),
            )
        ) ?>
    <?php require $app->ruta->getView('visor-ingreso/Editar') ?>
    <?php require $app->ruta->getView('visor-ingreso/Certificar') ?>
    <?php require $app->ruta->getView('visor-ingreso/Informacion') ?>
    <?php require $app->ruta->getView('visor-ingreso/VideoRechazo') ?>
</section>