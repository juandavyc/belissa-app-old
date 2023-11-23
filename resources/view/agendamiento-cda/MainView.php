<?php $app->ruta->getComponent('HeaderContainer', $app->menu->current) ?>
<div id="tab-visor">
    <ul>
        <li><a href="#tabs-0" class="icon solid fa-magnifying-glass"> Buscador </a></li>
        <li><a href="#tabs-1" class="icon solid fa-calendar-day"> Agendar</a></li>
        <li><a href="#tabs-2" class="icon solid fa-star"> Cupo</a></li>
        <li><a href="#tabs-3" class="icon solid fa-palette"> Estados</a></li>
    </ul>
    <div id="tabs-0">
    <?php $app->ruta->getComponent(
            'VisorBuscador',
            array(
                'id' => 'form_0',
                'name' => $app->menu->current['name'],
                'essential' => $app->ruta->getView('agendamiento-cda/buscador/Basico'),
                'advanced' => $app->ruta->getView('agendamiento-cda/buscador/Avanzado'),
            )
        ) ?>
    </div>
    <div id="tabs-1">
        <?php require $app->ruta->getView('agendamiento-cda/Agendar') ?>
    </div>
    <div id="tabs-2">
        <?php require $app->ruta->getView('agendamiento-cda/Cupo') ?>
    </div>
    <div id="tabs-3">
        <?php require $app->ruta->getView('agendamiento-canal/Estado') ?>
    </div>
</div>
<?php require $app->ruta->getView('agendamiento-cda/Editar') ?>