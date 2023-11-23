<form id="formulario-editar">
    <div class="row gtr-25 gtr-uniform">
        <div class="col-12 align-center">
            <?php $app->ruta->getComponent(
                'TituloModulo',
                array(
                    'icon' => 'fa-user-pen',
                    'title' => 'Editar Usuario'
                )
            ) ?>
        </div>
        <div class="col-12">
            <div class="container xsmall">
                <hr />
                <span class="image fit">
                    <img src="/images/sin_imagen.png" id="foto-usuario-editar-src">
                </span>
            </div>
        </div>
        <div class="col-12">
            <?php $app->ruta->getComponent(
                'FileChooserCameraControl',
                array(
                    'id' => 'foto-usuario-editar',
                    'name' => 'foto',
                    'title' => 'Foto del usuario',
                    'icon' => 'fa-user',
                    'value' => '/images/sin_imagen.png',
                    'folder' => 'usuario/foto'
                )
            ) ?>
        </div>
        <div class="col-12">
            <?php require $app->ruta->getView('usuario/__AgregarEditar') ?>
        </div>
        <div class="col-12" hidden>
            <?php $app->ruta->getComponent(
                'CanalDeMercadeo',
                array(
                    'id' => 'editar',
                    'value' => '0',
                    'content' => 'Es un canal de mercadeo'
                )
            ) ?>
        </div>

        <div class="col-12">
            <?php $app->ruta->getComponent(
                'AceptoTerminos',
                array(
                    'id' => 'form_1_acepto_responsabilidad',
                    'name' => 'acepto_responsabilidad',
                    'reset' => 'btn-editar-reset',
                    'disabled' => true
                )
            ) ?>
        </div>
    </div>
</form>