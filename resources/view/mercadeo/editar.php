<div id="div_dialog_editar_canal" title="EDITAR CANAL DE MERCADEO">
    <form id="form_canal">
        <div class="row gtr-50 gtr-uniform">
            <div class="col-12 col-12-small align-center">
                <i class="fas fa-info-circle fa-3x"></i>
                <input type="hidden" name="form_id_canal" id="form_id_canal" value="" required />
            </div>
            <div class="col-12">
                <fieldset>
                    <legend><i class="fas fa-file-signature"></i> Informacion del canal de mercadeo</legend>
                    <div class="row gtr-50 gtr-uniform">

                        <div class="col-2 col-12-small">
                            <label class="label-important label-datos">NOMBRE</label>
                        </div>
                        <div class="col-10 col-12-small">
                            <input id="form_1_canal_nombre" class="text-uppercase" type="text" name="nombre_canal"
                                placeholder="NOMBRE CANAL" autocomplete="off" value="" maxlength="255" required="">
                        </div>
                        <div class="col-2 col-12-small">
                            <label class="label-important label-datos">TIPO CANAL</label>
                        </div>
                        <div class="col-10 col-12-small">
                            <div class="input-container">
                                <div>
                                    <input type="text" id="editar-tipo-canal-text" value="SIN_ASIGNAR"
                                        placeholder="Tipo de canal" />
                                    <input type="hidden" name="editar_tipo_canal" id="editar-tipo-canal-select"
                                        value="1" data-default="1" required="" />
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
        </form_1>
</div>