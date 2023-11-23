<form id="formulario-agregar">
    <div class="row gtr-25 gtr-uniform">
        <div class="col-12 align-center">
            <?php $app->ruta->getComponent(
                'TituloModulo',
                array(
                    'icon' => 'fa-user-plus',
                    'title' => 'Agregar Usuario'
                )
            ) ?>
        </div>        
        <div class="col-12 align-center">
            <h3><b>La contraseña es el Documento</b></h3>
        </div>
        <div class="col-12">
            <div class="container xsmall">
                <hr />
                <span class="image fit">
                    <img src="/images/sin_imagen.png" id="foto-usuario-agregar-src">
                </span>
            </div>
        </div>
        <div class="col-12">
            <?php $app->ruta->getComponent(
                'FileChooserCameraControl',
                array(
                    'id' => 'foto-usuario-agregar',
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
        <div class="col-12 align-center">
            <?php $app->ruta->getComponent(
                'TituloModulo',
                array(
                    'icon' => 'fa-chart-simple',
                    'title' => 'Canal de mercadeo'
                )
            ) ?>
        </div>
        <div class="col-12">
            <?php $app->ruta->getComponent(
                'CanalDeMercadeo',
                array(
                    'id' => 'agregar',
                    'value' => '0',
                    'content' => 'Asignar como canal'
                )
            ) ?>
        </div>
        <div class="col-12">
            <?php $app->ruta->getComponent(
                'AceptoTerminos',
                array(
                    'id' => 'acepto_responsabilidad',
                    'name' => 'acepto_responsabilidad',
                    'reset' => 'btn-editar-reset',
                    'disabled' => true
                )
            ) ?>
        </div>
    </div>
</form>