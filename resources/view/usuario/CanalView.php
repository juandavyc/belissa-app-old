<div id="dialog-asginar-canal" class="my-modal">
    <div class="my-modal-container">
        <div class="my-modal-content">
            <form id="formulario-canal">
                <div class="row gtr-50 gtr-uniform">
                    <div class="col-12 col-12-small align-center" hidden>
                        <input type="text" name="id" id="id" value="" required />
                    </div>
                    <div class="col-12 col-12-small">
                        <aside class="note-wrap note-yellow align-center">
                            Este usuario se asignara como <b>un canal de mercadeo</b> <br>
                            por favor seleccione un tipo de canal al cual va a pertenecer <br>
                        </aside>
                    </div>
                    <div class="col-12">
                        <fieldset>
                            <legend>
                                <i class="fas fa-file-signature"></i> Datos canal de mercadeo
                            </legend>
                            <div class="row gtr-25 gtr-uniform">
                                <div class="col-2 col-12-small">
                                    <label class="label-important label-datos">NOMBRE</label>
                                </div>
                                <div class="col-4 col-12-small">
                                    <div class="input-container">
                                        <i class="fas fa-signature icon-input"></i>
                                        <div>
                                            <input id="nombre" type="text" name="nombre" placeholder="NOMBRE DEL CANAL" autocomplete="off" value="" maxlength="255" required="" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 col-12-small">
                                    <label class="label-important label-datos">TIPO CANAL</label>
                                </div>
                                <div class="col-4 col-12-small">
                                    <div class="input-container">
                                        <i class="fas fa-sort-numeric-down icon-input"></i>
                                        <div>
                                            <select id="tipo-canal" name="tipo" required="">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="col-12">
                    <?php $app->ruta->getComponent(
                        'AceptoTerminos',
                        array(
                            'id' => 'canal_acepto_responsabilidad',
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