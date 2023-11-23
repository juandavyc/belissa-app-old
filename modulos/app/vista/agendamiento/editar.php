<div id="dialog-editar-agendamiento" title="EDITAR AGENDAMIENTO">
    <form id="form_editar_agendamiento">
        <div class="row gtr-50 gtr-uniform">
            <div class="col-12 align-center">
                <br>
                <div class="vh-placa" id="editar-placa_vehiculo-html">XXX111</div>
                <input type="hidden" name="id_agendamiento" id="editar-id_agendamiento" value="" required />
            </div>
            <div class="col-12">
                <fieldset>
                    <legend><i class="fas fa-file-signature"></i> Informacion del agendamiento</legend>
                    <div class="row gtr-50 gtr-uniform">
                        <div class="col-2 col-12-small">
                            <label class="label-datos label-important"> Fecha</label>
                        </div>
                        <div class="col-4 col-12-small">
                            <div class="input-container">
                                <i class="fas fa-calendar icon-input"></i>
                                <div>
                                    <input id="editar-fecha" type="text" name="fecha"  autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-2 col-12-small">
                            <label class="label-datos label-important"> Horario</label>
                        </div>
                        <div class="col-4 col-12-small">
                            <div class="input-container">
                                <i class="fas fa-align-left icon-input"></i>
                                <div>
                                    <select id="editar-horario" name="horario">
                                        <option value="default" selected>Seleccione el horario</option>
                                        <option value="1">En la Mañana</option>
                                        <option value="2">En la Tarde</option>
                                        <option value="3">En la Noche</option>
                                    </select>
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
                            <button type="reset" class="button primary small fit icon solid fa-undo" disabled>
                                Cancelar
                            </button>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </form>
</div>