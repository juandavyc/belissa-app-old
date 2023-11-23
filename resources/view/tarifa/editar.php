<div id="div_dialog_editar_tarifa" title="EDITAR TARIFA">
    <form id="form_tarifa">
        <div class="row gtr-50 gtr-uniform">
            <div class="col-12 col-12-small align-center">
                <i class="fas fa-info-circle fa-3x"></i>
                <input type="hidden" name="form_id_tarifa" id="form_id_tarifa" value="" required />
            </div>
            <div class="col-12">
                <fieldset>
                    <legend><i class="fas fa-file-signature"></i> Informacion de la tarifa</legend>
                    <div class="row gtr-50 gtr-uniform">

                        <div class="col-2 col-12-small">
                            <label class="label-important label-datos">TIPO DE VEHICULO</label>
                        </div>
                        <div class="col-10 col-12-small">
                            <input id="form_1_tarifa_tipo_vehiculo" class="text-uppercase" type="text" name="tipo_vehiculo"
                                placeholder="TIPO VEHICULO" autocomplete="off" value="" maxlength="255" required="" readonly>
                        </div>
                        <div class="col-2 col-12-small">
                            <label class="label-important label-datos">MODELOS DESDE</label>
                        </div>
                        <div class="col-2 col-12-small">
                            <input id="form_1_tarifa_desde" class="text-uppercase" type="text" name="desde"
                                placeholder="DESDE" autocomplete="off" value="" maxlength="255" required="">
                        </div>
                        <div class="col-2 col-12-small">
                            <label class="label-important label-datos">HASTA MODELOS</label>
                        </div>
                        <div class="col-2 col-12-small">
                            <input id="form_1_tarifa_hasta" class="text-uppercase" type="text" name="hasta"
                                placeholder="HASTA" autocomplete="off" value="" maxlength="255" required="">
                        </div>
                        <div class="col-2 col-12-small">
                            <label class="label-important label-datos">PRECIO</label>
                        </div>
                        <div class="col-2 col-12-small">
                            <input class="number" id="form_1_tarifa_precio" class="text-uppercase" type="text" name="precio"
                                placeholder="PRECIO" autocomplete="off" value="" maxlength="255" required="">
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