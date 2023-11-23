<?php $app->ruta->getComponent('HeaderContainer', $app->menu->current) ?>
<div id="tab-visor">
    <ul>
        <li><a href="#tabs-0" class="icon solid fa-star"> Programa</a></li>
        <li><a href="#tabs-1" class="icon solid fa-phone"> Call Center Objetivos</a></li>
        <li><a href="#tabs-2" class="icon solid fa-code"> Call Center Mensajes</a></li>
    </ul>
    <div id="tabs-0">
    <?php require $app->ruta->getView('novedades/Principal') ?>
    </div>
    <div id="tabs-1">
    <?php require $app->ruta->getView('novedades/Servicio') ?>
    </div>
    <div id="tabs-2">
    <?php require $app->ruta->getView('novedades/Desarrollo') ?>
    </div>
</div>