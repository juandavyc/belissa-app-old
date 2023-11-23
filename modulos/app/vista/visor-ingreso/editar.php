<div id="dialog-certificar" title="CERTIFICAR VEHICULO">
    <form id="form_certificar_vehiculo">
        <div class="row gtr-50 gtr-uniform">

            <div class="col-12 align-center">

                <br>
                <div class="vh-placa" id="editar-placa_vehiculo-html">XXX111</div>
                <input type="hidden" name="id_certificar" id="editar-id_certificar" value="" required />
            </div>
            <div class="col-12">
                <fieldset>
                    <legend><i class="fas fa-file-signature"></i> Informacion del vehiculo a certificar</legend>
                    <div class="row gtr-50 gtr-uniform">
                        <div class="col-8 col-12-small">
                            <label class="label-datos label-important"> Fecha de expedicion del certificado (RTM)</label>
                        </div>
                        <div class="col-4 input-container">
                            <i class="fas fa-calendar icon-input"></i>
                            <div>
                                <input type="text" name="fecha_certificado" id="form_fecha_certificado" class="input_date_listener" autocomplete="off" required="">
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
                            <input type="checkbox" id="form_1_tab_1_acepto_responsabilidad" name="acepto_responsabilidad" required="">
                            <label for="form_1_tab_1_acepto_responsabilidad" style="text-transform:none;">YO
                                <b><?= htmlspecialchars($_SESSION["session_user"][3]); ?></b>, He leído y acepto los <a href="/modulos/legal/" target="_blank">términos y condiciones</a> de uso. </label>
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