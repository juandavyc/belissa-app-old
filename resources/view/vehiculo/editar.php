<div id="div_dialog_editar_vehiculo" title="EDITAR VEHICULO">
    <form id="form_editar_vehiculo">
        <div class="row gtr-50 gtr-uniform">
            <div class="col-12 col-12-small align-center">
                <i class="fas fa-info-circle fa-3x"></i>
                <input type="hidden" name="form_id_vehiculo" id="form_id_vehiculo" value="" required />
            </div>
            <div class="col-12">
                <fieldset>
                    <legend><i class="fas fa-file-signature"></i> Informacion del vehiculo</legend>
                    <div class="row gtr-50 gtr-uniform">

                        <div class="col-2 col-12-small">
                            <label class="label-important label-datos">PLACA</label>
                        </div>
                        <div class="col-4 col-12-small">
                            <div class="input-container">
                                <i class="fab fa-cc-jcb icon-input"></i>
                                <div>
                                    <input id="form_1_placa" class="text-uppercase" type="text" name="placa"
                                        placeholder="PLACA" autocomplete="off" value="" maxlength="255" required="">
                                </div>
                            </div>
                        </div>

                        <div class="col-2 col-12-small">
                            <label class="label-important label-datos">TIPO VEHICULO</label>
                        </div>
                        <div class="col-4 col-12-small">
                            <div class="input-container">
                                <i class="fas fa-car-side icon-input"></i>
                                <select id="form_1_tipo_vehiculo" name="tipo_vehiculo">
                                    <option value="1" selected>SIN_TIPO</option>
                                    <option value="2">LIVIANO</option>
                                    <option value="3">4X4</option>
                                    <option value="4">PESADO</option>
                                    <option value="5">MOTO</option>
                                    <option value="6">REMOLQUE</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-2 col-12-small">
                            <label class="label-important label-datos">SERVICIO</label>
                        </div>
                        <div class="col-4 col-12-small">
                            <div class="input-container">
                                <i class="fas fa-taxi icon-input"></i>
                                <select id="form_1_servicio" name="servicio_vehiculo">
                                    <option value="1" selected>SIN_SERVICIO</option>
                                    <option value="2">PUBLICO</option>
                                    <option value="3">PARTICULAR</option>
                                    <option value="4">DIPLOMATICO</option>
                                    <option value="5">ENSEÑANZA</option>
                                    <option value="6">OFICIAL</option>
                                    <option value="7">ESPECIAL</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-2 col-12-small">
                            <label class="label-important label-datos">MODELO</label>
                        </div>
                        <div class="col-4 col-12-small">
                            <div class="input-container">
                                <i class="fas fa-sort-numeric-down-alt icon-input"></i>
                                <input id="form_1_modelo" class="text-uppercase" type="number" name="modelo"
                                    placeholder="MODELO" autocomplete="off" value="" maxlength="255" required="">
                            </div>
                        </div>

                        <div class="col-2 col-12-small">
                            <label class="label-important label-datos">ENSEÑANZA</label>
                        </div>
                        <div class="col-4 col-12-small">
                            <div class="input-container">
                                <i class="fas fa-traffic-light icon-input"></i>
                                <select id="form_1_ensenanza" name="ensenanza_vehiculo">
                                    <option value="1">SI</option>
                                    <option value="2" selected>NO</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-2 col-12-small">
                            <label class="label-important label-datos">MARCA</label>
                        </div>
                        <div class="col-4 col-12-small">
                            <div class="input-container">
                                <i class="fas fa-arrows-alt-v icon-input"></i>
                                <div>
                                    <input type="text" id="form-1-editar-marca-input" value="SIN_MARCA"
                                        placeholder="MARCA" />
                                    <input type="hidden" name="editar_marca" id="form-1-editar-marca-select" value="1"
                                        data-default="1" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-2 col-12-small">
                            <label class="label-important label-datos">LINEA</label>
                        </div>
                        <div class="col-4 col-12-small">
                            <div class="input-container">
                                <i class="fas fa-arrows-alt-v icon-input"></i>
                                <div>
                                    <input type="text" id="form-1-editar-linea-input" value="SIN_LINEA"
                                        placeholder="LINEA" />
                                    <input type="hidden" name="editar_linea" id="form-1-editar-linea-select" value="1"
                                        data-default="1" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-2 col-12-small">
                            <label class="label-important label-datos">COLOR</label>
                        </div>
                        <div class="col-4 col-12-small">
                            <div class="input-container">
                                <i class="fas fa-paint-brush icon-input"></i>
                                <div>
                                    <input type="text" id="form-1-editar-color-input" value="SIN_COLOR"
                                        placeholder="COLOR" />
                                    <input type="hidden" name="editar_color" id="form-1-editar-color-select" value="1"
                                        data-default="1" required="" />
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
                            <button type="reset" id="form_editar_vehiculo_reset"
                                class="button primary small fit icon solid fa-undo">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </fieldset>
            </div>

        </div>
        </form_1>
</div>