<fieldset class="historial-fieldset">
    <legend><i class="fas fa-plus"></i> SMS Personalizado </legend>
    <form id="form_sms_personalizado">
        <div class="row gtr-25 gtr-uniform">
            <div class="col-3 col-12-small">
                <label class="label-important label-datos"> Numero </label>
            </div>
            <div class="col-9 col-12-small" id="container-numero-clientes">
            </div>
            <!-- <div class="col-3 col-12-small">
                <label class="label-important label-datos"> Titulo </label>
            </div> -->
            <!-- <div class="col-9 col-12-small">
                <input type="radio" id="titulo-sms-soat-personalizado" name="titulo-sms-personalizado" value="soat" checked="">
                <label for="titulo-sms-soat-personalizado"> Soat </label>
                <input type="radio" id="titulo-sms-rtm-personalizado" name="titulo-sms-personalizado" value="propietario">
                <label for="titulo-sms-rtm-personalizado"> Rtm </label>
                <input type="radio" id="titulo-sms-prueba-personalizado" name="titulo-sms-personalizado" value="conductor">
                <label for="titulo-sms-prueba-personalizado"> Prueba </label>
            </div> -->
            <div class="col-3 col-12-small">
                <label class="label-important label-datos"> Mensaje </label>
            </div>
            <div class="col-9 col-12-small">
                <textarea id="sms-personalizado" name="mensaje" class="container-ckeditor" maxlength="160"></textarea>
            </div>
            <div class="col-12">
                <fieldset class="fieldset-save">
                    <legend> <i class="fas fa-pencil-alt"> </i> Términos y condiciones</legend>
                    <div class="row gtr-50 gtr-uniform">
                        <div class="col-12">
                            <input type="checkbox" id="sms-terminos-condiciones" name="acepto_terminos_condiciones">
                            <label for="sms-terminos-condiciones" style="text-transform:none;">YO
                                <b><?= htmlspecialchars($_SESSION["session_user"][3]); ?></b>,
                                He leído y acepto los <a href="/modulos/legal/" target="_blank">términos y
                                    condiciones</a> de uso. </label>
                        </div>
                        <div class="col-6 col-12-mobilep">
                            <button type="submit" class="button primary small fit icon solid fa-save">
                                Guardar
                            </button>
                        </div>
                        <div class="col-6 col-12-mobilep">
                            <button type="reset" id="form_datos_vehiculo_reset" class="button primary small fit icon solid fa-undo">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </form>
</fieldset>