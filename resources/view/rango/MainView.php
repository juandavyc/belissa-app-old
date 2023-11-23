<?php $app->ruta->getComponent('HeaderContainer', $app->menu->current) ?>
<div id="tab-visor">
    <ul>
        <li><a href="#tabs-0" class="icon solid fa-magnifying-glass"> Buscador </a></li>
        <li><a href="#tabs-1" class="icon solid fa-plus"> Agregar</a></li>
    </ul>
    <div id="tabs-0">
        <?php $app->ruta->getComponent(
            'VisorBuscador',
            array(
                'id' => 'form_0',
                'name' => $app->menu->current['name'],
                'essential' => $app->ruta->getView('rango/BuscadorBasico'),
                'advanced' => $app->ruta->getView('rango/BuscadorAvanzado'),
            )
        ) ?>
        <?php require $app->ruta->getView('rango/Editar') ?>
    </div>
    <div id="tabs-1">
        <?php require $app->ruta->getView('rango/Agregar') ?>
    </div>
</div>