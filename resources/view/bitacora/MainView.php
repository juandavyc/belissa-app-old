<?php $app->ruta->getComponent('HeaderContainer', $app->menu->current) ?>
<section class="wrapper style3 container max">
    <?php $app->ruta->getComponent(
        'VisorBuscador',
        array(
            'id' => 'form_0',
            'name' => $app->menu->current['name'],
            'essential' => $app->ruta->getView('bitacora/BuscadorBasico'),
            'advanced' => $app->ruta->getView('bitacora/BuscadorAvanzado'),
        )
    ) ?>
</section>