<form id="formulario-agregar">
    <div class="row gtr-25 gtr-uniform">
        <div class="col-12 align-center">
            <?php $app->ruta->getComponent(
                'TituloModulo',
                array(
                    'icon' => 'fa-address-card',
                    'title' => 'Agregar Rango'
                )
            ) ?>
        </div>
        <div class="col-12">
            <?php require $app->ruta->getView('rango/__AgregarEditar') ?>
        </div>
        <div class="col-12">
            <?php $app->ruta->getComponent('ModulosRango', 'agregar') ?>
        </div>
        <div class="col-12">
            <?php $app->ruta->getComponent('AceptoTerminos', array(
                'id' => 'form_1_acepto_responsabilidad',
                'name' => 'acepto_responsabilidad',
                'reset' => 'btn-agregar-reset',
                'disabled' => false
            )) ?>
        </div>
    </div>
</form>