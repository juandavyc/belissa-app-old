<form id="form_callcenter_editar">
    <div class="row gtr-25 gtr-uniform">
        <div class="col-12 align-center">
            <i class="fa-solid fa-phone fa-3x"></i>
        </div>
        <div class="col-12">
            <h3><b>Importante leer</b></h3>
            <p>
                Acá puede <b>enviar notificaciones</b> al equipo de callcenter, tareas o observaciones, las van a ver al
                iniciar el módulo de callcenter.
            </p>
            <ul>
                <li>Verifique la ortografía.</li>
                <li>Esta información aparece en la <a href="/modulos/callcenter/">página principal</a>.</li>
                <li>No se guardan copias de respaldo de este módulo.</li>
            </ul>
        </div>
        <div class="col-12">
            <b> SERVICIO</b>
            <input type="hidden" value="2" id="form_servicio_id" name="id" autocomplete="off" readonly>
            <textarea id="form_servicio_editor" name="editor" class="container-ckeditor"></textarea>
            <hr>
        </div>
        <div class="col-12 align-center">
            <h3>Antes de guardar, previsualiza el contenido <b>¡Es gratis!</b></h3>
            <button class="primary small icon solid fa-eye" id="form_servicio_previsualizar">
                Previsualización</button>
        </div>
        <div class="col-12">
            <fieldset class="fieldset-save">
                <legend> <i class="fas fa-pencil-alt"> </i> Términos y condiciones</legend>
                <div class="row gtr-50 gtr-uniform">
                    <div class="col-12">
                        <input type="checkbox" id="form_1_acepto_responsabilidad" name="acepto_responsabilidad"
                            required="">
                        <label for="form_1_acepto_responsabilidad" style="text-transform:none;">YO
                            <b><?=htmlspecialchars($_SESSION["session_user"][3]);?></b>,
                            Acepto la responsabilidad de la información que se va a guardar en este
                            modulo.</label>
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