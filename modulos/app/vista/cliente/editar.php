<div id="div_dialog_editar_cliente" title="EDITAR CLIENTE">
    <form id="form_cliente">
        <div class="row gtr-50 gtr-uniform">
            <div class="col-12 col-12-small align-center">
                <i class="fas fa-info-circle fa-3x"></i>
                <input type="hidden" name="form_id_cliente" id="form_id_cliente" value="" required />
            </div>
            <div class="col-12">
                <fieldset>
                    <legend><i class="fas fa-file-signature"></i> Informacion del vehiculo</legend>
                    <div class="row gtr-50 gtr-uniform">

                        <div class="col-2 col-12-small">
                            <label class="label-important label-datos">NOMBRE</label>
                        </div>
                        <div class="col-4 col-12-small">
                            <div class="input-container">
                                <i class="fas fa-signature icon-input"></i>
                                <div>
                                    <input id="form_1_nombre" class="text-uppercase" type="text" name="nombre"
                                        placeholder="NOMBRE" autocomplete="off" value="" maxlength="255" required="">
                                </div>
                            </div>
                        </div>

                        <div class="col-2 col-12-small">
                            <label class="label-important label-datos">APELLIDO</label>
                        </div>
                        <div class="col-4 col-12-small">
                            <div class="input-container">
                                <i class="fas fa-signature icon-input"></i>
                                <div>
                                    <input id="form_1_apellido" class="text-uppercase" type="text" name="apellido"
                                        placeholder="APELLIDO" autocomplete="off" value="" maxlength="255" required="">
                                </div>
                            </div>
                        </div>

                        <div class="col-2 col-12-small">
                            <label class="label-important label-datos">DOCUMENTO</label>
                        </div>
                        <div class="col-4 col-12-small">
                            <div class="input-container">
                                <i class="fas fa-id-card icon-input"></i>
                                <div>
                                    <input id="form_1_documento" class="text-uppercase" type="number" name="documento"
                                        placeholder="DOCUMENTO" autocomplete="off" value="" maxlength="255" required="">
                                </div>
                            </div>
                        </div>

                        <div class="col-2 col-12-small">
                            <label class="label-important label-datos">TIPO</label>
                        </div>
                        <div class="col-4 col-12-small">
                            <div class="input-container">
                                <i class="fas fa-arrows-alt-v icon-input"></i>
                                <select id="form_1_tipo_documento" name="tipo_documento">
                                    <option value="1">CEDULA</option>
                                    <option value="2">NIT</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-2 col-12-small">
                            <label class="label-important label-datos">TELEFONO 1</label>
                        </div>
                        <div class="col-4 col-12-small">
                            <div class="input-container">
                                <i class="fas fa-phone-volume icon-input"></i>
                                <div>
                                    <input id="form_1_telefono_1" class="text-uppercase" type="number" name="telefono_1"
                                        placeholder="TELEFONO 1" autocomplete="off" value="" maxlength="255"
                                        required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-2 col-12-small">
                            <label class="label-important label-datos">TELEFONO 2</label>
                        </div>
                        <div class="col-4 col-12-small">
                            <div class="input-container">
                                <i class="fas fa-phone-volume icon-input"></i>
                                <div>
                                    <input id="form_1_telefono_2" class="text-uppercase" type="number" name="telefono_2"
                                        placeholder="TELEFONO 2" autocomplete="off" value="" maxlength="255"
                                        required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-2 col-12-small">
                            <label class="label-important label-datos">TELEFONO 3</label>
                        </div>
                        <div class="col-4 col-12-small">
                            <div class="input-container">
                                <i class="fas fa-phone-volume icon-input"></i>
                                <div>
                                    <input id="form_1_telefono_3" class="text-uppercase" type="number" name="telefono_3"
                                        placeholder="TELEFONO 3" autocomplete="off" value="" maxlength="255"
                                        required="">
                                </div>
                            </div>
                        </div>

                        <div class="col-2 col-12-small">
                            <label class="label-important label-datos">CORREO</label>
                        </div>
                        <div class="col-4 col-12-small">
                            <div class="input-container">
                                <i class="fab fa-at icon-input"></i>
                                <div>
                                    <input id="form_1_correo" class="text-uppercase" type="email" name="correo"
                                        placeholder="CORREO" autocomplete="off" value="" maxlength="255" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-2 col-12-small">
                            <label class="label-important label-datos">DIRECCION</label>
                        </div>
                        <div class="col-10 col-12-small">
                            <div class="input-container">
                                <i class="fas fa-map-marked-alt icon-input"></i>
                                <div>
                                    <input id="form_1_direccion" class="text-uppercase" type="text" name="direccion"
                                        placeholder="DIRECCION" autocomplete="off" value="" maxlength="255" required="">
                                </div>
                            </div>
                        </div>


                    </div>
                </fieldset>
            </div>

            <div class="col-12">
                <fieldset class="fieldset-save">
                    <legend> <i class="fas fa-pencil-alt"> </i> Términos y condiciones</legend>
                    <div class="row gtr-50 gtr-uniform_1">
                        <div class="col-12">
                            <input type="checkbox" id="form_1_tab_1_acepto_responsabilidad"
                                name="acepto_responsabilidad" required="">
                            <label for="form_1_tab_1_acepto_responsabilidad" style="text-transform:none;">YO
                                <b><?=htmlspecialchars($_SESSION["session_user"][3]);?></b>, He leído y acepto los <a
                                    href="/modulos/legal/" target="_blank">términos y condiciones</a> de uso. </label>
                        </div>
                        <div class="col-6 col-12-mobilep">
                            <button type="submit" class="button primary small fit icon solid fa-save">
                                Guardar
                            </button>
                        </div>
                        <div class="col-6 col-12-mobilep">
                            <button type="reset" class="button primary small fit icon solid fa-undo">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </fieldset>
            </div>

        </div>
        </form_1>
</div>