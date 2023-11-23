<form id="form_1_agregar">
    <div class="row gtr-25 gtr-uniform">

        <div class="col-6 col-12-small"> </div>
        <div class="col-6 col-12-small">
            <aside class="note-wrap note-yellow">
                Verifique que el tipo de gestiòn no exista antes de guardar <br>
                <b>TODOS</b> los campos deben ser llenados <br>
            </aside>
        </div>
        <div class="col-12">
            <fieldset>
                <legend>
                    Datos Básicos
                </legend>
                <div class="row gtr-25 gtr-uniform">
                    <div class="col-3 col-12-small">
                        <label class="label-datos label-important"> Nombre del tipo de gestiòn</label>
                    </div>
                    <div class="col-9 col-12-small">
                        <div class="input-container">
                            <i class="fas fa-align-left icon-input"></i>
                            <div>
                                <input type="text" id="form_1_nombre_tipo_gestion" placeholder="Nombre tipo gestion" name="nombre_tipo_gestion" value=""
                                required="" autocomplete="off">
                            </div>
                        </div>
                    </div>


                </div>
            </fieldset>
        </div>


        <div class="col-12">
            <fieldset class="fieldset-save">
                <legend> <i class="fas fa-pencil-alt"> </i> Términos y condiciones</legend>
                <div class="row gtr-50 gtr-uniform">
                <div class="col-12">
                        <input type="checkbox" id="form_1_acepto_responsabilidad" name="acepto_responsabilidad" required="">
                        <label for="form_1_acepto_responsabilidad" style="text-transform:none;">YO
                            <b><?= htmlspecialchars($_SESSION["session_user"][3]); ?></b>, He leído y acepto los <a href="/modulos/legal/" target="_blank">términos y condiciones</a> de uso. </label>
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
</form>