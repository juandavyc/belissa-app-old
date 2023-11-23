<?php $app->ruta->getComponent('HeaderContainer', $app->menu->current) ?>
<div id="tab-visor">
    <ul>
        <li><a href="#tabs-0" class="icon solid fa-magnifying-glass"> Buscador </a></li>
        <li><a href="#tabs-1" class="icon solid fa-plus"> Agregar</a></li>
    </ul>
    <div id="tabs-0">
        <?php require $app->ruta->getView('usuario/Buscador') ?>
    </div>
    <div id="tabs-1">
        <?php require $app->ruta->getView('usuario/Agregar') ?>
    </div>
</div>

<div id="modal-editar-usuario" class="my-modal">
    <div class="my-modal-container">
        <div class="my-modal-content">
        <?php require $app->ruta->getView('usuario/Editar') ?>
        </div>
    </div>
</div>
<?php require $app->ruta->getView('usuario/Canal') ?>