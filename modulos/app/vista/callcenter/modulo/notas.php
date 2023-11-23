<form id="form_notas_actualizar">
    <div class="row gtr-25 gtr-uniform">
        <div class="col-12 align-right">
            <button class="primary small icon solid fa-rotate btn-editar-actualizar" id="btn-notas-vehiculo-recargar">
                Recargar </button>
        </div>
        <div class="col-4 col-12-small">
            <fieldset class="historial-fieldset">
                <legend>
                    <i class="far fa-folder-open"></i> Vehículo
                </legend>
                <div class="historial-container-notas-sms" id="tabs-notas-historial-vehiculo">
                </div>
            </fieldset>
        </div>
        <div class="col-4 col-12-small">
            <fieldset class="historial-fieldset">
                <legend>
                    <i class="far fa-folder-open"></i> Propietario
                </legend>
                <div class="historial-container-notas-sms" id="tabs-notas-historial-propietario">
                </div>
            </fieldset>
        </div>
        <div class="col-4 col-12-small">
            <fieldset class="historial-fieldset">
                <legend>
                    <i class="far fa-folder-open"></i> Conductor
                </legend>
                <div class="historial-container-notas-sms" id="tabs-notas-historial-conductor">

                </div>
            </fieldset>
        </div>
    </div>
</form>
<fieldset class="historial-fieldset">
    <legend><i class="fas fa-plus"></i> Agregar </legend>
    <form id="form_nota_historial">
        <div class="row gtr-25 gtr-uniform">
            <div class="col-3 col-12-small">
                <label class="label-important label-datos"> Guardar en </label>
            </div>
            <div class="col-9 col-12-small">
                <input type="radio" id="nota-para-vehiculo" name="guardar" value="vehiculo" checked="">
                <label for="nota-para-vehiculo"> Vehículo </label>
                <input type="radio" id="nota-para-propietario" name="guardar" value="propietario">
                <label for="nota-para-propietario"> Propietario </label>
                <input type="radio" id="nota-para-conductor" name="guardar" value="conductor">
                <label for="nota-para-conductor"> Conductor </label>
            </div>
            <div class="col-3 col-12-small">
                <label class="label-important label-datos"> Nota </label>
            </div>
            <div class="col-9 col-12-small">
                <textarea id="form_nota_editor" name="nota" class="container-ckeditor"></textarea>
            </div>
            <div class="col-12">
                <fieldset class="fieldset-save">
                    <legend> <i class="fas fa-pencil-alt"> </i> Términos y condiciones</legend>
                    <div class="row gtr-50 gtr-uniform">
                        <div class="col-12">
                            <input type="checkbox" id="nota-terminos-condiciones" name="acepto_terminos_condiciones">
                            <label for="nota-terminos-condiciones" style="text-transform:none;">YO
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
                            <button type="reset" id="form_datos_vehiculo_reset"
                                class="button primary small fit icon solid fa-undo" disabled>
                                Cancelar
                            </button>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </form>
</fieldset>