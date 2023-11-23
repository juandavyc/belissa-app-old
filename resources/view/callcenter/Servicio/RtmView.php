<div class="align-right">
    <button class="primary small icon solid fa-rotate btn-editar-actualizar" id="btn-rtm-historial-recargar">
        Recargar </button>
</div>
<fieldset class="historial-fieldset">
    <legend>
        <i class="far fa-folder-open"></i> Historial
    </legend>
    <div id="tabs-rtm-historial" class="historial-container">
    </div>
</fieldset>
<fieldset class="historial-fieldset">
    <legend><i class="fas fa-plus"></i> Agregar </legend>
    <form id="form_rtm_historial">
        <div class="row gtr-25 gtr-uniform">
            <div class="col-12 align-center">
                <p class="note-blue">Se le agregaran <b>365 Días</b> a la fecha de expedición para determinar la
                    fecha de
                    vencimiento </p>
            </div>
            <div class="col-3 col-12-small">
                <label class="label-important label-datos"> CDA </label>
            </div>
            <div class="col-9 col-12-small">
                <div class="input-container">
                    <i class="fas fa-briefcase icon-input"></i>
                    <div>
                        <input type="text" id="rtm-historial-cda-text" value="SIN_CDA" placeholder="Nombre del cda" />
                        <input type="hidden" name="entidad" id="rtm-historial-cda-select" value="1" data-default="1"
                            required="" />
                    </div>
                </div>
            </div>
            <div class="col-3 col-12-small">
                <label class="label-important label-datos"> Fecha Expedición </label>
            </div>
            <div class="col-4 col-12-small">
                <div class="input-container">
                    <i class="fas fa-calendar icon-input"></i>
                    <div>
                        <input type="text" name="fecha" id="rtm-historial-fecha" class="input_date_listener"
                            autocomplete="off" required="">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <fieldset class="fieldset-save">
                    <legend> <i class="fas fa-pencil-alt"> </i> Términos y condiciones</legend>
                    <div class="row gtr-50 gtr-uniform">
                        <div class="col-12">
                            <input type="checkbox" id="rtm-historial-acepto-terminos-condiciones"
                                name="acepto_terminos_condiciones" required="">
                            <label for="rtm-historial-acepto-terminos-condiciones" style="text-transform:none;">Yo
                                <b><?=htmlspecialchars($_SESSION["session_user"][3]);?></b>,
                                He leído y acepto los <a href="/modulos/legal/" target="_blank">términos y
                                    condiciones</a> de uso. </label>
                        </div>
                        <div class="col-6 col-12-mobilep">
                            <button type="submit" class="button primary small fit icon solid fa-save">
                                Guardar
                            </button>
                        </div>
                        <div class="col-6 col-12-mobilep">
                            <button type="reset" class="button primary small fit icon solid fa-undo"
                                id="form_rtm_historial_reset">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </form>
</fieldset>