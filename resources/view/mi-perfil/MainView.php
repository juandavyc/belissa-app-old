<?php $app->ruta->getComponent('HeaderContainer', $app->menu->current) ?>

<section class="wrapper style3 container max">
    <div class="row gtr-25 gtr-uniform">
        <div class="col-6 col-12-small">
            <h2>Editar mi Perfil</h2>
            <hr>
            <ol style="margin-left:3em;">
                <li>
                    <a href="#informacion">Mi Información</a>
                </li>
                <li>
                    <a href="#contrasenia">Mi contraseña</a>
                </li>
            </ol>
        </div>
        <div class="col-12 align-center">
            <hr>
            <?php $app->ruta->getComponent(
                'TituloModulo',
                array(
                    'icon' => 'fa-user-cog',
                    'title' => '<b>Mi </b>Información '
                )
            ) ?>
        </div>
        <div class="col-12" id="informacion">
            <?php require $app->ruta->getView('mi-perfil/Informacion') ?>
        </div>
        <div class="col-12 align-center">
            <br><br>
            <hr>
            <?php $app->ruta->getComponent(
                'TituloModulo',
                array(
                    'icon' => 'fa-user-cog',
                    'title' => '<b>Mi</b> Contraseña'
                )
            ) ?>
        </div>
        <div class="col-12" id="contrasenia">
            <?php require $app->ruta->getView('mi-perfil/Contrasenia') ?>
        </div>
    </div>
</section>