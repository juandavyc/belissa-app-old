<div id="editar-placa-ingreso-modal" class="my-modal">
    <div class="my-modal-container">
        <div class="my-modal-content">
            <form id="form_editar_placa">
                <div class="row gtr-25 gtr-uniform">
                    <div class="col-12 align-center">
                        <div style="color: #fff; background: #f00;">
                            <h2>IMPORTANTE</h2>
                            <p>Solo se puede editar <b>UNA SOLA VEZ</b> la placa por ingreso</p>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="hidden" name="id_ingreso" id="editar-id-ingreso" value="" autocomplete="off" required>
                        <input type="hidden" name="id_vehiculo" id="editar-id-vehiculo" value="" autocomplete="off" required>
                    </div>
                    <div class="col-12">
                        <label class="label-important" for="placa-original"> Placa Original</label>
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <input type="text" placeholder="Placa Original" id="placa-original" name="placa_original" value="" readonly required autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="label-important" for="placa-nueva"> Placa Nueva</label>
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <input type="text" placeholder="Placa Nueva" id="placa-nueva" name="placa_nueva" value="" required autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="label-important" for="razon_editar_placa"> Razon editar</label>
                        <textarea name="razon" id="razon_editar_placa" placeholder="Razon" rows="3" required></textarea>
                    </div>
                    <div class="col-12">
                        <?php $app->ruta->getComponent(
                            'AceptoTerminos',
                            array(
                                'id' => 'form_editar_placa_acepto',
                                'name' => 'acepto_responsabilidad',
                                'reset' => 'btn-editar-placa',
                                'disabled' => true
                            )
                        ) ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>