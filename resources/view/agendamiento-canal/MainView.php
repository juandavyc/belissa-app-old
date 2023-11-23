<?php $app->ruta->getComponent('HeaderContainer', $app->menu->current) ?>
<div id="tab-visor">
    <ul>
        <li><a href="#tabs-0" class="icon solid fa-magnifying-glass"> Buscador </a></li>
        <li><a href="#tabs-1" class="icon solid fa-calendar-day"> Agendar</a></li>
        <li><a href="#tabs-2" class="icon solid fa-palette"> Estados</a></li>
    </ul>
    <div id="tabs-0">
        <?php $app->ruta->getComponent(
            'VisorBuscador',
            array(
                'id' => 'form_0',
                'name' => $app->menu->current['name'],
                'essential' => $app->ruta->getView('agendamiento-canal/buscador/Basico'),
                'advanced' => $app->ruta->getView('agendamiento-canal/buscador/Avanzado'),
            )
        ) ?>
    </div>
    <div id="tabs-1">
        <?php require $app->ruta->getView('agendamiento-canal/Agendar') ?>
    </div>
    <div id="tabs-2">
        <?php require $app->ruta->getView('agendamiento-canal/Estado') ?>
    </div>
</div>
<?php require $app->ruta->getView('agendamiento-canal/Editar') ?>