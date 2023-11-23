<div id="dialog-editar" class="my-modal">
    <div class="my-modal-container">
        <div class="my-modal-content"> <!-- formulario-editar-class -->
            <form id="formulario-editar">
                <div class="row gtr-25 gtr-uniform">
                    <div class="col-12">
                        <?php require $app->ruta->getView('rango/__AgregarEditar') ?>
                    </div>
                    <div class="col-12">
                        <?php $app->ruta->getComponent('ModulosRango', 'editar') ?>
                    </div>
                </div>
                <div class="col-12">
                    <?php $app->ruta->getComponent(
                        'AceptoTerminos',
                        array(
                            'id' => 'editar-acepto_responsabilidad',
                            'name' => 'acepto_responsabilidad',
                            'reset' => 'btn-editar-reset',
                            'disabled' => true
                        )
                    ) ?>
                </div>
            </form>
        </div>
    </div>
</div>